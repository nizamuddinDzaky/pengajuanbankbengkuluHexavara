<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('users')->insert([
            'name'=>"Admin Pusat",
            'email'=> 'adminpusat@admin.com',
            'password' => Hash::make('password'),
            'kantor_id'=>1,
            "provinsi_id" => 7,
            "kabkot_id" => rand(116,125),
            "kecamatan_id"=> rand(1437, 1562),
            "kelurahan_id"=>rand(20279,21791),
        ]);
    }
}
