<?php

use App\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::truncate();
        DB::table('user_role')->insert([
            'user_id' => '1',
            'role_id' => '1',
            "updated_at" => date('Y-m-d H:i:s'),
            "created_at" => date('Y-m-d H:i:s')
        ]);
    }
}
