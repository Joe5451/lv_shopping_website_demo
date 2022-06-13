<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeadImgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('head_img')->insert([
            [
                'page_name' => '最新消息',
                'img_src' => 'images/banner4.jpg',
            ],
            [
                'page_name' => '購物商城',
                'img_src' => 'images/banner4.jpg',
            ],
            [
                'page_name' => '聯絡我們',
                'img_src' => 'images/banner4.jpg',
            ],
            [
                'page_name' => '會員中心',
                'img_src' => 'images/banner4.jpg',
            ]
        ]);
    }
}
