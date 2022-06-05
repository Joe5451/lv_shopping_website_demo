<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    public $timestamps = false; // 不存在 created_at 和 updated_at

    const order_states = [
        0 => '未處理',
        1 => '處理中',
        2 => '已寄出',
        3 => '退貨',
        4 => '取消訂單'
    ];

    protected $fillable = [
        'order_id',
        'datetime',
        'subtotal',
        'delivery_fee',
        'total',
        'name',
        'phone',
        'email',
        'address',
        'receiver_name',
        'receiver_phone',
        'receiver_email',
        'receiver_address',
        'order_remark',
        'order_state',
    ];

    public function order_items() {
        return $this->hasMany('App\Models\OrderItem', 'order_id', 'order_id');
    }
}
