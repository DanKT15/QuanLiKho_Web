<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class trangthai extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trangthai')->insert([
            'TENTT' => 'Nhập'
        ]);

        DB::table('trangthai')->insert([
            'TENTT' => 'Xuất'
        ]);
    }
}
