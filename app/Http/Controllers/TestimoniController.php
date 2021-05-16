<?php

namespace App\Http\Controllers;

use App\Kantor;
use App\Testimoni;
use Illuminate\Http\Request;
use DB;

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
}
