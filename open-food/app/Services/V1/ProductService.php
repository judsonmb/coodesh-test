<?php

namespace App\Services\V1;

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
     */
    public function getProductByCode(string $code): ?Product
    {
        return $this->product::where('code', $code)->firstOrFail();
    }
}
