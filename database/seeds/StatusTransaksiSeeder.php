<?php

use Illuminate\Database\Seeder;
use App\RefStatus;
use Illuminate\Support\Facades\DB;

class StatusTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ref_status')->insert([
            "status" => "Belum Konfirmasi"
        ]);
        DB::table('ref_status')->insert([
            "status" => "Belum Dilayani"
        ]);
        DB::table('ref_status')->insert([
            "status" => "Sudah Dilayani"
        ]);
        DB::table('ref_status')->insert([
            "status" => "Batal Melakukan Pengajuan"
        ]);
        DB::table('ref_status')->insert([
            "status" => "Melakukan Penjadwalan Ulang"
        ]);
        DB::table('ref_status')->insert([
            "status" => "Tidak Datang"
        ]);
    }
}
