<?php

namespace App\Http\Requests\V1;

use App\Enums\ProductStatus;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status' => 'nullable|in:' . implode(',', array_map(fn($status) => $status->value, ProductStatus::cases())),
            'imported_t' => 'nullable|date_format:Y-m-d\TH:i:s\Z',
            'url' => 'nullable|url',
            'creator' => 'nullable|string',
            'product_name' => 'nullable|string',
            'quantity' => 'nullable|string',
            'brands' => 'nullable|string',
            'categories' => 'nullable|string',
            'labels' => 'nullable|string',
            'cities' => 'nullable|string',
            'purchase_places' => 'nullable|string',
            'stores' => 'nullable|string',
            'ingredients_text' => 'nullable|string',
            'traces' => 'nullable|string',
            'serving_size' => 'nullable|string',
            'serving_quantity' => 'nullable|numeric',
            'nutriscore_score' => 'nullable|integer',
            'nutriscore_grade' => 'nullable|string',
            'main_category' => 'nullable|string',
            'image_url' => 'nullable|url',
        ];
    }
}
