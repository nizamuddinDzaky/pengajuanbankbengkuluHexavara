<?php

namespace App\Http\Controllers;

use App\Kabkot;
use App\Kantor;
use App\Kecamatan;
use App\Kelurahan;
use App\Provinsi;
use App\Transaksi;
use App\User;
use Illuminate\Http\Request;
use DB;
use Auth;

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


        $kantor = Kantor::select('id', 'nama_kantor')->get();
        $kantor_selected = "";

        return view('adminpusat.pengelolaan_nasabah', compact('jumlah_nasabah', 'nasabah', 'kantor', 'kantor_selected'));
    }

    public function indexFilterPusat(Request $request){

        $jumlah_nasabah = DB::table('transaksi as t')
            ->join('users as u', 'u.id', 't.pemohon_id')
            ->join('kantor as k', 'k.id', 't.kantor_id')
            ->distinct('t.pemohon_id')
            ->select('u.name', 'u.pekerjaan', 'u.no_ktp','u.email', 'u.id', 'k.nama_kantor', 't.kantor_id')
            ->where('u.deleted_at', null)
            ->count('t.pemohon_id');

        $nasabah = DB::table('transaksi as t')
            ->join('users as u', 'u.id', 't.pemohon_id')
            ->join('kantor as k', 'k.id', 't.kantor_id')
            ->distinct('t.pemohon_id')
            ->select('u.name', 'u.pekerjaan', 'u.no_ktp','u.email', 'u.id', 'k.nama_kantor', 't.kantor_id')
            ->where('u.deleted_at', null)
            ->get();

        if ($request->kantor != null){
            $jumlah_nasabah = DB::table('transaksi as t')
                ->join('users as u', 'u.id', 't.pemohon_id')
                ->join('kantor as k', 'k.id', 't.kantor_id')
                ->distinct('t.pemohon_id')
                ->select('u.name', 'u.pekerjaan', 'u.no_ktp','u.email', 'u.id', 'k.nama_kantor', 't.kantor_id')
                ->where('u.deleted_at', null)
                ->where('t.kantor_id', $request->kantor)
                ->count('t.pemohon_id');
            $nasabah = $nasabah->where('kantor_id', $request->kantor);
        }


        $kantor = Kantor::select('id', 'nama_kantor')->get();
        $kantor_selected = $request->kantor;



        return view('adminpusat.pengelolaan_nasabah', compact('jumlah_nasabah', 'nasabah', 'kantor', 'kantor_selected'));


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


    //admin cabang
    public function indexAdminCabang(){

        $jumlah_nasabah = DB::table('transaksi as t')
            ->join('users as u', 'u.id', 't.pemohon_id')
            ->join('kantor as k', 'k.id', 't.kantor_id')
            ->distinct('t.pemohon_id')
            ->select('u.name', 'u.pekerjaan', 'u.no_ktp','u.email', 'u.id', 'k.nama_kantor')
            ->where('u.deleted_at', null)
            ->where(function($q) {
                $q->where('t.kantor_id', Auth::user()->kantor_id)
                    ->orWhere('k.parent', Auth::user()->kantor_id);
            })
            ->count('t.pemohon_id');

        $nasabah = DB::table('transaksi as t')
            ->join('users as u', 'u.id', 't.pemohon_id')
            ->join('kantor as k', 'k.id', 't.kantor_id')
            ->distinct('t.pemohon_id')
            ->select('u.name', 'u.pekerjaan', 'u.no_ktp','u.email', 'u.id', 'k.nama_kantor')
            ->where('u.deleted_at', null)
            ->where(function($q) {
                $q->where('t.kantor_id', Auth::user()->kantor_id)
                    ->orWhere('k.parent', Auth::user()->kantor_id);
            })
            ->get();


        return view('admincabang.pengelolaan_nasabah', compact('jumlah_nasabah', 'nasabah'));

    }


    // admin cabang pembantu
    public function indexAdminCapem(){
        $jumlah_nasabah = DB::table('transaksi as t')
            ->join('users as u', 'u.id', 't.pemohon_id')
            ->join('kantor as k', 'k.id', 't.kantor_id')
            ->distinct('t.pemohon_id')
            ->select('u.name', 'u.pekerjaan', 'u.no_ktp','u.email', 'u.id', 'k.nama_kantor')
            ->where('u.deleted_at', null)
            ->where(function($q) {
                $q->where('t.kantor_id', Auth::user()->kantor_id)
                    ->orWhere('k.parent', Auth::user()->kantor_id);
            })
            ->count('t.pemohon_id');

        $nasabah = DB::table('transaksi as t')
            ->join('users as u', 'u.id', 't.pemohon_id')
            ->join('kantor as k', 'k.id', 't.kantor_id')
            ->distinct('t.pemohon_id')
            ->select('u.name', 'u.pekerjaan', 'u.no_ktp','u.email', 'u.id', 'k.nama_kantor')
            ->where('u.deleted_at', null)
            ->where(function($q) {
                $q->where('t.kantor_id', Auth::user()->kantor_id)
                    ->orWhere('k.parent', Auth::user()->kantor_id);
            })
            ->get();


        return view('admincapem.pengelolaan_nasabah', compact('jumlah_nasabah', 'nasabah'));

    }
}
