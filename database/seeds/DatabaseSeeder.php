<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->call(ProvinsiSeeder::class);
        $this->call(KecamatanSeeder::class);
        $this->call(KabupatenSeeder::class);
        $this->call(KelurahanSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(KantorSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UserRoleSeeder::class);
    }
}
