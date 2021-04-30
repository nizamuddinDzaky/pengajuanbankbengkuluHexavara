<?php

use Illuminate\Database\Seeder;
use App\Produk;
use App\SukuBunga;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Produk::truncate();
        SukuBunga::truncate();


        DB::table('produk')
            ->insert([
                'nama' => 'Multiguna Aktif',
                'deskripsi' => 'Untuk PNS Aktif',
                'jenis_suku_bunga' => 'berjangka',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' =>\Carbon\Carbon::now()
            ]);


        DB::table('produk')
            ->insert([
                'nama' => 'Multiguna Aktif Pensiun',
                'deskripsi' => 'Untuk PNS Pensiun',
                'jenis_suku_bunga' => 'berjangka',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' =>\Carbon\Carbon::now()
            ]);



        DB::table('suku_bunga')
            ->insert([
                'dari_bulan' => 0,
                'sampai_bulan' => 60,
                'bunga' => 10.2,
                'produk_id' => 1,
                'created_at' =>\Carbon\Carbon::now(),
                'updated_at' =>\Carbon\Carbon::now(),
            ]);

        DB::table('suku_bunga')
            ->insert([
                'dari_bulan' => 61,
                'sampai_bulan' => 120,
                'bunga' => 10.3,
                'produk_id' => 1,
                'created_at' =>\Carbon\Carbon::now(),
                'updated_at' =>\Carbon\Carbon::now(),
            ]);


        DB::table('suku_bunga')
            ->insert([
                'dari_bulan' => 121,
                'sampai_bulan' => 1000,
                'bunga' => 10.45,
                'produk_id' => 1,
                'created_at' =>\Carbon\Carbon::now(),
                'updated_at' =>\Carbon\Carbon::now(),
            ]);

        DB::table('suku_bunga')
            ->insert([
                'dari_bulan' => 0,
                'sampai_bulan' => 60,
                'bunga' => 10.1,
                'produk_id' => 2,
                'created_at' =>\Carbon\Carbon::now(),
                'updated_at' =>\Carbon\Carbon::now(),
            ]);

        DB::table('suku_bunga')
            ->insert([
                'dari_bulan' => 61,
                'sampai_bulan' => 120,
                'bunga' => 10.25,
                'produk_id' => 2,
                'created_at' =>\Carbon\Carbon::now(),
                'updated_at' =>\Carbon\Carbon::now(),
            ]);


        DB::table('suku_bunga')
            ->insert([
                'dari_bulan' => 121,
                'sampai_bulan' => 1000,
                'bunga' => 10.4,
                'produk_id' => 2,
                'created_at' =>\Carbon\Carbon::now(),
                'updated_at' =>\Carbon\Carbon::now(),
            ]);



    }
}
