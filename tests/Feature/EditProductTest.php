<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditProductTest extends TestCase
{
    use RefreshDatabase;

    public function testBasic()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function product_can_be_edited()
    {
        $product = Product::factory()->create();

        $data = [
            'code' => $product->code,
            'product_name' => 'New product name',
            'brands' => 'New brand',
            'categories' => 'New category',
            'labels' => 'New label',
            'cities' => 'New city',
            'purchase_places' => 'New purchase place',
            'stores' => 'New store',
            'ingredients_text' => 'New ingredients text',
            'traces' => 'New trace',
            'serving_size' => 'New serving size',
            'serving_quantity' => '854',
            'nutriscore_score' => '321',
            'nutriscore_grade' => 'New nutriscore grade',
            'main_category' => 'New main category',
            'image_url' => 'https://new-image-url.com'
        ];

        $this->putJson(route('products.update', $product->code), $data)->assertSuccessful();

        $this->assertDatabaseHas('products', $data);
    }

    /** @test */
    public function cannot_update_when_product_does_not_exist()
    {
        $data = [
            'code' => 123456789,
            'product_name' => 'New product name',
            'brands' => 'New brand',
            'categories' => 'New category',
            'labels' => 'New label',
            'cities' => 'New city',
            'purchase_places' => 'New purchase place',
            'stores' => 'New store',
            'ingredients_text' => 'New ingredients text',
            'traces' => 'New trace',
            'serving_size' => 'New serving size',
            'serving_quantity' => '854',
            'nutriscore_score' => '321',
            'nutriscore_grade' => 'New nutriscore grade',
            'main_category' => 'New main category',
            'image_url' => 'https://new-image-url.com'
        ];

        $this->putJson(route('products.update', 123456789), $data)->assertNotFound();
    }

    /** @test */
    public function validates_when_status_is_invalid()
    {
        $product = Product::factory()->create();

        $data = [
            'status' => 'invalid',
            'product_name' => 'New product name',
            'brands' => 'New brand',
            'categories' => 'New category',
            'labels' => 'New label',
            'cities' => 'New city',
            'purchase_places' => 'New purchase place',
            'stores' => 'New store',
            'ingredients_text' => 'New ingredients text',
            'traces' => 'New trace',
            'serving_quantity' => '854',
            'nutriscore_score' => '321',
            'nutriscore_grade' => 'New nutriscore grade',
            'main_category' => 'New main category',
            'image_url' => 'https://new-image-url.com'
        ];

        $this->putJson(route('products.update', $product->code), $data)
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'status'
                ]
            ]);
    }

    /** @test */
    public function validates_when_product_name_is_invalid()
    {
        $product = Product::factory()->create();

        $data = [
            'product_name' => 123456789,
            'brands' => 'New brand',
            'categories' => 'New category',
            'labels' => 'New label',
            'cities' => 'New city',
            'purchase_places' => 'New purchase place',
            'stores' => 'New store',
            'ingredients_text' => 'New ingredients text',
            'traces' => 'New trace',
            'serving_quantity' => '854',
            'nutriscore_score' => '321',
            'nutriscore_grade' => 'New nutriscore grade',
            'main_category' => 'New main category',
            'image_url' => 'https://new-image-url.com'
        ];

        $this->putJson(route('products.update', $product->code), $data)
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'product_name'
                ]
            ]);
    }

    /** @test */
    public function validates_when_brands_is_invalid()
    {
        $product = Product::factory()->create();

        $data = [
            'product_name' => 'New product name',
            'brands' => 123456789,
            'categories' => 'New category',
            'labels' => 'New label',
            'cities' => 'New city',
            'purchase_places' => 'New purchase place',
            'stores' => 'New store',
            'ingredients_text' => 'New ingredients text',
            'traces' => 'New trace',
            'serving_quantity' => '854',
            'nutriscore_score' => '321',
            'nutriscore_grade' => 'New nutriscore grade',
            'main_category' => 'New main category',
            'image_url' => 'https://new-image-url.com'
        ];

        $this->putJson(route('products.update', $product->code), $data)
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'brands'
                ]
            ]);
    }
}
