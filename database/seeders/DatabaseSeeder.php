<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        $this->call([
            AdminSeeder::class,
            NewsCategorySeeder::class,
            NewsSeeder::class,
            ContactSeeder::class,
            MemberSeeder::class,
            HeadImgSeeder::class,
            HomeSliderSeeder::class,
            DeliveryFeeSeeder::class,
            ProductCategorySeeder::class,
            ProductSubCategorySeeder::class,
            ProductsSeeder::class,
        ]);
    }
}
