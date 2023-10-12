<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('', function () {
    $connection = DB::connection('mysql');

    try {
        $connection->select('SELECT 1');

        $dbConnectionStatus = 'OK';
    } catch (Exception) {
        $dbConnectionStatus = 'Error';
    }

    $memoryUsage = memory_get_usage(true) / 1024 / 1024;

    $uptimeInSeconds = time() - @filemtime('/proc/uptime');
    $uptime = gmdate("H:i:s", $uptimeInSeconds);


    return response()->json([
        'db_connection' => $dbConnectionStatus,
        'memory_usage' => $memoryUsage . 'MB',
        'uptime' => $uptime,
        'job_last_run' => Cache::get('last_run') ?? 'Never'
    ]);
});

Route::apiResource('products', ProductController::class)->except(['create']);
