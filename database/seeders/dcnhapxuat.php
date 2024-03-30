<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class dcnhapxuat extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dcnhapxuat')->insert([
            'TENDC' => 'Kho Ninh Kiều',
            'DCNHAPXUAT' => 'Cần Thơ'
        ]);
    }
}
