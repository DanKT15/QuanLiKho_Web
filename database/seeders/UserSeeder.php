<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'TENNV' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        DB::table('users')->insert([
            'TENNV' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        DB::table('nhansu')->insert([
            'MANV' => '1111',
            'MAKHO' => '1111',
            'QUANTRI' => 'nhanvien'
        ]);

        DB::table('nhansu')->insert([
            'MANV' => '1112',
            'MAKHO' => '1111',
            'QUANTRI' => 'quantri'
        ]);
    }
}
