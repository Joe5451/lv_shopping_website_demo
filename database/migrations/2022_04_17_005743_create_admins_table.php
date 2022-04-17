<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            
            // $table->id('admin_id'); // bigIncrements() 別名，建立自增 UNSIGNED BIGINT 類型主鍵
            $table->increments('admin_id'); // 建立自增 UNSIGNED INTEGER 類型主鍵
            $table->string('name');
            $table->string('account');
            $table->string('password');
            // $table->timestamps(); // 建立 created_at 和 updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
