<?php

namespace App\Http\Controllers;

use App\Transaksi;
use Illuminate\Http\Request;
use DB;
use Auth;

class ReportController extends Controller
{
    public function indexAdminPusat(){

        $jumlah_transaksi = Transaksi::count();
        $transaksi = DB::table('transaksi as t')
            ->join('users as u', 't.pemohon_id', 'u.id')
            ->join('produk as p', 'p.id', 't.produk_id')
            ->join('ref_status as rs', 'rs.id', 't.status')
            ->select('t.kode_pengajuan as kode_registrasi', 't.tanggal', 'u.name', 'p.nama as nama_produk', 't.plafond', 't.masa_tenor', 'rs.status', 't.id', 't.jam_mulai_pelayanan', 't.jam_selesai_pelayanan')
            ->orderBy('t.tanggal', 'desc')
            ->get();


        return view('adminpusat.report', get_defined_vars());

    }


    public function indexAdminCabang(){
        $jumlah_transaksi = DB::table('transaksi as t')
            ->join('users as u', 't.pemohon_id', 'u.id')
            ->join('produk as p', 'p.id', 't.produk_id')
            ->join('ref_status as rs', 'rs.id', 't.status')
            ->join('kantor as k', 'k.id', 't.kantor_id')
            ->select('t.kode_pengajuan as kode_registrasi', 't.tanggal', 'u.name', 'p.nama as nama_produk', 't.plafond', 't.masa_tenor', 'rs.status', 't.id', 't.jam_mulai_pelayanan', 't.jam_selesai_pelayanan')
            ->orderBy('t.tanggal', 'desc')
            ->where(function($q) {
                $q->where('t.kantor_id', Auth::user()->kantor_id)
                    ->orWhere('k.parent', Auth::user()->kantor_id);
            })
            ->count();

        $transaksi = DB::table('transaksi as t')
            ->join('users as u', 't.pemohon_id', 'u.id')
            ->join('produk as p', 'p.id', 't.produk_id')
            ->join('ref_status as rs', 'rs.id', 't.status')
            ->join('kantor as k', 'k.id', 't.kantor_id')
            ->select('t.kode_pengajuan as kode_registrasi', 't.tanggal', 'u.name', 'p.nama as nama_produk', 't.plafond', 't.masa_tenor', 'rs.status', 't.id', 't.jam_mulai_pelayanan', 't.jam_selesai_pelayanan')
            ->orderBy('t.tanggal', 'desc')
            ->where(function($q) {
                $q->where('t.kantor_id', Auth::user()->kantor_id)
                    ->orWhere('k.parent', Auth::user()->kantor_id);
            })
            ->get();


        return view('adminpusat.report', get_defined_vars());
    }

    public function indexAdminCapem(){
        $jumlah_transaksi = DB::table('transaksi as t')
            ->join('users as u', 't.pemohon_id', 'u.id')
            ->join('produk as p', 'p.id', 't.produk_id')
            ->join('ref_status as rs', 'rs.id', 't.status')
            ->join('kantor as k', 'k.id', 't.kantor_id')
            ->select('t.kode_pengajuan as kode_registrasi', 't.tanggal', 'u.name', 'p.nama as nama_produk', 't.plafond', 't.masa_tenor', 'rs.status', 't.id', 't.jam_mulai_pelayanan', 't.jam_selesai_pelayanan')
            ->orderBy('t.tanggal', 'desc')
            ->where(function($q) {
                $q->where('t.kantor_id', Auth::user()->kantor_id)
                    ->orWhere('k.parent', Auth::user()->kantor_id);
            })
            ->count();

        $transaksi = DB::table('transaksi as t')
            ->join('users as u', 't.pemohon_id', 'u.id')
            ->join('produk as p', 'p.id', 't.produk_id')
            ->join('ref_status as rs', 'rs.id', 't.status')
            ->join('kantor as k', 'k.id', 't.kantor_id')
            ->select('t.kode_pengajuan as kode_registrasi', 't.tanggal', 'u.name', 'p.nama as nama_produk', 't.plafond', 't.masa_tenor', 'rs.status', 't.id', 't.jam_mulai_pelayanan', 't.jam_selesai_pelayanan')
            ->orderBy('t.tanggal', 'desc')
            ->where(function($q) {
                $q->where('t.kantor_id', Auth::user()->kantor_id)
                    ->orWhere('k.parent', Auth::user()->kantor_id);
            })
            ->get();


        return view('adminpusat.report', get_defined_vars());
    }
}
