<?php

namespace App\Http\Controllers;

use App\Kantor;
use App\Testimoni;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class TestimoniController extends Controller
{
    public function index(){

        $jumlah_testimoni = DB::table('testimoni as t')
            ->join('users as u', 'u.id', 't.user_id')
            ->join('transaksi as tr', 'tr.id', 't.transaksi_id')
            ->join('produk as p', 'p.id', 'tr.produk_id')
            ->select('u.name', 'p.nama', 't.created_at', 't.rating', 't.testimoni', 't.id')
            ->where('tr.kantor_id', 1)
            ->count();

        $testimoni = DB::table('testimoni as t')
            ->join('users as u', 'u.id', 't.user_id')
            ->join('transaksi as tr', 'tr.id', 't.transaksi_id')
            ->join('produk as p', 'p.id', 'tr.produk_id')
            ->select('u.name', 'p.nama', 't.created_at', 't.rating', 't.testimoni', 't.id')
            ->where('tr.kantor_id', 1)
            ->get();
        $kantor = Kantor::all();
        $kantor_selected = 1;



        return view('adminpusat.testimoni', get_defined_vars());
    }


    public function indexFilter(Request  $request){
        $jumlah_testimoni =  DB::table('testimoni as t')
            ->join('users as u', 'u.id', 't.user_id')
            ->join('transaksi as tr', 'tr.id', 't.transaksi_id')
            ->join('produk as p', 'p.id', 'tr.produk_id')
            ->select('u.name', 'p.nama', 't.created_at', 't.rating', 't.testimoni', 't.id')
            ->where('tr.kantor_id', $request->kantor)
            ->count();

        $testimoni = DB::table('testimoni as t')
            ->join('users as u', 'u.id', 't.user_id')
            ->join('transaksi as tr', 'tr.id', 't.transaksi_id')
            ->join('produk as p', 'p.id', 'tr.produk_id')
            ->select('u.name', 'p.nama', 't.created_at', 't.rating', 't.testimoni', 't.id')
            ->where('tr.kantor_id', $request->kantor)
            ->get();

        $kantor = Kantor::all();
        $kantor_selected = $request->kantor;

        return view('adminpusat.testimoni', get_defined_vars());
    }


    public function indexAdminCabang(){

        $jumlah_testimoni = DB::table('testimoni as t')
            ->join('users as u', 'u.id', 't.user_id')
            ->join('transaksi as tr', 'tr.id', 't.transaksi_id')
            ->join('produk as p', 'p.id', 'tr.produk_id')
            ->select('u.name', 'p.nama', 't.created_at', 't.rating', 't.testimoni', 't.id')
            ->where('tr.kantor_id', Auth::user()->kantor_id)
            ->count();

        $testimoni = DB::table('testimoni as t')
            ->join('users as u', 'u.id', 't.user_id')
            ->join('transaksi as tr', 'tr.id', 't.transaksi_id')
            ->join('produk as p', 'p.id', 'tr.produk_id')
            ->select('u.name', 'p.nama', 't.created_at', 't.rating', 't.testimoni', 't.id')
            ->where('tr.kantor_id', Auth::user()->kantor_id)
            ->get();

        $kantor = Kantor::where(function($q) {
                $q->where('id', Auth::user()->kantor_id)
                    ->orWhere('parent', Auth::user()->kantor_id);
            })->get();
        $kantor_selected = Auth::user()->kantor_id;



        return view('admincabang.testimoni', get_defined_vars());
    }


    public function indexFilterCabang(Request  $request){
        $jumlah_testimoni =  DB::table('testimoni as t')
            ->join('users as u', 'u.id', 't.user_id')
            ->join('transaksi as tr', 'tr.id', 't.transaksi_id')
            ->join('produk as p', 'p.id', 'tr.produk_id')
            ->select('u.name', 'p.nama', 't.created_at', 't.rating', 't.testimoni', 't.id')
            ->where('tr.kantor_id', $request->kantor)
            ->count();

        $testimoni = DB::table('testimoni as t')
            ->join('users as u', 'u.id', 't.user_id')
            ->join('transaksi as tr', 'tr.id', 't.transaksi_id')
            ->join('produk as p', 'p.id', 'tr.produk_id')
            ->select('u.name', 'p.nama', 't.created_at', 't.rating', 't.testimoni', 't.id')
            ->where('tr.kantor_id', $request->kantor)
            ->get();

        $kantor = Kantor::where(function($q) {
            $q->where('id', Auth::user()->kantor_id)
                ->orWhere('parent', Auth::user()->kantor_id);
        })->get();
        $kantor_selected = $request->kantor;

        return view('admincabang.testimoni', get_defined_vars());
    }


    //admin capem
    public function indexAdminCapem(){

        $jumlah_testimoni = DB::table('testimoni as t')
            ->join('users as u', 'u.id', 't.user_id')
            ->join('transaksi as tr', 'tr.id', 't.transaksi_id')
            ->join('produk as p', 'p.id', 'tr.produk_id')
            ->select('u.name', 'p.nama', 't.created_at', 't.rating', 't.testimoni', 't.id')
            ->where('tr.kantor_id', Auth::user()->kantor_id)
            ->count();

        $testimoni = DB::table('testimoni as t')
            ->join('users as u', 'u.id', 't.user_id')
            ->join('transaksi as tr', 'tr.id', 't.transaksi_id')
            ->join('produk as p', 'p.id', 'tr.produk_id')
            ->select('u.name', 'p.nama', 't.created_at', 't.rating', 't.testimoni', 't.id')
            ->where('tr.kantor_id', Auth::user()->kantor_id)
            ->get();



        return view('admincapem.testimoni', get_defined_vars());
    }
}
