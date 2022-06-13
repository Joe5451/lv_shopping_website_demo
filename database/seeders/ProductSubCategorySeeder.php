<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_subcategory')->insert([
            [
                'subcategory_name' => '黑森林系列',
                'category_id' => '1'
            ],
            [
                'subcategory_name' => '粉紅泡泡',
                'category_id' => '1'
            ],
            [
                'subcategory_name' => '極選',
                'category_id' => '2'
            ],
        ]);
    }
}
