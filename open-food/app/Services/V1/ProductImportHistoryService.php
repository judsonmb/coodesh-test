<?php

namespace App\Services\V1;

use App\Models\ProductImportHistory;

class ProductImportHistoryService
{
    protected $productImportHistory;

    /**
     * Inject the Product model into the service.
     *
     * @param Product $product
     */
    public function __construct(ProductImportHistory $productImportHistory)
    {
        $this->productImportHistory = $productImportHistory;
    }

    /**
     * Method to return the last time the CRON job was executed, online time, and memory usage.
     *
     * @param array $requestData
     * @return ProductImportHistory
     */
    public function getLastExecutedCron(): ProductImportHistory
    {
        return $this->productImportHistory::latest()->first();
    }
}
