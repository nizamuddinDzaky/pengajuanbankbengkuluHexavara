<?php

namespace App\Http\Controllers;

use App\Http\Service\UploadService;
use App\Produk;
use App\SukuBunga;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;
use Illuminate\Support\Facades\Session;

class ProdukKreditController extends Controller
{

    protected $UploadService;
    public function __construct(UploadService $UploadService)
    {
        $this->UploadService = $UploadService;
    }

    public function index(){

        $jumlah_produk = Produk::count();

        $produk = Produk::all();

        return view('adminpusat.produk_kredit', get_defined_vars());
    }

    public function store(Request $request){
        $validated = $request->validate([
            'nama_produk' => ['required', Rule::unique('produk', 'nama')],
            'penjelasan' => 'required',
            'suku_bunga' => 'required',
        ]);

        DB::beginTransaction();

        try {

            $produk = new Produk();
            $produk->nama = $request->nama_produk;
            $produk->deskripsi = $request->penjelasan;
            $produk->jenis_suku_bunga = $request->suku_bunga;
            $produk->path_file = json_encode([
                "akad" => null,
                "blangko" => Session::get('dokumen'),
                "blangko_pdf" => Session::get('template')
            ]);


            if ($produk->save()){

                if ($request->suku_bunga == "berjangka"){

                    $tahun_awal = $request->tahun_awal;
                    $tahun_akhir = $request->tahun_akhir;
                    $bunga_berjangka = $request->bunga_berjangka;


                    for ($i = 0 ; $i < count($tahun_awal) ; $i++){

                        if ($i == 0){
                            $bulan_awal = (int)$tahun_awal[$i] * 12;
                        }else{
                            $bulan_awal = (int)$tahun_awal[$i] * 12 + 1;
                        }

                        $bulan_akhir = (int)$tahun_akhir[$i] * 12;
                        $suku_bunga = new SukuBunga();
                        $suku_bunga->dari_bulan = $bulan_awal;
                        $suku_bunga->sampai_bulan = $bulan_akhir;
                        $suku_bunga->produk_id = $produk->id;
                        $suku_bunga->bunga = str_replace(",",".",$bunga_berjangka[$i]);
                        $suku_bunga->save();

                    }

                    DB::commit();
                    session()->flash('success', "Berhasil Menambah Produk");
                    return redirect()->back();

                }elseif ($request->suku_bunga == "flat"){

                    $suku_bunga = new SukuBunga();
                    $suku_bunga->bunga = $request->bunga_flat;
                    $suku_bunga->produk_id = $produk->id;

                    if ($suku_bunga->save()){
                        DB::commit();
                        session()->flash('success', "Berhasil Menambah Produk");
                        return redirect()->back();
                    }else{
                        DB::rollback();
                        session()->flash('error', "Gagal Menambah Produk");
                        return redirect()->back();
                    }

                }

            }else{
                session()->flash('error', "Gagal Menambah Produk");
                DB::rollback();
                return redirect()->back();
            }
        }catch (\Exception $ex){
            session()->flash('error', "Gagal Menambah Produk");
            DB::rollback();
            return redirect()->back();
        }

    }

    public function update(Request $request){

        $validated = $request->validate([
            'nama_produk' => ['required', Rule::unique('produk', 'nama')->ignore($request->produk_id)],
        ]);



        DB::beginTransaction();

        try {

            $produk = Produk::find($request->produk_id);
            $produk->nama = $request->nama_produk;
            $produk->deskripsi = $request->penjelasan;
            $produk->jenis_suku_bunga = $request->suku_bunga;
            if ($request->fileTemplate != null){
                $blangko_pdf = $request->fileTemplate;
            }else{
                $blangko_pdf = Session::get('template');
            }

            if ($request->fileDokumen != null){
                $blangko = $request->fileDokumen;
            }else{
                $blangko = Session::get('dokumen');
            }

            $produk->path_file = json_encode([
                "akad" => null,
                "blangko" => $blangko,
                "blangko_pdf" => $blangko_pdf
            ]);


            if ($produk->save()){

                if ($request->suku_bunga == "berjangka"){
                    SukuBunga::where('produk_id', $request->produk_id)->delete();

                    $tahun_awal = $request->tahun_awal;
                    $tahun_akhir = $request->tahun_akhir;
                    $bunga_berjangka = $request->bunga_berjangka;


                    for ($i = 0 ; $i < count($tahun_awal) ; $i++){

                        if ($i == 0){
                            $bulan_awal = (int)$tahun_awal[$i] * 12;
                        }else{
                            $bulan_awal = (int)$tahun_awal[$i] * 12 + 1;
                        }

                        $bulan_akhir = (int)$tahun_akhir[$i] * 12;
                        $suku_bunga = new SukuBunga();
                        $suku_bunga->dari_bulan = $bulan_awal;
                        $suku_bunga->sampai_bulan = $bulan_akhir;
                        $suku_bunga->produk_id = $produk->id;
                        $suku_bunga->bunga = str_replace(",",".",$bunga_berjangka[$i]);
                        $suku_bunga->save();

                    }

                    DB::commit();
                    session()->flash('success', "Berhasil Mengedit Produk");
                    return redirect()->back();

                }elseif ($request->suku_bunga == "flat"){

                    SukuBunga::where('produk_id', $request->produk_id)->delete();

                    $suku_bunga = new SukuBunga();
                    $suku_bunga->bunga = str_replace(",", ".",$request->bunga_flat );
                    $suku_bunga->produk_id = $produk->id;

                    if ($suku_bunga->save()){
                        DB::commit();
                        session()->flash('success', "Berhasil Mengedit Produk");
                        return redirect()->back();
                    }else{
                        DB::rollback();
                        session()->flash('error', "Gagal Mengedit Produk");
                        return redirect()->back();
                    }

                }

            }else{
                session()->flash('error', "Gagal Mengedit Produk");
                DB::rollback();
                return redirect()->back();
            }
        }catch (\Exception $ex){
            session()->flash('error', "Gagal Mengedit Produk");
            DB::rollback();
            return redirect()->back();
        }
    }


    public function uploadBlangko(Request $request){
        $this->UploadService->unggahBlangkoProduk($request);
    }

    public function getDetail(Request $request){
        $produk = Produk::find($request->id);
        if($produk->jenis_suku_bunga == "berjangka"){
            $suku_bunga = SukuBunga::where('produk_id', $request->id)->get();
        }else{
            $suku_bunga = SukuBunga::where('produk_id', $request->id)->first();
        }

        return response()->json([$produk, $suku_bunga]);
    }


}
