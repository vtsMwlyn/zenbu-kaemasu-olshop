<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("seller_id");
            $table->string("product_name");
            $table->longText("desc");
            $table->unsignedInteger("stock");
            $table->unsignedBigInteger("price");
            $table->string("prodimg_path")->nullable();
            $table->string("slug")->unique();
            $table->timestamps();

            $table->foreign("seller_id")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
