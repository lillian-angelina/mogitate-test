<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\DB;

class ProductSeasonSeeder extends Seeder
{
    public function run()
    {
        // 商品のIDが1のもののseasonを更新
        DB::table('products')
            ->where('id', 1) // 更新する商品IDを指定
            ->update(['season' => '秋,冬']); // 更新したいseasonの値を指定

        DB::table('products')
            ->where('id', 2) // 更新する商品IDを指定
            ->update(['season' => '春']); // 更新したいseasonの値を指定

        DB::table('products')
            ->where('id', 3) // 更新する商品IDを指定
            ->update(['season' => '冬']); // 更新したいseasonの値を指定

        DB::table('products')
            ->where('id', 4) // 更新する商品IDを指定
            ->update(['season' => '夏']); // 更新したいseasonの値を指定

        DB::table('products')
            ->where('id', 5) // 更新する商品IDを指定
            ->update(['season' => '夏']); // 更新したいseasonの値を指定

        DB::table('products')
            ->where('id', 6) // 更新する商品IDを指定
            ->update(['season' => '夏,秋']); // 更新したいseasonの値を指定

        DB::table('products')
            ->where('id', 7) // 更新する商品IDを指定
            ->update(['season' => '春,夏']); // 更新したいseasonの値を指定

        DB::table('products')
            ->where('id', 8) // 更新する商品IDを指定
            ->update(['season' => '夏,秋']); // 更新したいseasonの値を指定

        DB::table('products')
            ->where('id', 9) // 更新する商品IDを指定
            ->update(['season' => '夏']); // 更新したいseasonの値を指定

        DB::table('products')
            ->where('id', 10) // 更新する商品IDを指定
            ->update(['season' => '春,夏']); // 更新したいseasonの値を指定
            DB::table('products')
            ->where('id', 11) // 更新する商品IDを指定
            ->update(['season' => '秋,冬']); // 更新したいseasonの値を指定

        DB::table('products')
            ->where('id', 12) // 更新する商品IDを指定
            ->update(['season' => '春']); // 更新したいseasonの値を指定

        DB::table('products')
            ->where('id', 13) // 更新する商品IDを指定
            ->update(['season' => '冬']); // 更新したいseasonの値を指定

        DB::table('products')
            ->where('id', 14) // 更新する商品IDを指定
            ->update(['season' => '夏']); // 更新したいseasonの値を指定

        DB::table('products')
            ->where('id', 15) // 更新する商品IDを指定
            ->update(['season' => '夏']); // 更新したいseasonの値を指定
    }
}
