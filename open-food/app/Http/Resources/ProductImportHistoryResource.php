<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductImportHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'last_execution' => $this->created_at->format('d/m/Y H:i:s'),
            'execution_time' => $this->execution_time_seconds . 's',
            'memory_usage' => $this->memory_usage_bytes . 'B',
        ];
    }
}
