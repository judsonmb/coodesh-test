<?php

namespace Tests\Feature\V1\Product;

use App\Models\Product;
use Tests\TestCase;

class ProductShowTest extends TestCase
{
    /**
     * Test the /products/{code} endpoint.
     *
     * @return void
     */
    public function test_show_product_by_code()
    {
        $product = Product::factory()->create();

        $response = $this->getJson('/api/v1/products/' . $product->code);

        $response->assertStatus(200);

        $response->assertJson([
            'id' => $product->id,
            'code' => $product->code,
            'status' => $product->status,
            'product_name' => $product->product_name,
            'quantity' => $product->quantity,
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
            'image_url' => $product->image_url,
        ]);
    }

    /**
     * Test the /products/{code} endpoint when product not found.
     *
     * @return void
     */
    public function test_show_product_not_found()
    {
        $response = $this->getJson('/api/v1/products/99999999');

        $response->assertStatus(404);

        $response->assertJson([
            'message' => 'No query results for model [App\\Models\\Product].',
        ]);
    }
}
