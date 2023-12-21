<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompareLaptopTable extends Migration
{
    public function up()
    {
        Schema::create('compare_laptop', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compare_id');
            $table->unsignedBigInteger('laptop_id');
            $table->timestamps();

            $table->foreign('compare_id')->references('id')->on('compare')->onDelete('cascade');
            $table->foreign('laptop_id')->references('id')->on('laptops')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('compare_laptop');
    }
};
