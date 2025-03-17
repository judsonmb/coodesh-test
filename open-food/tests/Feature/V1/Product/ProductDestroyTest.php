<?php

namespace Tests\Feature\V1\Product;

use App\Enums\ProductStatus;
use App\Models\Product;
use Tests\TestCase;

class ProductDestroyTest extends TestCase
{
    /**
     * Test the /products/{code} endpoint to destroy a product.
     *
     * @return void
     */
    public function test_destroy_product()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson('/api/v1/products/' . $product->code);

        $response->assertStatus(204);

        $product->refresh();
        $this->assertEquals(ProductStatus::Trash->value, $product->status);
    }

    /**
     * Test the /products/{code} endpoint when the product is not found.
     *
     * @return void
     */
    public function test_destroy_product_not_found()
    {
        $response = $this->deleteJson('/api/v1/products/99999999');

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'No query results for model [App\\Models\\Product].',
        ]);
    }
}
