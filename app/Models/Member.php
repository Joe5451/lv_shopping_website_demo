<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'member';
    protected $primaryKey = 'member_id';
    public $timestamps = false; // 不存在 created_at 和 updated_at
    
    const DISABLED = 'disabled';
    const ENABLED = 'enabled';

    const states = [
        0 => self::DISABLED,
        1 => self::ENABLED,
    ];

    protected $fillable = [
        'member_id',
        'email',
        'name',
        'phone',
        'city',
        'town',
        'address',
        'password',
        'state',
        'remark',
        'datetime',
    ];
}
