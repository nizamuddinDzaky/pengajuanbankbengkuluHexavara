<?php

namespace App\Http\Controllers;

use App\Kantor;
use App\Transaksi;
use Carbon\Carbon;
use App\User;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Settings;
use DB;


class DokumenController extends Controller
{
    public function generateMultigunaAktif(Request $request){

        $transaksi_id = 1;
        $transaksi = Transaksi::where('id', $transaksi_id)->first();
        $user = User::where('id', $transaksi->pemohon_id)->first();
        $kantor = Kantor::where('id', $transaksi->kantor_id)->first();

        //get bulan awal
        $bulan_awal = $transaksi->tanggal;
        $bulan_awal = Carbon::createFromFormat('Y-m-d', $bulan_awal)->locale('id');
        $bulan_awal->settings(['formatFunction' => 'translatedFormat']);
        $bulan_awal = $bulan_awal->addMonth(1)->format('F');


        //get bulan akhir
        $bulan_akhir = $transaksi->tanggal;
        $bulan_akhir = Carbon::createFromFormat('Y-m-d', $bulan_akhir)->locale('id');
        $bulan_akhir->settings(['formatFunction' => 'translatedFormat']);
        $bulan_akhir = $bulan_akhir->addMonth($transaksi->masa_tenor + 1)->format('F');

        //get alamat lengkap
        $kecamatan = DB::table('users')->join('kecamatan', 'users.kecamatan_id', 'kecamatan.id')->select('kecamatan.kecamatan')->first();
        $kelurahan = DB::table('users')->join('kelurahan', 'users.kelurahan_id', 'kelurahan.id')->select('kelurahan.kelurahan', 'kelurahan.kd_pos')->first();
        $provinsi = DB::table('users')->join('provinsi', 'users.provinsi_id', 'provinsi.id')->select('provinsi.provinsi')->first();
        $kabkot = DB::table('users')->join('kabkot', 'users.kabkot_id', 'kabkot.id')->select('kabkot.kabupaten_kota')->first();



        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path('blangko/blangko_multiguna_aktif.docx'));
        Settings::setOutputEscapingEnabled(true);
        $data = [
            "tanggal" => Carbon::now()->locale('id')->isoFormat('LL'),
            "nama_nasabah" => $user->name,
            "nip_nasabah" => json_decode($transaksi->biodata)->NIP,
            "tempat_tanggal_lahir_nasabah" => $user->tempat_lahir.', '.Carbon::createFromFormat('Y-m-d',$user->tanggal_lahir)->locale('id')->isoFormat('LL'),
            "no_ktp_nasabah" => $user->no_ktp,
            "pekerjaan_nasabah" => $user->pekerjaan,
            "instansi_nasabah" => json_decode($transaksi->biodata)->kantor,
            "alamat_kantor_nasabah" => json_decode($transaksi->biodata)->alamat_kantor,
            "no_telepon_kantor_nasabah" => json_decode($transaksi->biodata)->no_telp_kantor,
            "alamat_rumah_nasabah" => $user->alamat,
            "no_telepon_nasabah" => $user->no_hp,
            "nama_ibu_kandung_nasabah" => json_decode($transaksi->biodata)->nama_ibu_kandung,
            "plafond" => number_format($transaksi->plafond),
            "nominal_plafond" =>  $this->uangToKalimat($transaksi->plafond),
            "keperluan_nasabah" => $transaksi->keperluan_pinjaman,
            "nama_cabang" => $kantor->nama_kantor,
            "tenor" => $transaksi->masa_tenor,
            "tenor_kata" => $this->uangToKalimat($transaksi->masa_tenor),
            "jabatan_nasabah" =>  json_decode($transaksi->biodata)->jabatan,
            "jumlah_angsuran_nasabah" => number_format($transaksi->jumlah_angsuran),
            "bulan_awal" => $bulan_awal,
            "bulan_akhir" => $bulan_akhir,
            "nama_pasangan_nasabah" => json_decode($transaksi->biodata)->nama_pasangan,
            "pekerjaan_pasangan_nasabah" => json_decode($transaksi->biodata)->pekerjaan_pasangan,
            "alamat_pasangan_nasabah" =>json_decode($transaksi->biodata)->alamat_nohp_pasangan,
            "nama_panggilan_nasabah" =>json_decode($transaksi->biodata)->nama_panggilan,
            "tempat_lahir_nasabah" => $user->tempat_lahir,
            "tanggal_lahir_nasabah" => Carbon::createFromFormat('Y-m-d',$user->tanggal_lahir)->locale('id')->isoFormat('LL'),
            "no_telepon_rumah_nasabah" => json_decode($transaksi->biodata)->no_telp_rumah,
            "no_telepon_hp_email" => $user->no_hp." / ".$user->email,
            "status_perkawinan_nasabah" => json_decode($transaksi->biodata)->status_perkawinan,
            "jumlah_anak_nasabah" => json_decode($transaksi->biodata)->jumlah_anak,
            "agama_nasabah" => json_decode($transaksi->biodata)->agama,
            "keterangan_gelar_nasabah" => json_decode($transaksi->biodata)->keterangan_gelar,
            "no_npwp_nasabah" => $user->npwp,
            "kewarganegaraan_nasabah" => json_decode($transaksi->biodata)->kewarganegaraan,
            "status_kepemilikan_rumah_nasabah" => json_decode($transaksi->biodata)->status_kepemilikan_rumah,
            "kelurahan_nasabah" => $kelurahan->kelurahan,
            "kecamatan_nasabah" => $kecamatan->kecamatan,
            "kabkot_nasabah" => $kabkot->kabupaten_kota,
            "provinsi_nasabah" => $provinsi->provinsi,
            "kode_pos_nasabah" => $kelurahan->kd_pos,
            "masa_berlaku_ktp_nasabah" => Carbon::createFromFormat('Y-m-d',json_decode($transaksi->biodata)->masa_berlaku_ktp)->locale('id')->isoFormat('LL'),
            "no_fax_kantor_nasabah" => json_decode($transaksi->biodata)->no_fax_kantor,
            "email_kantor_nasabah" => json_decode($transaksi->biodata)->email_kantor,
            "lama_bekerja_nasabah" => json_decode($transaksi->biodata)->lama_bekerja,
            "pangkat_nasabah" => json_decode($transaksi->biodata)->pangkat,
            "no_ktp_pasangan_nasabah" => json_decode($transaksi->biodata)->no_ktp_pasangan,
            "hubungan_pasangan_nasabah" => json_decode($transaksi->biodata)->hubungan,
            "jenis_kelamin_nasabah" => $user->jenis_kelamin,
            "pendidikan_nasabah" => json_decode($transaksi->biodata)->pendidikan


        ];


        $filename = "blangko_multiguna_aktif.docx";
        $templateProcessor->setValues($data);
        header("Content-Disposition: attachment; filename=$filename");
        $templateProcessor->saveAs('php://output');



    }







    public function uangToKalimat($bilangan){
        $angka = array('0','0','0','0','0','0','0','0','0','0',
            '0','0','0','0','0','0');
        $kata = array('','satu','dua','tiga','empat','lima',
            'enam','tujuh','delapan','sembilan');
        $tingkat = array('','ribu','juta','milyar','triliun');

        $panjang_bilangan = strlen($bilangan);

        /* pengujian panjang bilangan */
        if ($panjang_bilangan > 15) {
            $kalimat = "Diluar Batas";
            return $kalimat;
        }

        /* mengambil angka-angka yang ada dalam bilangan,
           dimasukkan ke dalam array */
        for ($i = 1; $i <= $panjang_bilangan; $i++) {
            $angka[$i] = substr($bilangan,-($i),1);
        }

        $i = 1;
        $j = 0;
        $kalimat = "";


        /* mulai proses iterasi terhadap array angka */
        while ($i <= $panjang_bilangan) {

            $subkalimat = "";
            $kata1 = "";
            $kata2 = "";
            $kata3 = "";

            /* untuk ratusan */
            if ($angka[$i+2] != "0") {
                if ($angka[$i+2] == "1") {
                    $kata1 = "seratus";
                } else {
                    $kata1 = $kata[$angka[$i+2]] . " ratus";
                }
            }

            /* untuk puluhan atau belasan */
            if ($angka[$i+1] != "0") {
                if ($angka[$i+1] == "1") {
                    if ($angka[$i] == "0") {
                        $kata2 = "sepuluh";
                    } elseif ($angka[$i] == "1") {
                        $kata2 = "sebelas";
                    } else {
                        $kata2 = $kata[$angka[$i]] . " belas";
                    }
                } else {
                    $kata2 = $kata[$angka[$i+1]] . " puluh";
                }
            }

            /* untuk satuan */
            if ($angka[$i] != "0") {
                if ($angka[$i+1] != "1") {
                    $kata3 = $kata[$angka[$i]];
                }
            }

            /* pengujian angka apakah tidak nol semua,
               lalu ditambahkan tingkat */
            if (($angka[$i] != "0") OR ($angka[$i+1] != "0") OR
                ($angka[$i+2] != "0")) {
                $subkalimat = "$kata1 $kata2 $kata3 " . $tingkat[$j] . " ";
            }

            /* gabungkan variabe sub kalimat (untuk satu blok 3 angka)
               ke variabel kalimat */
            $kalimat = $subkalimat . $kalimat;
            $i = $i + 3;
            $j = $j + 1;

        }

        /* mengganti satu ribu jadi seribu jika diperlukan */
        if (($angka[5] == "0") AND ($angka[6] == "0")) {
            $kalimat = str_replace("satu ribu","seribu",$kalimat);
        }

        return trim($kalimat);
    }





}
