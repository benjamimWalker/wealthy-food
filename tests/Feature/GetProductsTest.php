<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetProductsTest extends TestCase
{
    use RefreshDatabase;

    public function testBasic()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function products_can_be_retrieved()
    {
        Product::factory(10)->create();
        $this->getJson(route('products.index'))
            ->assertSuccessful()
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'code',
                        'product_name',
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
                    ]
                ]
            ])
            ->assertJsonCount(10, 'data')
            ->assertJson([
                'data' => Product::all()->toArray()
            ]);
    }

    /** @test */
    public function products_can_be_retrieved_with_pagination()
    {
        Product::factory(20)->create();

        $this->getJson(route('products.index', ['page' => 2]))
            ->assertSuccessful()
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'code',
                        'product_name',
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
                    ]
                ]
            ])
            ->assertJsonCount(5, 'data')
            ->assertJson([
                'data' => Product::skip(15)->take(5)->get()->toArray()
            ]);
    }

    /** @test */
    public function can_retreive_empty_data()
    {
        $this->getJson(route('products.index'))
            ->assertSuccessful()
            ->assertOk()
            ->assertJsonStructure([
                'data' => []
            ])
            ->assertJsonCount(0, 'data')
            ->assertJson([
                'data' => []
            ]);
    }
}
