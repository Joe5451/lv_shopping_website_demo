<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';
    public $timestamps = false; // 不存在 created_at 和 updated_at

    protected $fillable = [
        'order_item_id',
        'order_id',
        'product_name',
        'product_category_name',
        'product_subcategory_name',
        'product_id',
        'product_category_id',
        'product_subcategory_id',
        'product_img',
        'option_id',
        'option_name',
        'price',
        'amount',
    ];
}
