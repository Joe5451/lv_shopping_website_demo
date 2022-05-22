<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryFee extends Model
{
    use HasFactory;

    protected $table = 'delivery_fee';
    public $timestamps = false; // 不存在 created_at 和 updated_at
    
    protected $fillable = [
        'id',
        'delivery_fee'
    ];
}
