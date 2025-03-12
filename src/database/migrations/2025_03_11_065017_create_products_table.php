<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // bigint unsigned & PRIMARY KEY
            $table->string('name', 255)->nullable(false)->comment('商品名');
            $table->integer('price')->nullable(false)->comment('商品料金');
            $table->string('image', 255)->nullable(false)->comment('商品画像');
            $table->text('description')->nullable(false)->comment('商品説明');
            $table->timestamps(); // created_at, updated_at
            
            // ストレージエンジンをInnoDBに設定
            $table->engine = 'InnoDB';
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
