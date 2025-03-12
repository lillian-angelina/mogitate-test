<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Season;

class SeasonFactory extends Factory
{
    protected $model = Season::class;

    public function definition(): array
    {
        static $seasons = ['春', '夏', '秋', '冬'];
        return [
            'name' => array_shift($seasons), // 4回の生成で春夏秋冬を設定
        ];
    }
}
