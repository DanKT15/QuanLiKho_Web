<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KhoaNgoaiCtnhapxuat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ct_nhapxuat', function (Blueprint $table) {
            $table->unsignedInteger('MAPHIEU');
            $table->foreign('MAPHIEU')->references('id')->on('phieunhapxuat')->onDelete('cascade');
            $table->unsignedInteger('MASP')->after('MAPHIEU');
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
        Schema::table('ct_nhapxuat', function (Blueprint $table) {
            //
        });
    }
}
