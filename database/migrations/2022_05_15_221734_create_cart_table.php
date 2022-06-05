<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->increments('id');
            $table->string('product_id', 10)->default('')->comment('商品 id');
            $table->string('product_name', 255)->default('')->comment('商品名稱');
            $table->string('member_id', 10)->default('')->comment('會員 id');
            // $table->string('product_category_id', 10)->default('none')->comment('分類 id');
            // $table->string('product_category_name', 10)->default('')->comment('主分類名稱');
            // $table->string('product_subcategory_id', 10)->default('none')->comment('子分類 id');
            // $table->string('product_subcategory_name', 10)->default('')->comment('子分類名稱');
            $table->string('option_id', 10)->default('')->comment('規格 id');
            $table->string('option_name', 100)->default('')->comment('規格名稱');
            $table->mediumInteger('price')->default(0)->comment('價格');
            $table->smallInteger('amount')->default(0)->comment('數量');
            $table->string('img_src', 500)->default('')->comment('商品圖片');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart');
    }
}
