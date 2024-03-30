<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DCNhapXuat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dcnhapxuat', function (Blueprint $table) {
            $table->increments('MADC')->from(1111);
            $table->string('TENDC', 100);
            $table->text('DCNHAPXUAT')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dcnhapxuat');
    }
}
