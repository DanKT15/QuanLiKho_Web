<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KhoaNgoaiTonkho extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tonkho', function (Blueprint $table) {
            $table->unsignedInteger('MAKHO')->after('id');
            $table->foreign('MAKHO')->references('MAKHO')->on('kho')->onDelete('cascade');
            $table->unsignedInteger('MASP')->after('MAKHO');
            $table->foreign('MASP')->references('MASP')->on('sanpham')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tonkho', function (Blueprint $table) {
            //
        });
    }
}
