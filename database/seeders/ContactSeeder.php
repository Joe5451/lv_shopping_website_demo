<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact')->insert([
            [
                'name' => '王曉明',
                'email' => 'user01@email.com',
                'phone' => '0912345678',
                'content' => '測試聯絡我們~~',
                'state' => '0',
                'datetime' => date('Y-m-d H:i:s', strtotime('-1day')),
            ],
            [
                'name' => 'Joe',
                'email' => 'user02@email.com',
                'phone' => '0912345678',
                'content' => '測試聯絡我們~~',
                'state' => '0',
                'datetime' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
