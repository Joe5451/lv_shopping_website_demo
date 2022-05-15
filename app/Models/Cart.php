<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';
    public $timestamps = false; // 不存在 created_at 和 updated_at

    protected $fillable = [
        'id',
        'product_id',
        'product_name',
        'member_id',
        'option_id',
        'option_name',
        'price',
        'amount',
        'img_src',
    ];
}
