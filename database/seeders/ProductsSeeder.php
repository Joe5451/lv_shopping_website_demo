<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'product_name' => '特級巧克力蛋糕',
                'product_category_id' => '1',
                'product_subcategory_id' => '1',
                'price' => 450,
                'img_src' => 'images/product1.png',
                'summary' => '要想清楚，特級巧克力蛋糕，到底是一種怎麽樣的存在。',
                'content' => '要想清楚，特級巧克力蛋糕，到底是一種怎麽樣的存在。一般來講，我們都必須務必慎重的考慮考慮。諸葛亮告訴我們，靜以修身，儉以養德，非淡泊無以明志，非寧靜無以致遠。這句話語雖然很短，但令我浮想聯翩。特級巧克力蛋糕的發生，到底需要如何做到，不特級巧克力蛋糕的發生，又會如何產生。特級巧克力蛋糕，到底應該如何實現。',
            ],
            [
                'product_name' => '聖多諾黑',
                'product_category_id' => '1',
                'product_subcategory_id' => '1',
                'price' => 150,
                'img_src' => 'images/product2.png',
                'summary' => '',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque facere aperiam corrupti excepturi consequatur ipsa possimus deserunt rem optio placeat.',
            ],
            [
                'product_name' => '草莓蛋糕',
                'product_category_id' => '1',
                'product_subcategory_id' => '2',
                'price' => 185,
                'img_src' => 'images/product3.png',
                'summary' => '以精選可可、杏仁增加口感的碰撞出令人驚艷的火花。',
                'content' => '以精選可可、杏仁增加口感的碰撞出令人驚艷的火花。 用真材實料、滿懷愛意烘焙而出的甜點，少了華麗包裝及氣派裝潢，只為專心做好甜點，將滿腔熱情揉進每一個小點心裡。 費工費時，堅持手作最有良心，以製作最安心、健康、美味的甜品為宗旨！',
            ],
            
            [
                'product_name' => '草莓優格',
                'product_category_id' => '1',
                'product_subcategory_id' => '2',
                'price' => 450,
                'img_src' => 'images/product4.png',
                'summary' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque facere aperiam corrupti excepturi consequatur ipsa possimus deserunt rem optio placeat.',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque facere aperiam corrupti excepturi consequatur ipsa possimus deserunt rem optio placeat.',
            ],
            [
                'product_name' => '牛奶巧克力',
                'product_category_id' => '1',
                'product_subcategory_id' => '1',
                'price' => 300,
                'img_src' => 'images/product5.png',
                'summary' => '',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque facere aperiam corrupti excepturi consequatur ipsa possimus deserunt rem optio placeat.',
            ],
            [
                'product_name' => '花生可可派',
                'product_category_id' => '1',
                'product_subcategory_id' => '1',
                'price' => 500,
                'img_src' => 'images/product6.png',
                'summary' => '不同口味的慕斯層層疊疊，這一秒好像吃出了什麼滋味，下一秒又消失無蹤',
                'content' => '不同口味的慕斯層層疊疊，這一秒好像吃出了什麼滋味，下一秒又消失無蹤',
            ],
            [
                'product_name' => '密橙可可',
                'product_category_id' => '2',
                'product_subcategory_id' => '3',
                'price' => 180,
                'img_src' => 'images/product7.png',
                'summary' => '這濃郁芬香， 就像打開法國凡爾賽宮的大門， 皇家園林的宏偉對稱， 瑪麗皇后的瑰麗奢華',
                'content' => '這濃郁芬香， 就像打開法國凡爾賽宮的大門， 皇家園林的宏偉對稱， 瑪麗皇后的瑰麗奢華，夜夜笙歌的樂韻……。一切，隱沒於過去。遺下繁星，香氣，味道，流傳至今',
            ],
            [
                'product_name' => '蒙布朗',
                'product_category_id' => '2',
                'product_subcategory_id' => '3',
                'price' => 750,
                'img_src' => 'images/product8.png',
                'summary' => '不同口味的慕斯層層疊疊，這一秒好像吃出了什麼滋味，下一秒又消失無蹤',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque facere aperiam corrupti excepturi consequatur ipsa possimus deserunt rem optio placeat.',
            ],
        ]);
    }
}
