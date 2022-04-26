<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->increments('member_id');
            $table->string('account', 100)->comment('帳號');
            $table->string('name', 100)->comment('姓名');
            $table->string('city', 20)->comment('縣市');
            $table->string('town', 20)->comment('區域');
            $table->string('address', 200)->comment('地址');
            $table->string('password', 200)->comment('密碼');
            $table->tinyInteger('state')->default(1)->comment('狀態 (0:停權, 1:正常)');
            $table->mediumText('remark')->default('')->comment('管理員備註');
            $table->dateTime('datetime', 0)->comment('加入時間');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member');
    }
}
