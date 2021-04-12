<?php

use App\Kantor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KantorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kantor::truncate();
        // DB::table('kantor')->delete();
        DB::table('kantor')->insert([
            'nama_kantor' => "Kantor Pusat",
            "parent" => "0",
            "provinsi_id" => 7,
            "kabkot_id" => rand(116,125),
            "kecamatan_id"=> rand(1437, 1562),
            "kelurahan_id"=>rand(20279,21791),
        ]);
    }
}
