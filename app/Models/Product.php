<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    public $timestamps = false; // 不存在 created_at 和 updated_at
    
    const DISABLED = 'disabled';
    const ENABLED = 'enabled';

    const display_statuses = [
        0 => self::DISABLED,
        1 => self::ENABLED,
    ];

    protected $fillable = [
        'id',
        'product_name',
        'product_category_id',
        // 'img_src',
        'price',
        'sequence',
        'summary',
        'content',
        'display',
    ];

    public function product_category() {
        return $this->hasOne('App\Models\ProductCategory', 'news_category_id', 'news_category_id');
    }
}
