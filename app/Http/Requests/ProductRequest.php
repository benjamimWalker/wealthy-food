<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['sometimes', 'string', 'in:published,trash,draft'],
            'url' => ['sometimes', 'url'],
            'creator' => ['sometimes', 'string'],
            'product_name' => ['sometimes', 'string'],
            'quantity' => ['sometimes', 'string'],
            'brands' => ['sometimes', 'string'],
            'categories' => ['sometimes', 'string'],
            'labels' => ['sometimes', 'string'],
            'cities' => ['sometimes', 'string'],
            'purchase_places' => ['sometimes', 'string'],
            'stores' => ['sometimes', 'string'],
            'ingredients_text' => ['sometimes', 'string'],
            'traces' => ['sometimes', 'string'],
            'serving_size' => ['sometimes', 'string'],
            'serving_quantity' => ['sometimes', 'numeric'],
            'nutriscore_score' => ['sometimes', 'alpha_num'],
            'nutriscore_grade' => ['sometimes', 'string'],
            'main_category' => ['sometimes', 'string'],
            'image_url' => ['sometimes', 'url']
        ];
    }
}
