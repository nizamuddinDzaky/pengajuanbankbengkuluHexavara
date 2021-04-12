<?php

use App\Kabkot;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kabkot::truncate();
        // DB::table('kabkot')->delete();
        DB::insert("INSERT INTO `kabkot` VALUES (116,7,'Kabupaten Bengkulu Selatan','Manna','MNA'),(117,7,'Kabupaten Bengkulu Tengah','Karang Tinggi','KRT'),(118,7,'Kabupaten Bengkulu Utara','Arga Makmur','AGM'),(119,7,'Kabupaten Kaur','Bintuhan','BHN'),(120,7,'Kabupaten Kepahiang','Kepahiang','KPH'),(121,7,'Kabupaten Lebong','Tubei','TUB'),(122,7,'Kabupaten Muko Muko','Mukomuko','MKM'),(123,7,'Kabupaten Rejang Lebong','Curup','CRP'),(124,7,'Kabupaten Seluma','Tais','TAS'),(125,7,'Kota Bengkulu','Bengkulu','BGL');");
    }
}
