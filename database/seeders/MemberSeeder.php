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
                'email' => 'test@email.com',
                'name' => '測試員',
                'phone' => '0912345678',
                'city' => '台中市',
                'town' => '西屯區',
                'address' => '測試地址',
                'password' => md5('aaa'),
                'state' => 1,
                'remark' => '',
                'datetime' => date('Y-m-d H:i:s'),
            ],
            [
                'email' => 'user01@email.com',
                'name' => '厲羽',
                'phone' => '0912345677',
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
                'phone' => '0912345676',
                'city' => '台中市',
                'town' => '北屯區',
                'address' => '測試地址',
                'password' => md5('12345678'),
                'state' => 1,
                'remark' => '',
                'datetime' => date('Y-m-d H:i:s', strtotime('-2day')),
            ],
        ]);
    }
}
