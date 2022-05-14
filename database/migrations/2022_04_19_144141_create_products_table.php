<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->increments('id');
            $table->string('product_name', 255)->comment('商品名稱');
            $table->string('product_category_id', 10)->comment('分類 id');
            $table->mediumInteger('price')->default(0)->comment('價格');
            $table->string('img_src', 500)->default('')->comment('封面圖位置');
            $table->smallInteger('sequence')->default(0)->comment('排序');
            $table->mediumText('summary')->default('')->comment('商品摘要');
            $table->mediumText('content')->default('')->comment('商品內容');
            $table->tinyInteger('display')->default(1)->comment('顯示狀態 (0:disabled, 1:enabled)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
