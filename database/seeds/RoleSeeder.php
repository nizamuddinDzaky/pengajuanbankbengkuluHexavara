<?php

use App\Role;
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
        Role::truncate();
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
                'role'=> 'CustomerService',
            ],
            [
                'role' => 'Nasabah'
            ]
        ];
        DB::table('role')->insert($data);
    }
}
