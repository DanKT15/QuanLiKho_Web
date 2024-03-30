<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CtNhapxuat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ct_nhapxuat', function (Blueprint $table) {
            $table->increments('id')->from(1111);
            $table->integer('SOLUONG')->default(0);
            $table->decimal('DONGIA', $precision = 8, $scale = 2);
            $table->decimal('THANHTIEN', $precision = 8, $scale = 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ct_nhapxuat');
    }
}
