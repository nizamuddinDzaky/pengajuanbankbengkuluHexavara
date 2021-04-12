<?php

use App\Kecamatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kecamatan::truncate();
        // DB::table('kecamatan')->delete();
        DB::insert("INSERT INTO `kecamatan` VALUES (1437,116,'Air Nipis'),(1438,116,'Bunga Mas'),(1439,116,'Kedurang'),(1440,116,'Kedurang Ilir'),(1441,116,'Kota Manna'),(1442,116,'Manna'),(1443,116,'Pasar Manna'),(1444,116,'Pino'),(1445,116,'Pinoraya'),(1446,116,'Seginim'),(1447,116,'Ulu Manna'),(1448,117,'Bang Haji'),(1449,117,'Karang Tinggi'),(1450,117,'Merigi Kelindang'),(1451,117,'Merigi Sakti'),(1452,117,'Pagar Jati'),(1453,117,'Pematang Tiga'),(1454,117,'Pondok Kelapa'),(1455,117,'Pondok Kubang'),(1456,117,'Taba Penanjung'),(1457,117,'Talang Empat'),(1458,118,'Air Besi'),(1459,118,'Air Napal'),(1460,118,'Air Padang'),(1461,118,'Arga Makmur'),(1462,118,'Arma Jaya'),(1463,118,'Batik Nau'),(1464,118,'Enggano'),(1465,118,'Giri Mulia'),(1466,118,'Hulu Palik'),(1467,118,'Kerkap'),(1468,118,'Ketahun'),(1469,118,'Lais'),(1470,118,'Napal Putih'),(1471,118,'Padang Jaya'),(1472,118,'Putri Hijau'),(1473,118,'Tanjung Agung Palik'),(1474,118,'Ulok Kupai'),(1475,119,'Kaur Selatan'),(1476,119,'Kaur Tengah'),(1477,119,'Kaur Utara'),(1478,119,'Kelam Tengah'),(1479,119,'Kinal'),(1480,119,'Luas'),(1481,119,'Lungkang Kule'),(1482,119,'Maje'),(1483,119,'Muara Sahung'),(1484,119,'Nasal'),(1485,119,'Padang Guci Hilir'),(1486,119,'Padang Guci Hulu'),(1487,119,'Semidang Gumai (Gumay)'),(1488,119,'Tanjung Kemuning'),(1489,119,'Tetap (Muara Tetap)'),(1490,120,'Bermani Ilir'),(1491,120,'Kebawetan'),(1492,120,'Kepahiang'),(1493,120,'Merigi'),(1494,120,'Muara Kemumu'),(1495,120,'Seberang Musi'),(1496,120,'Tebat Karai'),(1497,120,'Ujan Mas'),(1498,121,'Amen'),(1499,121,'Bingin Kuning'),(1500,121,'Lebong Atas'),(1501,121,'Lebong Sakti'),(1502,121,'Lebong Selatan'),(1503,121,'Lebong Tengah'),(1504,121,'Lebong Utara'),(1505,121,'Pelabai'),(1506,121,'Pinang Belapis'),(1507,121,'Rimbo Pengadang'),(1508,121,'Topos'),(1509,121,'Uram Jaya'),(1510,122,'Air Dikit'),(1511,122,'Air Majunto'),(1512,122,'Air Rami'),(1513,122,'Ipuh (Muko-Muko Selatan)'),(1514,122,'Kota Mukomuko (Mukomuko Utara)'),(1515,122,'Lubuk Pinang'),(1516,122,'Malin Deman'),(1517,122,'Penarik'),(1518,122,'Pondok Suguh'),(1519,122,'Selagan Raya'),(1520,122,'Sungai Rumbai'),(1521,122,'Teramang Jaya'),(1522,122,'Teras Terunjam'),(1523,122,'V Koto'),(1524,122,'XIV Koto'),(1525,123,'Bermani Ulu'),(1526,123,'Bermani Ulu Raya'),(1527,123,'Binduriang'),(1528,123,'Curup'),(1529,123,'Curup Selatan'),(1530,123,'Curup Tengah'),(1531,123,'Curup Timur'),(1532,123,'Curup Utara'),(1533,123,'Kota Padang'),(1534,123,'Padang Ulak Tanding'),(1535,123,'Selupu Rejang'),(1536,123,'Sindang Beliti Ilir'),(1537,123,'Sindang Beliti Ulu'),(1538,123,'Sindang Daratan'),(1539,123,'Sindang Kelingi'),(1540,124,'Air Periukan'),(1541,124,'Ilir Talo'),(1542,124,'Lubuk Sandi'),(1543,124,'Seluma'),(1544,124,'Seluma Barat'),(1545,124,'Seluma Selatan'),(1546,124,'Seluma Timur'),(1547,124,'Seluma Utara'),(1548,124,'Semidang Alas'),(1549,124,'Semidang Alas Maras'),(1550,124,'Sukaraja'),(1551,124,'Talo'),(1552,124,'Talo Kecil'),(1553,124,'Ulu Talo'),(1554,125,'Gading Cempaka'),(1555,125,'Kampung Melayu'),(1556,125,'Muara Bangka Hulu'),(1557,125,'Ratu Agung'),(1558,125,'Ratu Samban'),(1559,125,'Selebar'),(1560,125,'Singaran Pati'),(1561,125,'Sungai Serut'),(1562,125,'Teluk Segara');");
    }
}
