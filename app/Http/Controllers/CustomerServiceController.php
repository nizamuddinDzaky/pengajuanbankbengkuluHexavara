<?php

namespace App\Http\Controllers;


use App\Kantor;
use App\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Auth;

class CustomerServiceController extends Controller
{
    public function jadwal(){

        $transaksi = DB::table('transaksi as t')
            ->join('users as u', 'u.id', 't.pemohon_id')
            ->join('produk as p', 'p.id', 't.produk_id')
            ->where('t.tanggal', Carbon::now()->toDateString())
            ->where('t.status', 2)
            ->orWhere('t.status', 5)
            ->select('t.id as transaksi_id', 't.kode_pengajuan', 'u.name', 't.plafond', 't.masa_tenor', 't.jam_mulai', 't.jam_selesai', 'p.nama')
            ->orderBy('t.jam_mulai', 'asc')
            ->where('t.cs_id', Auth::user()->id)
            ->get();



        $jumlah = $transaksi->count();


        return view('customer_service.jadwal', get_defined_vars());
    }

    public function pelayanan_nasabah(){


        $nasabah = DB::table('transaksi as t')
            ->join('users as u', 'u.id', 't.pemohon_id')
            ->join('produk as p', 'p.id', 't.produk_id')
            ->where('t.tanggal', Carbon::now()->toDateString())
            ->where(function($q) {
                $q->where('t.status', 5)
                    ->orWhere('t.status', 2);
            })
            ->select('t.id as transaksi_id', 't.kode_pengajuan', 'u.name', 't.plafond', 't.masa_tenor', 't.jam_mulai', 't.jam_selesai', 'p.nama', 't.status', 't.jam_mulai_pelayanan')
            ->orderBy('t.jam_mulai', 'asc')
            ->where('t.cs_id', Auth::user()->id)
            ->get()
            ->take(2);




        $jam = DB::table('transaksi')
            ->where('tanggal', Carbon::now()->toDateString())
            ->where(function($q) {
                $q->where('status', 2)
                    ->orWhere('status', 5);
            })
            ->select('jam_mulai')
            ->orderBy('jam_mulai', 'asc')
            ->where('cs_id', Auth::user()->id)
            ->get();



        foreach ($jam as $keys => $data){

            if (isset($nasabah[0])) {
                if ($nasabah[0]->jam_mulai == $data->jam_mulai) {
                    $nasabah[0]->sesi = $keys + 1;
                }
            }

            if (isset($nasabah[1])){
                if ($nasabah[1]->jam_mulai == $data->jam_mulai){
                    $nasabah[1]->sesi = $keys + 1;
                }
            }
        }

        $durasi = Kantor::where('parent',0)->select('durasi_layanan_cs')->first()->durasi_layanan_cs;


        if (isset($nasabah[0])){
            if ($nasabah[0]->jam_mulai_pelayanan != null){
                $nasabah[0]->status_mulai = true;
                $test = Carbon::createFromTime(substr($nasabah[0]->jam_mulai_pelayanan,0,2), substr($nasabah[0]->jam_mulai_pelayanan,3,2), substr($nasabah[0]->jam_mulai_pelayanan,6,2) );
                $nasabah[0]->durasi = (( $durasi * 60 ) -  Carbon::now()->diffInRealSeconds($test)) / 60;
            }else{
                $nasabah[0]->status_mulai = false;
            }
        }










        return view('customer_service.pelayanan_nasabah', compact('nasabah', 'durasi'));
    }

    public function mulai_pelayanan(Request $request){
        $transaksi = Transaksi::where('id', $request->id)->first();
        $transaksi->jam_mulai_pelayanan = Carbon::now()->toTimeString();
        if ($transaksi->save()){
          return response()->json(true);
        }else{
            return response()->json(false);
        }
    }

    public function selesai_pelayanan(Request $request){
        $transaksi = Transaksi::where('id', $request->transaksi_id)->first();
        $transaksi->jam_selesai_pelayanan = Carbon::now()->toTimeString();
        $transaksi->status = 3;

        if ($transaksi->save()){
            session()->flash('success', 'Berhasil Menyelesaikan Pelayanan');
            return redirect()->back();
        }else{
            session()->flash('error', 'Gagal Menyelesaikan Pelayanan');
            return redirect()->back();
        }
    }

    public function tidak_datang(Request $request){

        $transaksi = Transaksi::where('id', $request->transaksi_id)->first();
        $transaksi->jam_selesai_pelayanan = Carbon::now()->toTimeString();
        $transaksi->status = 6;

        if ($transaksi->save()){
            session()->flash('success', 'Berhasil Menyelesaikan Pelayanan');
            return redirect()->back();
        }else{
            session()->flash('error', 'Gagal Menyelesaikan Pelayanan');
            return redirect()->back();
        }




    }
}
