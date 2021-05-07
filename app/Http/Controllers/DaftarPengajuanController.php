<?php

namespace App\Http\Controllers;

use App\Kantor;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;

class DaftarPengajuanController extends Controller
{
    public function index(){


        $transaksi = DB::table('transaksi as t')
            ->join('users as u', 'u.id', 't.pemohon_id')
            ->join('produk as p' , 'p.id', 't.produk_id')
            ->where('t.pemohon_id', Auth::user()->id)
            ->where('status' , '<>', 0)
            ->orderBy('t.created_at', 'desc')
            ->select('t.id as id_transaksi', 'p.nama as nama', 't.kode_pengajuan', 'u.name', 'u.no_ktp', 'u.pekerjaan', 't.plafond', 't.jumlah_angsuran', 't.tanggal', 't.masa_tenor', 't.jam_mulai', 't.jam_selesai')
            ->paginate(5);





        $cabang = Kantor::all();

        foreach ($transaksi as $data){
            $data->countdown = Carbon::createFromFormat('Y-m-d H:i:s', $data->tanggal.' '.$data->jam_mulai)->diff(Carbon::now())->format('%m bulan %d hari %h jam %i menit');
        }


        return view('user.daftar_pengajuan.daftar_pengajuan', compact('transaksi', 'cabang'));
    }


    public function jadwalkanUlang(Request $request){

        $transaksi = Transaksi::where('id', $request->transaksi_id)->first();

        if ($transaksi->jumlah_reschedule == 3){
            $transaksi->status = 3;
            $transaksi->save();
            session()->flash('error', 'Anda mengajukan reschedule lebih dari 3 kali. Ulangi pengajuan dari awal');
            return redirect()->back();
        }


        $cabang = $request->cabang;
        $cs = $request->customer_service;
        $tanggal = $request->tanggalVerifikasi;
        $slot = $request->slotWaktu;

        $slot = explode('-', $slot);
        $jam_mulai = explode(' ', $slot[0]);
        $jam_selesai = explode(' ', $slot[1]);


        $transaksi->cs_id = $cs;
        $transaksi->kantor_id = $cabang;
        $transaksi->jam_mulai = $jam_mulai[0];
        $transaksi->jam_selesai = $jam_selesai[1];
        $transaksi->tanggal = $tanggal;
        if ($transaksi->jumlah_reschedule == null){
            $transaksi->jumlah_reschedule = 1;
        }else{
            $transaksi->jumlah_reschedule = $transaksi->jumlah_reschedule + 1;
        }


        if ($transaksi->save()){
            session()->flash('success', 'Berhasil melakukan penjadwalan ulang');
            return redirect()->back();
        }else{
            session()->flash('error', 'Gagal melakukan penjadwalan ulang');
            return redirect()->back();
        }
    }

    public function batalkanPengajuan(Request $request){

        $transaksi = Transaksi::where('id', $request->transaksi_id)->first();
        $transaksi->status = 3;

        if ($transaksi->save()){
            session()->flash('success', 'Pengajuan berhasil dibatalkan');
            return redirect()->back();
        }else{
            session()->flash('error', 'Pengajuan gagal dibatalkan');
            return redirect()->back();
        }
    }
}
