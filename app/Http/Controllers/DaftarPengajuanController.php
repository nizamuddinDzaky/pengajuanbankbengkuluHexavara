<?php

namespace App\Http\Controllers;

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
            ->orderBy('t.tanggal', 'desc')
            ->paginate(5);


        foreach ($transaksi as $data){
            $data->countdown = Carbon::createFromFormat('Y-m-d H:i:s', $data->tanggal.' '.$data->jam_mulai)->diff(Carbon::now())->format('%m bulan %d hari %h jam %i menit');
        }


        return view('user.daftar_pengajuan', compact('transaksi'));
    }
}
