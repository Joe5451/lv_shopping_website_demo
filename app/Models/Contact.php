<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact';
    public $timestamps = false; // 不存在 created_at 和 updated_at

    const PENDING = '未處理';
    const PROCESSING = '處理中';
    const SOLVED = '已處理';

    const process_states = [
        0 => self::PENDING,
        1 => self::PROCESSING,
        2 => self::SOLVED,
    ];
    
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'content',
        'datetime',
    ];
}
