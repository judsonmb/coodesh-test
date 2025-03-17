<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductImportHistoryResource;
use App\Services\V1\ProductImportHistoryService;
use Illuminate\Http\Request;

class ProductImportHistoryController extends Controller
{
    protected $productImportHistoryService;

    /**
     * Inject the ProductImportHistoryService into the controller.
     *
     * @param ProductImportHistoryService $productImportHistoryService
     */
    public function __construct(ProductImportHistoryService $productImportHistoryService)
    {
        $this->productImportHistoryService = $productImportHistoryService;
    }

     /**
     * Returns the last time the CRON job was executed, online time, and memory usage
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $lastExecutedCron = $this->productImportHistoryService->getLastExecutedCron();

        return new ProductImportHistoryResource($lastExecutedCron);
    }
}
