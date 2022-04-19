<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert([
            [
                'title' => '最新消息1',
                'news_category_id' => '1',
                'img_src' => '',
                'date' => date('Y-m-d'),
                'summary' => '最新消息摘要',
                'content' => '最新消息內容',
                'display' => 1,
            ],
            [
                'title' => '最新消息2',
                'news_category_id' => '2',
                'img_src' => '',
                'date' => date('Y-m-d', strtotime('-1day')),
                'summary' => '最新消息摘要',
                'content' => '最新消息內容',
                'display' => 1,
            ]
        ]);
    }
}
