<?php

namespace App\Services\V1;

use App\Enums\ProductStatus;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    protected $product;

    /**
     * Inject the Product model into the service.
     *
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Method to list products with pagination.
     *
     * @param array $requestData
     * @return LengthAwarePaginator
     */
    public function listProducts(array $requestData): LengthAwarePaginator
    {
        $perPage = $requestData['per_page'] ?? 15;

        return $this->product::paginate($perPage);
    }

    /**
     * Method to get product by code.
     *
     * @param string $code
     * @return Product|null
     * @throws ModelNotFoundException
     * 
     */
    public function getProductByCode(string $code): ?Product
    {
        return $this->product::where('code', $code)->firstOrFail();
    }

    /**
     * Update the product by code.
     *
     * @param string $code
     * @param array $data
     * @return Product|null
     * @throws ModelNotFoundException
     */
    public function updateProduct(string $code, array $data): ?Product
    {
        $product = $this->product::where('code', $code)->firstOrFail();

        $product->update($data);

        return $product;
    }

    /**
     * Delete the product by code (change its status to trash).
     *
     * @param string $code
     * @throws ModelNotFoundException
     * 
     */
    public function deleteProduct(string $code): void
    {
        $this->updateProduct($code, ['status' => ProductStatus::Trash->value]);
    }
}
