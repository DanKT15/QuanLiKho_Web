<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// php artisan make:migration khoa_ngoai_nhansu --table=nhansu
class KhoaNgoaiNhansu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nhansu', function (Blueprint $table) {
            $table->unsignedInteger('MANV')->unique()->after('id');
            $table->foreign('MANV')->references('MANV')->on('users')->onDelete('cascade');
            $table->unsignedInteger('MAKHO')->after('MANV');
            $table->foreign('MAKHO')->references('MAKHO')->on('kho')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nhansu', function (Blueprint $table) {
            //
        });
    }
}
