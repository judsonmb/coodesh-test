<?php

namespace Tests\Feature\V1\Product;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the /products endpoint.
     *
     * @return void
     */
    public function test_index_products()
    {
        Product::factory()->count(10)->create();

        $response = $this->getJson('/api/v1/products');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
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
                    'image_url',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);

        $response->assertJsonFragment([
            'current_page' => 1,
        ]);
    }
}