<?php

namespace App\Http\Controllers;

use App\Kabkot;
use App\Kantor;
use App\Kecamatan;
use App\Kelurahan;
use App\Provinsi;
use App\SukuBunga;
use App\Transaksi;
use App\User;
use App\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Service\UploadService;

class PengajuanController extends Controller
{

    protected $UploadService;
    public function __construct(UploadService $UploadService)
    {
        $this->UploadService = $UploadService;
    }



    public function index(){


        $user = User::find(Auth::user()->id);

        if ($user->path_file == null){
            $fileNull = [
                'ktp' => null,
                'pas_foto' => null,
                'npwp' => null,
            ];

            $user->path_file = json_encode($fileNull);
            $user->save();
        }


        $provinsi = Provinsi::all();
        $kabkot = Kabkot::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        $produk = Produk::all();
        $cabang = Kantor::all();
        $transaksi = DB::table('transaksi')
            ->where('pemohon_id', Auth::user()->id)
            ->where('status', 0)->first();

        $customer_service_konfirmasi = DB::table('transaksi as t')
            ->join('users as u', 'u.id', 't.cs_id')
            ->where('pemohon_id', Auth::user()->id)
            ->where('status', 0)
            ->select('u.name')->first();

        $cabang_konfirmasi = DB::table('transaksi as t')
            ->join('kantor as k', 'k.id', 't.kantor_id')
            ->where('pemohon_id', Auth::user()->id)
            ->where('status', 0)
            ->select('k.nama_kantor')->first();

        $kode_pos_konfirmasi = DB::table('kelurahan')
            ->where('id', Auth::user()->kelurahan_id)
            ->select('kd_pos as kode_pos')
            ->first();


        if ($transaksi == null){
            $data = [
                "kartu_keluarga" => null,
                "ktp_pasangan" => null,
                "pas_foto_pasangan" => null,
                "buku_nikah" => null,
                "buku_tabungan" => null,
                "jaminan_shm" => null,
                "dokumen_spt" => null,
                "no_shm_bpkb" => null,
            ];


            $data_kredit = [
              "gaji_terakhir" => null,
              "struk_gaji_bulan_terakhir" => null,
              "SK" => null,
              "SK_DPRD" => null,
              "SK_perangkat_desa" => null,
              "SK_CAPEG" => null,
              "SK_pegawai_tetap" => null,
              "SK_pangkat_terakhir" => null,
              "SK_berkala_terakhir" => null,
              "SK_pensiun" => null,
              "kartu_pegawai" => null,
              "kartu_taspen" => null,
              "kartu_identitas_pensiun" => null,
              "ampra_gaji_bulan_terakhir" => null,
              "surat_kuasa_pensiun" => null,
              "no_SK" => null,
              "no_SK_DPRD" => null,
              "no_SK_perangkat_desa" => null,
              "no_SK_CAPEG" => null,
              "no_SK_pegawai_tetap" => null,
              "no_SK_pangkat_terakhir" => null,
              "no_SK_berkala_terakhir" => null,
              "no_SK_pensiun" => null,
            ];

            $transaksi = new Transaksi();
            $transaksi->pemohon_id = Auth::user()->id;
            $transaksi->status = 0;
            $transaksi->path_file_dokumen_saya = json_encode($data);
            $transaksi->path_file = json_encode($data_kredit);
            $transaksi->save();
        }

        $pangkat = config('pangkat');


        //get non weekend date for tanggal verifikasi
       $dateVerifikasi = Carbon::now();
       if ($dateVerifikasi->isWeekend()){
           if ($dateVerifikasi->dayOfWeek == Carbon::SATURDAY){
               $dateVerifikasi->addDays(2);
           }else{
               $dateVerifikasi->addDays(1);
           }
       }

       $dateVerifikasi =  $dateVerifikasi->toDateString();

        return view('user.pengajuan', get_defined_vars());


    }


    public function insertFormulirPengajuan(Request $request){

        $transaksi = DB::table('transaksi')
            ->where('pemohon_id', Auth::user()->id)
            ->where('status', 0)
            ->select('id')->first();

        $transaksi = Transaksi::find($transaksi->id);
        $transaksi->penghasilan = str_replace(".", "",$request->penghasilan);
        $transaksi->masa_tenor =  $request->jangka_waktu_kredit;
        $transaksi->produk_id = $request->produk;
        $transaksi->keperluan_pinjaman = $request->keperluan_pinjaman;
        $transaksi->suku_bunga = (double)$request->suku_bunga;
        $transaksi->jumlah_angsuran = str_replace(".", "",$request->jumlah_angsuran);
        $transaksi->max_plafond = str_replace(".", "",$request->max_plafond);
        $transaksi->plafond = str_replace(".", "",$request->nominal_pengajuan);

        if ($transaksi->save()){
            return response()->json('success');
        }else{
            return response()->json('error');
        }

    }

    public function insertBiodataDiri(Request $request){
        DB::beginTransaction();
        try {
            $user = User::find(Auth::user()->id);
            $transaksi = Transaksi::where('pemohon_id', Auth::user()->id)->where('status', 0)->first();
            if ($request->tipe == "multiguna"){
                //update biodata
                $user->name = $request->name;
                $user->email = $request->email;
                $user->no_ktp = $request->no_ktp;
                $user->no_hp = $request->no_hp;
                $user->tempat_lahir = $request->tempat_lahir;
                $user->tanggal_lahir = $request->tanggal_lahir;
                $user->provinsi_id = $request->provinsi;
                $user->kabkot_id = $request->kabkot;
                $user->kecamatan_id = $request->kecamatan;
                $user->kelurahan_id = $request->kelurahan;
                $user->alamat = $request->alamat;
                $user->jenis_kelamin = $request->jenis_kelamin;
                $user->pekerjaan = $request->pekerjaan;
                $user->npwp = $request->no_npwp;

                if ($user->save()){
                    //update wajib
                    $biodata = [
                        "nama_ibu_kandung" => $request->nama_ibu_kandung,
                        'status_perkawinan' => $request->status_perkawinan,
                        'agama' => $request->agama,
                        'pendidikan' => $request->pendidikan,
                        'kewarganegaraan' => $request->kewarganegaraan,
                        'no_telp_rumah' => $request->no_telp_rumah,
                        'status_kepemilikan_rumah' => $request->status_kepemilikan_rumah,
                        'kantor' => $request->kantor,
                        'alamat_kantor' => $request->alamat_kantor,
                        'no_telp_kantor' => $request->no_telp_kantor,
                        'lama_bekerja' => $request->lama_bekerja,
                        'jabatan' => $request->jabatan,
                        'pangkat' => $request->pangkat,
                        'NIP' => $request->NIP,
                        'nama_panggilan' => $request->nama_panggilan,
                        'masa_berlaku_ktp' => $request->masa_berlaku_ktp,
                        'keterangan_gelar' => $request->keterangan_gelar,
                        'no_fax_kantor' => $request->no_fax_kantor,
                        'email_kantor' => $request->email_kantor,
                        'nama_pasangan' => $request->nama_pasangan,
                        'no_ktp_pasangan' => $request->no_ktp_pasangan,
                        'pekerjaan_pasangan' => $request->pekerjaan_pasangan,
                        'alamat_nohp_pasangan' => $request->alamat_nohp_pasangan,
                        'hubungan' => $request->hubungan,
                        'jumlah_anak' => $request->jumlah_anak,
                    ];



                    $transaksi->biodata = json_encode($biodata);
                    if ($transaksi->save()){
                        DB::commit();
                        return response()->json('success');
                    }
                }
            }elseif($request->tipe == "kredit_guna_usaha"){
                $user->name = $request->name;
                $user->tempat_lahir = $request->tempat_lahir;
                $user->tanggal_lahir = $request->tanggal_lahir;
                $user->alamat = $request->alamat;
                $user->npwp = $request->no_npwp;

                if ($user->save()){
                    $biodata = [
                        "nama_ibu_kandung" => $request->nama_ibu_kandung,
                        'kewarganegaraan' => $request->kewarganegaraan,
                        'no_telp_rumah' => $request->no_telp_rumah,
                        'NIP' => $request->NIP,
                        'nama_pasangan' => $request->nama_pasangan,
                        'no_ktp_pasangan' => $request->no_ktp_pasangan,
                        'status_usaha' => $request->status_usaha,
                        'nama_usaha' => $request->nama_usaha,
                        'jenis_usaha' => $request->jenis_usaha,
                        'alamat_usaha' => $request->alamat_usaha,
                        'instansi' => $request->instansi,
                        'alamat_instansi' => $request->alamat_instansi,
                        'pendapatan_per_bulan' => $request->pendapatan_per_bulan,
                        'keuntungan_per_bulan' => $request->keuntungan_per_bulan,
                        'biaya_sekolah' => $request->biaya_sekolah,
                        'biaya_konsumsi_keluarga' => $request->biaya_konsumsi_keluarga,
                        'listrik_air_telepon' => $request->listrik_air_telepon,
                    ];


                    $transaksi->biodata = json_encode($biodata);
                    if ($transaksi->save()){
                        DB::commit();
                        return response()->json('success');
                    }

                }


            }
        }catch (\Exception $ex){
            DB::rollBack();
            return response()->json($ex->getMessage());
        }








    }





    public function getSukuBunga(Request $request){

        $produk = $request->produk;
        $jangka_waktu = $request->jangka_waktu;

        $suku_bunga = SukuBunga::where('produk_id', $produk)->get();
        $index = 0;

        foreach ($suku_bunga as $keys => $data){
            if ($jangka_waktu >= $data->dari_bulan && $jangka_waktu <= $data->sampai_bulan){
                $index = $keys;
            }
        }

        $bunga = $suku_bunga[$index]->bunga;


        return response()->json($bunga);
    }


    public function getJumlahAngsuran(Request $request){
        $nominal = (double)$request->nominal;
        $jangka_waktu = (int)$request->jangka_waktu;
        $suku_bunga = (double)$request->suku_bunga / 12 / 100;


        if ($nominal == 0 || $jangka_waktu == "" || $suku_bunga == 0){
            $result = 0;
        }else{
            $result = $suku_bunga * $nominal*(pow(1+$suku_bunga,$jangka_waktu)) / (((pow(1+ $suku_bunga, $jangka_waktu) - 1)));
        }


        return response()->json(round($result));
    }

    public function getPlafond(Request $request){

        $penghasilan = $request->penghasilan;
        $jangka_waktu = $request->jangka_waktu;


        return response()->json($penghasilan*$jangka_waktu);
    }

    public function getJenisProduk(Request $request){
        $id = Auth::user()->id;
        $data = "";

        $transaksi = DB::table('transaksi as t')
            ->join('produk as p', 'p.id', 't.produk_id')
            ->select('p.nama')
            ->where('t.pemohon_id', $id)
            ->first();




        if (strpos($transaksi->nama,'Multiguna') !== false){
            $data = 'multiguna';
        }else if(strpos($transaksi->nama,'Kredit Guna Usaha') !== false){
            $data = 'kredit_guna_usaha';
        }


        return response()->json($data);

    }

    public function getNamaProduk(){

        $transaksi = DB::table('transaksi as t')
            ->join('produk as p', 'p.id', 't.produk_id')
            ->select('p.nama')
            ->where('t.pemohon_id', Auth::user()->id)
            ->first();

        return response()->json($transaksi->nama);
    }

    public function getStatusKawin(Request $request){

        $transaksi = Transaksi::where('pemohon_id', Auth::user()->id)->where('status', 0)->first();
        $data = json_decode($transaksi->biodata)->status_perkawinan;
        return response()->json($data);

    }

    public function getStatusJaminan(Request $request){

        $transaksi = DB::table('transaksi as t')
            ->join('produk as p', 'p.id', 't.produk_id')
        ->where('pemohon_id', Auth::user()->id)
            ->where('status', 0)
            ->select('p.nama', 't.plafond')
            ->first();

        if ($transaksi->nama == "Multiguna Perangkat Desa"){
            if ($transaksi->plafond > 25000000){
                return response()->json(true);
            }else{
                return response()->json(false);
            }
        }else
        {
            if ($transaksi->plafond > 400000000){
                return response()->json(true);
            }else{
                return response()->json(false);
            }
        }

    }


    public function getThumbnail(Request $request){
        $file_list = $this->UploadService->getThumbnail($request);
        return response()->json($file_list);

    }

    public function uploadDokumenSaya(Request $request){
        $this->UploadService->uploadDokumenSaya($request->jenis, $request);
    }

    public function uploadDokumenKredit(Request $request){
        $this->UploadService->uploadDokumenKredit($request->jenis, $request);
    }

    public function insertNoSHM(Request $request){

        $transaksi = Transaksi::where('pemohon_id', Auth::user()->id)->where('status', 0)->first();
        $noshm = json_decode($transaksi->path_file_dokumen_saya, true);
        $noshm['no_shm_bpkb'] = $request->data;
        $transaksi->path_file_dokumen_saya = json_encode($noshm);

        if ( $transaksi->save()){
            return response()->json("success");
        }else{
            return response()->json("error");
        }

    }

    public function insertNoSK(Request $request){

        $data = $request->data;
        $tipe = $request->tipe;
        $transaksi = Transaksi::where('pemohon_id', Auth::user()->id)->where('status', 0)->first();
        $noshm = json_decode($transaksi->path_file, true);
        foreach ($data as $keys => $value){
            $noshm[$tipe[$keys]] = $value;
        }

        $transaksi->path_file = json_encode($noshm);

        if ( $transaksi->save()){
            return response()->json("success");
        }else{
            return response()->json("error");
        }


    }



    public function getSlotWaktu(Request $request){

        $customer_service = $request->customer_service;
        $tanggal = $request->tanggal;
        //need to change this
        $durasi = Kantor::where('parent',0)->select('durasi_layanan_cs')->first();
        $durasi = $durasi->durasi_layanan_cs;

        $transaksi = Transaksi::where('tanggal', $tanggal)
            ->where('jam_mulai', '<>' , null)
            ->where('jam_selesai', '<>' , null)
            ->where('cs_id', $customer_service)
            ->where('status', '<>', 0)
            ->get();

        $arrayPenampung = [];
        $awal = Carbon::createFromTime(8);
        $akhir = Carbon::createFromTime(15);

        while ($awal < $akhir) {

            if ($transaksi != null){
                $checker = 0;
                foreach ($transaksi as $data){

                    if ($data->jam_mulai == $awal->format('H:i:s') &&  $data->jam_selesai == $awal->addMinutes($durasi)->format('H:i:s')){
                        $checker += 1;
                    }
                }

                if ($checker == 0){
                    $data = $awal->format('H:i') . ' - ' . $awal->addMinutes($durasi)->format('H:i');
                    array_push($arrayPenampung, $data);
                }

            }else{
                $data = $awal->format('H:i') . ' - ' . $awal->addMinutes($durasi)->format('H:i');

                array_push($arrayPenampung, $data);
            }

        }


        return response()->json($arrayPenampung);




    }


    public function getCustomerService(Request $request){

        $kantor_id = $request->id;

        $customer_service = DB::table('users as u')
            ->join('user_role as us', 'us.user_id', 'u.id')
            ->join('role as r', 'r.id', 'us.role_id')
            ->where('r.role', "CustomerService")
            ->where('u.kantor_id', $kantor_id)
            ->select('u.id', 'u.name')
            ->get();

        return response()->json($customer_service);
    }


    public function insertTahapAkhir(Request $request){


        $cabang = $request->cabang;
        $cs = $request->cs;
        $tanggal = $request->jadwal;
        $slot = $request->slot;

        $slot = explode('-', $slot);
        $jam_mulai = explode(' ', $slot[0]);
        $jam_selesai = explode(' ', $slot[1]);


        $transaksi = Transaksi::where('pemohon_id', Auth::user()->id)->where('status', 0)->first();
        $transaksi->cs_id = $cs;
        $transaksi->kantor_id = $cabang;
        $transaksi->jam_mulai = $jam_mulai[0];
        $transaksi->jam_selesai = $jam_selesai[1];
        $transaksi->tanggal = $tanggal;

        if ($transaksi->save()){
            return response()->json('success');
        }else{
            return response()->json('error');
        }



    }

    public function konfirmasiPengajuan(){
        $transaksi = Transaksi::where('pemohon_id', Auth::user()->id)->where('status', 0)->first();
        $kode_cabang = str_pad($transaksi->kantor_id, 3, "0", STR_PAD_LEFT);

        $durasi = Kantor::where('parent',0)->select('durasi_layanan_cs')->first();
        $durasi = $durasi->durasi_layanan_cs;

//        $transaksi = Transaksi::where('tanggal', $tanggal)
//            ->where('jam_mulai', '<>' , null)
//            ->where('jam_selesai', '<>' , null)
//            ->where('cs_id', $customer_service)
//            ->where('status', '<>', 0)
//            ->get();
//
//        $arrayPenampung = [];
//        $awal = Carbon::createFromTime(8);
//        $akhir = Carbon::createFromTime(15);
//
//        while ($awal < $akhir) {
//
//            if ($transaksi != null){
//                $checker = 0;
//                foreach ($transaksi as $data){
//
//                    if ($data->jam_mulai == $awal->format('H:i:s') &&  $data->jam_selesai == $awal->addMinutes($durasi)->format('H:i:s')){
//                        $checker += 1;
//                    }
//                }
//
//                if ($checker == 0){
//                    $data = $awal->format('H:i') . ' - ' . $awal->addMinutes($durasi)->format('H:i');
//                    array_push($arrayPenampung, $data);
//                }
//
//            }else{
//                $data = $awal->format('H:i') . ' - ' . $awal->addMinutes($durasi)->format('H:i');
//
//                array_push($arrayPenampung, $data);
//            }
//
//        }
//
//
//
//
//        $nomor_antrian =
        $transaksi->status = 1;


        if ($transaksi->save()){
            session()->flash('success', 'Berhasil Membuat Pengajuan');
            return redirect('/user/daftar_pengajuan');
        }else{
            session()->flash('error', 'Gagal Membuat Pengajuan');
            return redirect()->back();
        }




    }


}
