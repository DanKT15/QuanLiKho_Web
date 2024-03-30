<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('MANV')->from(1111);
            $table->string('TENNV', 100);
            $table->char('SDT', 12)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->useCurrent()->useCurrentOnUpdate();
            $table->string('password');
            $table->text('DC')->nullable();
            $table->text('HINHANH')->nullable();
            $table->char('GIOITINH', 12)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
