<?php

namespace Tests\Feature\V1\Product;

use App\Models\Product;
use Tests\TestCase;

class ProductUpdateTest extends TestCase
{
    /**
     * Test the /products/{code} endpoint to update a product.
     *
     * @return void
     */
    public function test_update_product()
    {
        $product = Product::factory()->create();

        $updateData = [
            'product_name' => 'Updated Product Name',
            'status' => 'published',
            'quantity' => '500 g',
        ];

        $response = $this->putJson('/api/v1/products/' . $product->code, $updateData);

        $response->assertStatus(202);

        $response->assertJson([
            'message' => 'Product updated successfully.',
            'data' => [
                'id' => $product->id,
                'product_name' => 'Updated Product Name',
                'status' => 'published',
                'quantity' => '500 g',
            ],
        ]);

        $product->refresh();
        $this->assertEquals('Updated Product Name', $product->product_name);
        $this->assertEquals('published', $product->status);
        $this->assertEquals('500 g', $product->quantity);
    }

    /**
     * Test the /products/{code} endpoint when the product is not found.
     *
     * @return void
     */
    public function test_update_product_not_found()
    {
        $updateData = [
            'product_name' => 'Updated Product Name',
            'status' => 'published',
        ];

        $response = $this->putJson('/api/v1/products/99999999', $updateData);

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'No query results for model [App\\Models\\Product].',
        ]);
    }
}
