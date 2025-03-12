<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\SeasonSeeder;
use Database\Seeders\ProductTableSeeder;
use Database\Seeders\ProductSeasonSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(SeasonTableSeeder::class);  // SeasonSeederを呼び出す
        $this->call(ProductTableSeeder::class);
        $this->call(ProductSeasonSeeder::class);
    }
}
