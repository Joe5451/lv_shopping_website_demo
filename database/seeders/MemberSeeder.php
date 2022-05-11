<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('member')->insert([
            [
                'email' => 'user01@email.com',
                'name' => '厲羽',
                'city' => '台中市',
                'town' => '西屯區',
                'address' => '測試地址',
                'password' => md5('12345678'),
                'state' => 1,
                'remark' => '',
                'datetime' => date('Y-m-d H:i:s', strtotime('-1day')),
            ],
            [
                'email' => 'user02@email.com',
                'name' => '傑洛特',
                'city' => '台中市',
                'town' => '北屯區',
                'address' => '測試地址',
                'password' => md5('12345678'),
                'state' => 1,
                'remark' => '',
                'datetime' => date('Y-m-d H:i:s', strtotime('-2day')),
            ]
        ]);
    }
}
