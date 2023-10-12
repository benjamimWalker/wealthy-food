<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{
    public function index(): LengthAwarePaginator
    {
        return Product::paginate();
    }

    public function show(int $code): Product
    {
        return Product::whereCode($code)->firstOrFail();
    }

    public function update(int $code, ProductRequest $request): Product
    {
        $product = Product::whereCode($code)->firstOrFail();

        $product->update($request->validated());

        return $product;
    }

    public function destroy(int $code): void
    {
        $product = Product::whereCode($code)->firstOrFail();

        $product->update(['status' => 'trash']);
    }
}
