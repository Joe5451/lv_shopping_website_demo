<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadImg extends Model
{
    use HasFactory;

    protected $table = 'head_img';
    public $timestamps = false; // 不存在 created_at 和 updated_at

    protected $fillable = [
        'id',
        'page_name',
        'img_src',
    ];
}
