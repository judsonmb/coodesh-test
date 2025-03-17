<?php

namespace App\Console\Commands;

use App\Enums\ProductStatus;
use App\Models\Product;
use App\Models\ProductImportHistory;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Zlib;


class ImportOpenFoodData extends Command
{
    protected $signature = 'import:open-food-data';
    protected $description = 'Import product data from Open Food Facts';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $startTime = microtime(true);
        $startMemory = memory_get_usage();

        $indexUrl = config('import.files_url');
        $indexResponse = Http::get($indexUrl);

        if ($indexResponse->failed()) {
            Log::error("Failed to retrieve index file.");
            return;
        }

        $files = explode("\n", $indexResponse->body());

        Log::info('Starting imports at: ' . now()->format('Y-m-d H:i:s'));

        foreach ($files as $file) {
            $file = trim($file);
            if ($file) {
                $this->processFile($file);
            }
        }

        Log::info('Finished imports at: ' . now()->format('Y-m-d H:i:s'));

        $endTime = microtime(true);
        $endMemory = memory_get_usage();

        $executionTime = $endTime - $startTime;
        $memoryUsage = $endMemory - $startMemory;

        ProductImportHistory::create([
            'last_executed_at' => Carbon::now(),
            'execution_time_seconds' => $executionTime,
            'memory_usage_bytes' => $memoryUsage,
        ]);

        Log::info("Import completed. Execution time: {$executionTime} seconds. Memory usage: {$memoryUsage} bytes.");
    }

    private function processFile(string $file)
    {
        Log::info('Processing file: ' . $file);

        $fileUrl = config('import.json_base_url') . $file;

        $response = Http::get($fileUrl);

        if ($response->failed()) {
            Log::error("Failed to retrieve file: {$file}");
            return;
        }

        $localGzFile = storage_path('app/private/' . basename($file));
        Storage::put(basename($file), $response->body());

        $gz = gzopen($localGzFile, 'rb');
        if (!$gz) {
            Log::error("Failed to open .gz file: {$file}");
            return;
        }

        $importLimit = config('import.import_limit_per_file');
        $processedCount = 0;

        while (!gzeof($gz) && $processedCount < $importLimit) {
            $line = gzgets($gz);
            if ($line !== false) {
                $productData = json_decode($line, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $this->importProduct($productData);
                    $processedCount++;
                } else {
                    Log::error("Failed to decode JSON line from file: {$file}");
                }
            }
        }
        gzclose($gz);
    }

    /**
     * Import a product.
     *
     * @param array $productData
     * @return void
     */
    private function importProduct(array $productData)
    {
        $product = Product::updateOrCreate(
            ['code' => $productData['code']],
            [
                'status' => ProductStatus::Published,
                'imported_t' => now(),
                'product_name' => $productData['product_name'] ?? null,
                'quantity' => $productData['quantity'] ?? null,
                'brands' => $productData['brands'] ?? null,
                'categories' => $productData['categories'] ?? null,
                'labels' => $productData['labels'] ?? null,
                'cities' => $productData['cities'] ?? null,
                'purchase_places' => $productData['purchase_places'] ?? null,
                'stores' => $productData['stores'] ?? null,
                'ingredients_text' => $productData['ingredients_text'] ?? null,
                'traces' => $productData['traces'] ?? null,
                'serving_size' => $productData['serving_size'] ?? null,
                'serving_quantity' => !empty($productData['serving_quantity']) ? $productData['serving_quantity'] : null,
                'nutriscore_score' => !empty($productData['nutriscore_score']) ? $productData['nutriscore_score'] : null,
                'nutriscore_grade' => $productData['nutriscore_grade'] ?? null,
                'main_category' => $productData['main_category'] ?? null,
                'image_url' => $productData['image_url'] ?? null,
            ]
        );
    }
}
