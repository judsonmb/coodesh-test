<?php

namespace App\Services\V1;

use App\Models\Product;

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
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function listProducts(array $requestData)
    {
        $perPage = $requestData['per_page'] ?? 15;

        return $this->product::paginate($perPage);
    }
}
