<?php

namespace App\Http\Controllers;

use App\Kabkot;
use App\Kecamatan;
use App\Kelurahan;
use App\Provinsi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function index(){

        $user = User::find(Auth::user()->id);
        if ($user->path_file == null){
            $fileNull = [
                'ktp' => null,
                'pas_foto' => null,
                'npwp' => null,
            ];

            $user->path_file = json_encode($fileNull);
            $user->save();
        }


        $provinsi = Provinsi::all();
        $kabkot = Kabkot::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();


        return view('user.pengajuan', get_defined_vars());
    }
}
