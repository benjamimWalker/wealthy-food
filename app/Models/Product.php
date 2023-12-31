<?php

namespace App\Models;

use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'status',
        'imported_t',
        'url',
        'creator',
        'created_t',
        'last_modified_t',
        'product_name',
        'quantity',
        'brands',
        'categories',
        'labels',
        'cities',
        'purchase_places',
        'stores',
        'ingredients_text',
        'traces',
        'serving_size',
        'serving_quantity',
        'nutriscore_score',
        'nutriscore_grade',
        'main_category',
        'image_url'
    ];

    const CREATED_AT = 'created_t';
    const UPDATED_AT = 'last_modified_t';

    protected $casts = [
        'status' => ProductStatus::class
    ];

    public function toArray()
    {
        $array = parent::toArray();

        $array['created_t'] = $this->created_t->timestamp;
        $array['last_modified_t'] = $this->last_modified_t->timestamp;

        return $array;
    }
}
