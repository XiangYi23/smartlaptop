<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

     public function up(): void
     {
            Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // 外键连接到users表的ID
            $table->unsignedBigInteger('laptop_id'); // 外键连接到laptops表的ID
            $table->text('comment');
            $table->unsignedTinyInteger('rating');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('laptop_id')->references('id')->on('laptops');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('reviews');
    }
};

