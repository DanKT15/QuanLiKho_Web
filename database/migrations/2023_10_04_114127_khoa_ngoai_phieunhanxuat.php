<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KhoaNgoaiPhieunhanxuat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phieunhapxuat', function (Blueprint $table) {

            $table->unsignedInteger('MANV')->nullable()->after('SOPHIEU');
            $table->foreign('MANV')->references('MANV')->on('users')->onDelete('cascade');

            $table->unsignedInteger('MADC')->nullable()->after('MANV');
            $table->foreign('MADC')->references('MADC')->on('dcnhapxuat')->onDelete('cascade');

            $table->unsignedInteger('MATT')->nullable()->after('MADC');
            $table->foreign('MATT')->references('MATT')->on('trangthai')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phieunhapxuat', function (Blueprint $table) {
            //
        });
    }
}
