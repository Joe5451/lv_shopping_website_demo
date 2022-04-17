<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news_category')->insert([
            ['category_name' => '好康優惠'],
            ['category_name' => '體驗分享'],
        ]);
    }
}
