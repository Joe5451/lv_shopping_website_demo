<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';
    public $timestamps = false; // 不存在 created_at 和 updated_at
    
    const DISABLED = 'disabled';
    const ENABLED = 'enabled';

    const display_statuses = [
        0 => self::DISABLED,
        1 => self::ENABLED,
    ];

    protected $fillable = [
        'id',
        'title',
        'news_category_id',
        'img_src',
        'date',
        'summary',
        'content',
        'display',
    ];

    public function news_category() {
        return $this->hasOne('App\Models\NewsCategory', 'news_category_id', 'news_category_id');
    }
}
