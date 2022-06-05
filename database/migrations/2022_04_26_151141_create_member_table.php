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
            $table->string('email', 100)->default('')->comment('帳號');
            $table->string('phone', 20)->default('')->comment('電話');
            $table->string('name', 100)->default('')->comment('姓名');
            $table->string('city', 20)->default('')->comment('縣市');
            $table->string('town', 20)->default('')->comment('區域');
            $table->string('address', 200)->default('')->comment('地址');
            $table->string('password', 200)->default('')->comment('密碼');
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
