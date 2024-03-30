<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tonkho extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tonkho', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('SLTONKHO');
            $table->integer('SLNHAP')->default(0);
            $table->integer('SLXUAT')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tonkho');
    }
}
