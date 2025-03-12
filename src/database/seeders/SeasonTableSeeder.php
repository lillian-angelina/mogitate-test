<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('seasons')->upsert([
            ['name' => '春', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '夏', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '秋', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '冬', 'created_at' => now(), 'updated_at' => now()],
        ], 
        ['name'], // 一意制約のあるカラム（重複チェックの対象）
        ['updated_at'] // 更新するカラム
        );
    }
}