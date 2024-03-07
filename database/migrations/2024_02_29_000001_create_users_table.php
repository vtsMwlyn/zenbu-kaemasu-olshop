<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(){
        Schema::create("users", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("role_id");
            $table->string("email")->unique();
            $table->string("password");
            $table->timestamps();

            $table->foreign("role_id")->references("id")->on("roles");
        });
    }

    public function down(){
        Schema::dropIfExists("users");
    }
};
