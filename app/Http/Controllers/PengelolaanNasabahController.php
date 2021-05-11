<?php

namespace App\Http\Controllers;

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
}
