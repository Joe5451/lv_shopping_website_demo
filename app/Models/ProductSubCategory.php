<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;

    protected $table = 'product_subcategory';
    protected $primaryKey = 'product_subcategory_id';
    public $timestamps = false; // 不存在 created_at 和 updated_at
    
    const DISABLED = 'disabled';
    const ENABLED = 'enabled';

    const display_statuses = [
        0 => self::DISABLED,
        1 => self::ENABLED,
    ];

    protected $fillable = [
        'product_subcategory_id',
        'category_id',
        'subcategory_name',
        'display',
        'sequence',
    ];
}
