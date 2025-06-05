<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['name' => 'シャインマスカット', 'price' => 1400, 'image' => 'shine_muscat.png', 'description' => '爽やかな甘みの高級ぶどう'],
            ['name' => 'ストロベリー', 'price' => 1200, 'image' => 'strawberry.png', 'description' => '甘酸っぱくてみずみずしいイチゴ'],
            ['name' => 'ピーチ', 'price' => 1000, 'image' => 'peach.png', 'description' => '芳醇な香りとやわらかい果肉'],
            ['name' => 'オレンジ', 'price' => 850, 'image' => 'orange.png', 'description' => 'ビタミンC豊富な柑橘類'],
            ['name' => 'キウイ', 'price' => 800, 'image' => 'kiwi.png', 'description' => '酸味と甘みが絶妙なトロピカルフルーツ'],
            ['name' => 'スイカ', 'price' => 700, 'image' => 'watermelon.png', 'description' => '夏の定番みずみずしいスイカ'],
            ['name' => 'パイナップル', 'price' => 600, 'image' => 'pineapple.png', 'description' => '南国の香り広がるジューシーな果実'],
            ['name' => 'メロン', 'price' => 400, 'image' => 'melon.png', 'description' => '贅沢な甘さのメロン'],
            ['name' => 'グレープ', 'price' => 300, 'image' => 'grape.png', 'description' => '甘みとコクが特徴のぶどう'],
            ['name' => 'バナナ', 'price' => 200, 'image' => 'banana.png', 'description' => 'エネルギー補給に最適なフルーツ'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
