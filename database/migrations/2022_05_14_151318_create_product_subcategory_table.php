<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSubcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_subcategory', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->increments('product_subcategory_id');
            $table->string('category_id', 10)->default('')->comment('母分類 id');
            $table->string('subcategory_name', 100)->default('')->comment('子分類名稱');
            $table->tinyInteger('display')->default(1)->comment('顯示狀態 (0:disabled, 1:enabled)');
            $table->smallInteger('sequence')->default(0)->comment('排序');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_subcategory');
    }
}
