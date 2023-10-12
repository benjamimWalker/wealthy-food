<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class UpdateProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
    }

    public function handle()
    {
        $fileNames = array_filter(
            array_map(
                'trim',
                explode("\n",
                    Http::get(config('app.files_url'))->body()
                )
            )
        );

        foreach ($fileNames as $fileName) {
            $handle = gzopen(config('app.json_file') . $fileName, 'r');
            $lineNumber = 0;

            while (! gzeof($handle) && $lineNumber++ < 100) {
                $json = json_decode(gzgets($handle), true);
                if (str($json['code'])->startsWith("\"")) {
                    $json['code'] = str($json['code'])->substr(1, -1);
                }
                $json['imported_t'] = now();
                $json['status'] = 'published';
                Product::updateOrCreate(['code' => $json['code']], $json);
            }

            gzclose($handle);
        }
    }
}
