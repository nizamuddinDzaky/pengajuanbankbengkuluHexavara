<?php

namespace App\Http\Controllers;

use App\Kabkot;
use App\Kecamatan;
use App\Kelurahan;
use App\Provinsi;
use App\SukuBunga;
use App\Transaksi;
use App\User;
use App\Produk;
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
        $transaksi = DB::table('transaksi')
            ->where('pemohon_id', Auth::user()->id)
            ->where('status', 0)->first();


        if ($transaksi == null){
            $data = [
                "kartu_keluarga" => null,
                "ktp_pasangan" => null,
                "pas_foto_pasangan" => null,
                "buku_nikah" => null,
                "buku_tabungan" => null,
                'jaminan_shm' => null,
                "dokumen_spt" => null,
            ];
            $transaksi = new Transaksi();
            $transaksi->pemohon_id = Auth::user()->id;
            $transaksi->status = 0;
            $transaksi->path_file_dokumen_saya = json_encode($data);
            $transaksi->save();
        }

        $pangkat = config('pangkat');



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
            if ($request->tipe == "multiguna"){
                //update biodata
                $user = User::find(Auth::user()->id);
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


                    $transaksi = Transaksi::where('pemohon_id', Auth::user()->id)->where('status', 0)->first();
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
            ->first();




        if (strpos($transaksi->nama,'Multiguna') !== false){
            $data = 'multiguna';
        }


        return response()->json($data);



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


}
