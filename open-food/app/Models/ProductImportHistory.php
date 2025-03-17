<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImportHistory extends Model
{
    use HasFactory;

    protected $table = 'product_import_histories';

    protected $fillable = [
        'last_executed_at',
        'execution_time_seconds',
        'memory_usage_bytes',
    ];
}