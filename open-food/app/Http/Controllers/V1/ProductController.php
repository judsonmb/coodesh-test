<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\V1\ProductService;
use App\Http\Requests\V1\ProductIndexRequest;

class ProductController extends Controller
{
    protected $productService;

    /**
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * List all products with pagination.
     *
     * @param ProductIndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ProductIndexRequest $request)
    {
        $validatedData = $request->validated();

        $products = $this->productService->listProducts($validatedData);

        return response()->json($products);
    }
}
