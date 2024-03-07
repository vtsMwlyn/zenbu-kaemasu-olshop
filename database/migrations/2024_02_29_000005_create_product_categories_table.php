<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(){
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_id");
            $table->unsignedBigInteger("category_id");
            $table->timestamps();

            $table->foreign("product_id")->references("id")->on("products");
            $table->foreign("category_id")->references("id")->on("categories");
        });
    }

    public function down(){
        Schema::dropIfExists('product_categories');
    }
};
