<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->increments('id');
            $table->string('name', 100)->comment('姓名');
            $table->string('email', 100)->comment('Email');
            $table->string('phone', 20)->comment('電話');
            $table->mediumText('content')->default('')->comment('內容');
            $table->mediumText('remark')->default('')->comment('管理員備註');
            $table->tinyInteger('state')->default(0)->comment('處理狀態 (0:未處理, 1:處理中, 2:已處理)');
            $table->dateTime('datetime', 0)->comment('日期');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact');
    }
}
