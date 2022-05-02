<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlider extends Model
{
    use HasFactory;

    protected $table = 'home_slider';
    public $timestamps = false; // 不存在 created_at 和 updated_at

    protected $fillable = [
        'id',
        'img_src',
        'sequence',
    ];
}
