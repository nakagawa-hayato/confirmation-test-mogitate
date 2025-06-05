<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Season;

class ProductSeasonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seasonMap = [
            'シャインマスカット' => ['秋'],
            'ストロベリー' => ['春'],
            'ピーチ' => ['夏'],
            'オレンジ' => ['冬'],
            'キウイ' => ['冬', '春'],
            'スイカ' => ['夏'],
            'パイナップル' => ['夏'],
            'メロン' => ['夏'],
            'グレープ' => ['秋'],
            'バナナ' => ['春', '夏', '秋', '冬'], 
        ];

        foreach ($seasonMap as $productName => $seasonNames) {
            $product = Product::where('name', $productName)->first();
            $seasonIds = Season::whereIn('name', $seasonNames)->pluck('id');
            $product->seasons()->sync($seasonIds);
        }
        //
    }
}
