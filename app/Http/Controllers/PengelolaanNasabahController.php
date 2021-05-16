<?php

namespace App\Http\Controllers;

use App\Kabkot;
use App\Kecamatan;
use App\Kelurahan;
use App\Provinsi;
use App\Transaksi;
use App\User;
use Illuminate\Http\Request;
use DB;

class PengelolaanNasabahController extends Controller
{
    public function indexAdminPusat(){

        $jumlah_nasabah = DB::table('transaksi as t')
            ->join('users as u', 'u.id', 't.pemohon_id')
            ->join('kantor as k', 'k.id', 't.kantor_id')
            ->distinct('t.pemohon_id')
            ->select('u.name', 'u.pekerjaan', 'u.no_ktp','u.email', 'u.id', 'k.nama_kantor')
            ->where('u.deleted_at', null)
            ->count('t.pemohon_id');

        $nasabah = DB::table('transaksi as t')
            ->join('users as u', 'u.id', 't.pemohon_id')
            ->join('kantor as k', 'k.id', 't.kantor_id')
            ->distinct('t.pemohon_id')
            ->select('u.name', 'u.pekerjaan', 'u.no_ktp','u.email', 'u.id', 'k.nama_kantor')
            ->where('u.deleted_at', null)
            ->get();


        return view('adminpusat.pengelolaan_nasabah', compact('jumlah_nasabah', 'nasabah'));
    }


    public function delete(Request $request){

        $user = User::find($request->id);
        if ($user->delete()){
            return response()->json(true);
        }else{
            return response()->json(false);
        }

    }

    public function getDetailNasabah(Request $request){
        $user = User::find($request->id);
        $user->provinsi = Provinsi::where('id', $user->provinsi_id)->first()->provinsi;
        $user->kabkot = Kabkot::where('id', $user->kabkot_id)->first()->kabupaten_kota;
        $user->kecamatan = Kecamatan::where('id', $user->kecamatan_id)->first()->kecamatan;
        $user->kelurahan = Kelurahan::where('id', $user->kelurahan_id)->first()->kelurahan;
        $user->kode_pos = Kelurahan::where('id', $user->kelurahan_id)->first()->kd_pos;
        return response()->json($user);
    }
}
