<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\V1\ProductService;
use App\Http\Requests\V1\ProductIndexRequest;
use App\Http\Requests\V1\ProductUpdateRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

     /**
     * Inject the ProductService into the controller.
     *
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

    /**
     * Display the specified product by code.
     *
     * @param string $code
     * @return JsonResponse
     */
    public function show(Request $request, string $code)
    {
        $product = $this->productService->getProductByCode($code);

        return response()->json($product);
    }

    /**
     * Update the specified product by code.
     *
     * @param  ProductUpdateRequest  $request
     * @param  string  $code
     * @return JsonResponse
     */
    public function update(ProductUpdateRequest $request, string $code)
    {
        $validatedData = $request->validated();

        $product = $this->productService->updateProduct($code, $validatedData);

        return response()->json([
            'message' => 'Product updated successfully.',
            'data' => $product,
        ], 202);
    }

    /**
     * Delete the product by code (change its status to trash).
     *
     * @param string $code
     * @return void
     */
    public function destroy(Request $request, string $code)
    {
        $this->productService->deleteProduct($code);

        return response()->json([], 204);
    }
}
