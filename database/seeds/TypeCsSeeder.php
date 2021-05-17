<?php

use App\TypeCs;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeCsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeCs::truncate();
        $data = [
            [
                'name'=> 'Customer Service 1',
                "updated_at" => date('Y-m-d H:i:s'),
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                'name'=> 'Customer Service 2',
                "updated_at" => date('Y-m-d H:i:s'),
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                'name'=> 'Customer Service 3',
                "updated_at" => date('Y-m-d H:i:s'),
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                'name'=> 'Customer Service 4',
                "updated_at" => date('Y-m-d H:i:s'),
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Customer Service 5',
                "updated_at" => date('Y-m-d H:i:s'),
                "created_at" => date('Y-m-d H:i:s')
            ]
        ];
        DB::table('type_cs')->insert($data);
    }
}
