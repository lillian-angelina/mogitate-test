<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('product_season', function (Blueprint $table) {
            $table->id(); // bigint unsigned & PRIMARY KEY
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // 外部キー制約
            $table->foreignId('season_id')->constrained('seasons')->onDelete('cascade'); // 外部キー制約
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_season');
    }
};
