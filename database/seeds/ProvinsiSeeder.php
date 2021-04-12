<?php

use App\Provinsi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provinsi::truncate();
        // DB::table('provinsi')->delete();
        DB::table('provinsi')->insert([
            'id' => 7,
            'provinsi' => 'Bengkulu',
            'ibukota' => 'Bengkulu',
            'p_bsni' => 'ID-BE',
        ]);
    }
}
