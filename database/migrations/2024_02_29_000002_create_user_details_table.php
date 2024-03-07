<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(){
        Schema::create("user_details", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("username")->unique();
            $table->string("real_name");
            $table->date("dob");
            $table->string("address");
            $table->string("phone");
            $table->string("profpic_path")->nullable();
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users");
        });
    }

    public function down(){
        Schema::dropIfExists("user_details");
    }
};
