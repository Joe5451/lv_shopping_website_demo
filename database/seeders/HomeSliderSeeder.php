<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('home_slider')->insert([
            [
                'img_src' => 'images/bg_demo.png',
                'href' => '',
                'sequence' => 0,
            ],
            [
                'img_src' => 'images/bg_demo.png',
                'href' => '',
                'sequence' => 1,
            ],
            [
                'img_src' => 'images/bg_demo.png',
                'href' => '',
                'sequence' => 2,
            ]
        ]);
    }
}
