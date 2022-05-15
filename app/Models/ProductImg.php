<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImg extends Model
{
    use HasFactory;

    protected $table = 'product_img';
    public $timestamps = false; // 不存在 created_at 和 updated_at

    protected $fillable = [
        'id',
        'product_id',
        'src',
        'sequence',
    ];
}
