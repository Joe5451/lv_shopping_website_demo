<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            
            $table->increments('order_id');
            $table->string('member_id', 10)->default('')->comment('會員 id');
            $table->string('order_number', 10)->default('')->comment('訂單編號');
            $table->dateTime('datetime', 0)->comment('訂單建立時間');
            $table->integer('subtotal')->default(0)->comment('商品小計');
            $table->mediumInteger('delivery_fee')->default(0)->comment('運費');
            $table->integer('total')->default(0)->comment('總計');
            $table->string('name', 100)->default('')->comment('訂購人姓名');
            $table->string('phone', 20)->default('')->comment('訂購人電話');
            $table->string('address', 200)->default('')->comment('訂購人地址');
            $table->string('email', 100)->default('')->comment('訂購人 Email');
            $table->string('receiver_name', 100)->default('')->comment('接收人姓名');
            $table->string('receiver_phone', 20)->default('')->comment('接收人電話');
            $table->string('receiver_address', 200)->default('')->comment('接收人地址');
            $table->string('receiver_email', 100)->default('')->comment('接收人 Email');
            $table->mediumText('order_remark')->default('')->comment('訂單備註');
            $table->tinyInteger('order_state')->default(0)->comment('訂單狀態 (0:未處理, 1:處理中, 2:已寄出, 3:退貨, 4:取消訂單)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
