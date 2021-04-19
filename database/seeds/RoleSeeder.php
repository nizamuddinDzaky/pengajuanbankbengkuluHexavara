<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $data = [
            [
                'role'=> 'AdminPusat',    
            ],
            [
                'role'=> 'AdminCabang',
            ],
            [
                'role'=> 'AdminCabangPembantu',
            ],
            [
                'role'=> 'Teller',
            ]
        ];
        DB::table('role')->insert($data);
    }
}
