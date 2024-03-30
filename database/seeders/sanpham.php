<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class sanpham extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sanpham')->insert([
            'TENSP' => 'Oppo A12',
            'MALOAI' => 1111,
            'MANCC' => 1111,
            'THONGTIN' => 'Chưa cập nhật',
            'GIASP' => 5000
        ]);
    }
}
