<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetProductTest extends TestCase
{
    use RefreshDatabase;

    public function testBasic()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function product_can_be_retrieved()
    {
        $product = Product::factory()->create();

        $this->getJson(route('products.show', $product->code))
            ->assertSuccessful()
            ->assertOk()
            ->assertJson([
                'code' => $product->code,
                'product_name' => $product->product_name,
                'brands' => $product->brands,
                'categories' => $product->categories,
                'labels' => $product->labels,
                'cities' => $product->cities,
                'purchase_places' => $product->purchase_places,
                'stores' => $product->stores,
                'ingredients_text' => $product->ingredients_text,
                'traces' => $product->traces,
                'serving_size' => $product->serving_size,
                'serving_quantity' => $product->serving_quantity,
                'nutriscore_score' => $product->nutriscore_score,
                'nutriscore_grade' => $product->nutriscore_grade,
                'main_category' => $product->main_category,
                'image_url' => $product->image_url
            ]);
    }

    /** @test */
    public function cannot_retrieve_when_product_does_not_exist()
    {
        $this->getJson(route('products.show', 123456789))
            ->assertNotFound();
    }

    /** @test */
    public function cannot_retrieve_when_product_code_is_not_a_number()
    {
        $this->getJson(route('products.show', 'abc'))
            ->assertInternalServerError();
    }
}
