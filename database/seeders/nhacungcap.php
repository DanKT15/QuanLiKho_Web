<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class nhacungcap extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nhacungcap')->insert([
            'TENNCC' => 'Long Á',
            'SDT' => '0909090909',
            'DC' => 'Cần Thơ'
        ]);
    }
}
