<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laptops', function (Blueprint $table) {
            $table->string('name');
            $table->string('image');
            $table->float('price');
            $table->string('manufacturer');
            $table->string('process_model');
            $table->string('graphics');
            $table->string('display_technology');
            $table->string('screen_size');
            $table->string('screen_resolution');
            $table->string('memory');
            $table->string('storage');
            $table->string('operating_system');
            $table->string('connectivity');
            $table->string('camera');
            $table->string('ports');
            $table->string('battery');
            $table->string('height');
            $table->string('width');
            $table->string('depth');
            $table->string('weight');
            $table->string('type');
            $table->string('shopee');
            $table->string('lazada');
            $table->string('filter');
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laptops');
    }
};
