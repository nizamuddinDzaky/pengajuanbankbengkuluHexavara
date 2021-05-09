<?php

namespace App\Http\Controllers;

use App\Kabkot;
use App\Kantor;
use App\Kecamatan;
use App\Kelurahan;
use App\Produk;
use App\Provinsi;
use App\Transaksi;
use App\User;
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

    public function getDetailTransaksi(Request $request){
        $transaksi = Transaksi::where('id', $request->id)->first();
        $transaksi->slot_waktu = $transaksi->jam_mulai.' - '.$transaksi->jam_selesai;
        $transaksi->nama_cabang = Kantor::where('id', $transaksi->kantor_id)->first()->nama_kantor;
        $transaksi->nama_cs = User::where('id', $transaksi->cs_id)->first()->name;
        $transaksi->nama_produk = Produk::where('id', $transaksi->produk_id)->first()->nama;
        $transaksi->provinsi = Provinsi::where('id', Auth::user()->provinsi_id)->first()->provinsi;
        $transaksi->kabkot = Kabkot::where('id', Auth::user()->kabkot_id)->first()->kabupaten_kota;
        $transaksi->kecamatan = Kecamatan::where('id', Auth::user()->kecamatan_id)->first()->kecamatan;
        $transaksi->kelurahan = Kelurahan::where('id', Auth::user()->kelurahan_id)->first()->kelurahan;
        $transaksi->kode_pos = Kelurahan::where('id', Auth::user()->kelurahan_id)->first()->kd_pos;
        if(substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->kartu_keluarga, "/"),1),"/"),1)){
            $transaksi->kartu_keluarga = substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->kartu_keluarga, "/"),1),"/"),1);
        }else{
            $transaksi->kartu_keluarga = "Tidak Ada File yang Diunggah";
        }

        if(substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->ktp_pasangan, "/"),1),"/"),1)){
            $transaksi->ktp_pasangan = substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->ktp_pasangan, "/"),1),"/"),1);
        }else{
            $transaksi->ktp_pasangan = "Tidak Ada File yang Diunggah";
        }

        if(substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->pas_foto_pasangan, "/"),1),"/"),1)){
            $transaksi->pas_foto_pasangan = substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->pas_foto_pasangan, "/"),1),"/"),1);
        }else{
            $transaksi->pas_foto_pasangan = "Tidak Ada File yang Diunggah";
        }

        if(substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->buku_tabungan, "/"),1),"/"),1)){
            $transaksi->buku_tabungan = substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->buku_tabungan, "/"),1),"/"),1);
        }else{
            $transaksi->buku_tabungan = "Tidak Ada File yang Diunggah";
        }

        if(substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->buku_nikah, "/"),1),"/"),1)){
            $transaksi->buku_nikah = substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->buku_nikah, "/"),1),"/"),1);
        }else{
            $transaksi->buku_nikah = "Tidak Ada File yang Diunggah";
        }

        if(substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->dokumen_spt, "/"),1),"/"),1)){
            $transaksi->dokumen_spt = substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->dokumen_spt, "/"),1),"/"),1);
        }else{
            $transaksi->dokumen_spt = "Tidak Ada File yang Diunggah";
        }


        if(substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->jaminan_shm, "/"),1),"/"),1)){
            $transaksi->jaminan_shm = substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->jaminan_shm, "/"),1),"/"),1);
        }else{
            $transaksi->jaminan_shm = "Tidak Ada File yang Diunggah";
        }

        if(substr(strstr(substr(strstr(json_decode($transaksi->path_file)->gaji_terakhir, "/"),1),"/"),1)){
            $transaksi->gaji_terakhir = substr(strstr(substr(strstr(json_decode($transaksi->path_file)->gaji_terakhir, "/"),1),"/"),1);
        }else{
            $transaksi->gaji_terakhir = "Tidak Ada File yang Diunggah";
        }

        if(substr(strstr(substr(strstr(json_decode($transaksi->path_file)->struk_gaji_bulan_terakhir, "/"),1),"/"),1)){
            $transaksi->struk_gaji_bulan_terakhir = substr(strstr(substr(strstr(json_decode($transaksi->path_file)->struk_gaji_bulan_terakhir, "/"),1),"/"),1);
        }else{
            $transaksi->struk_gaji_bulan_terakhir = "Tidak Ada File yang Diunggah";
        }

        if(substr(strstr(substr(strstr(json_decode($transaksi->path_file)->SK_CAPEG, "/"),1),"/"),1)){
            $transaksi->SK_CAPEG = substr(strstr(substr(strstr(json_decode($transaksi->path_file)->SK_CAPEG, "/"),1),"/"),1);
        }else{
            $transaksi->SK_CAPEG = "Tidak Ada File yang Diunggah";
        }


        if(substr(strstr(substr(strstr(json_decode($transaksi->path_file)->SK_pegawai_tetap, "/"),1),"/"),1)){
            $transaksi->SK_pegawai_tetap = substr(strstr(substr(strstr(json_decode($transaksi->path_file)->SK_pegawai_tetap, "/"),1),"/"),1);
        }else{
            $transaksi->SK_pegawai_tetap = "Tidak Ada File yang Diunggah";
        }


        if(substr(strstr(substr(strstr(json_decode($transaksi->path_file)->SK_pangkat_terakhir, "/"),1),"/"),1)){
            $transaksi->SK_pangkat_terakhir = substr(strstr(substr(strstr(json_decode($transaksi->path_file)->SK_pangkat_terakhir, "/"),1),"/"),1);
        }else{
            $transaksi->SK_pangkat_terakhir = "Tidak Ada File yang Diunggah";
        }


        if(substr(strstr(substr(strstr(json_decode($transaksi->path_file)->SK_berkala_terakhir, "/"),1),"/"),1)){
            $transaksi->SK_berkala_terakhir = substr(strstr(substr(strstr(json_decode($transaksi->path_file)->SK_berkala_terakhir, "/"),1),"/"),1);
        }else{
            $transaksi->SK_berkala_terakhir = "Tidak Ada File yang Diunggah";
        }

        if(substr(strstr(substr(strstr(json_decode($transaksi->path_file)->kartu_pegawai, "/"),1),"/"),1)){
            $transaksi->kartu_pegawai = substr(strstr(substr(strstr(json_decode($transaksi->path_file)->kartu_pegawai, "/"),1),"/"),1);
        }else{
            $transaksi->kartu_pegawai = "Tidak Ada File yang Diunggah";
        }

        if(substr(strstr(substr(strstr(json_decode($transaksi->path_file)->kartu_taspen, "/"),1),"/"),1)){
            $transaksi->kartu_taspen = substr(strstr(substr(strstr(json_decode($transaksi->path_file)->kartu_taspen, "/"),1),"/"),1);
        }else{
            $transaksi->kartu_taspen = "Tidak Ada File yang Diunggah";
        }












        return response()->json($transaksi);
    }
}
