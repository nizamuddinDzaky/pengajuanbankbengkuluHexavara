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
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Hash;

class BiodataController extends Controller
{

    public function biodata(){

        $provinsi = Provinsi::all();
        $kabkot = Kabkot::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();

        return view('user.biodata_diri', get_defined_vars());
    }

    public function getKecamatan(Request $request){

        $id_kota = $request->id;
        $kecamatan = Kecamatan::where('kabkot_id', $id_kota)->select('id', 'kecamatan')->get();
        $kelurahan = Kelurahan::where('kecamatan_id', $kecamatan[0]->id )->select('id', 'kelurahan', 'kd_pos')->get();

        return response()->json([$kecamatan, $kelurahan]);

    }

    public function getKelurahan(Request $request){
        $id_kecamatan = $request->id;
        $kelurahan = Kelurahan::where('kecamatan_id', $id_kecamatan)->select('id', 'kelurahan', 'kd_pos')->get();
        return response()->json($kelurahan);
    }

    public function getKodePos(Request $request){
        $id_kelurahan = $request->id;
        $kode_pos = Kelurahan::where('id', $id_kelurahan)->select('kd_pos')->first();
        return response()->json($kode_pos);
    }


    public function updateBiodata(Request $request){

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_ktp = $request->no_ktp;
        $user->no_hp = $request->no_hp;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->provinsi_id = $request->provinsi;
        $user->kabkot_id = $request->kabkot;
        $user->kecamatan_id = $request->kecamatan;
        $user->kelurahan_id = $request->kelurahan;
        $user->alamat = $request->alamat;
        $user->jenis_kelamin = $request->jenis_kelamin;
        if ($request->pekerjaan != 'Lainnya'){
            $user->pekerjaan = $request->pekerjaan;
        }else{
            $user->pekerjaan = $request->pekerjaan_lainnya;
        }

        $user->npwp = $request->no_npwp;

        if ($user->save()){
            session()->flash('success', 'Berhasil Update Biodata');
            return redirect()->back();
        }else{
            session()->flash('error', 'Gagal Update Biodata');
            return redirect()->back();
        }


    }



    public function dokumenSaya(){
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


        return view('user.dokumen_saya');
    }


    public function uploadKTP(Request $request){
        $this->upload('ktp', $request);
    }

    public function uploadNPWP(Request $request){
        $this->upload('npwp', $request);
    }

    public function uploadPasFoto(Request $request){
        $this->upload('pas_foto', $request);
    }

    public function getThumbnail(Request $request){

        $jenis = $request->data;
        $user = User::find(Auth::user()->id);
        $file_list = array();
        if ($jenis == "ktp"){

            if (json_decode($user->path_file)->ktp != null && isset(json_decode($user->path_file)->ktp)){
                // Target directory

                $file = json_decode($user->path_file)->ktp;
                $file_path = public_path("storage/ktp/").$file;
                $file_source = "/storage/ktp/".$file;

                // Check its not folder
                if(!is_dir($file_path)){

                    $size = filesize($file_path);

                    $file_list[] = array('name'=>$file,'size'=>$size,'path'=>$file_source);

                }
            }

        }elseif($jenis == "pas_foto"){

            if (json_decode($user->path_file)->pas_foto != null && isset(json_decode($user->path_file)->pas_foto)){
                // Target directory

                $file = json_decode($user->path_file)->pas_foto;
                $file_path = public_path("storage/pas_foto/").$file;
                $file_source = "/storage/pas_foto/".$file;

                // Check its not folder
                if(!is_dir($file_path)){

                    $size = filesize($file_path);

                    $file_list[] = array('name'=>$file,'size'=>$size,'path'=>$file_source);

                }
            }

        }elseif($jenis == "npwp"){
            if (json_decode($user->path_file)->npwp != null && isset(json_decode($user->path_file)->npwp)){
                // Target directory

                $file = json_decode($user->path_file)->npwp;
                $file_path = public_path("storage/npwp/").$file;
                $file_source = "/storage/npwp/".$file;

                // Check its not folder
                if(!is_dir($file_path)){

                    $size = filesize($file_path);

                    $file_list[] = array('name'=>$file,'size'=>$size,'path'=>$file_source);

                }
            }
        }

            return response()->json($file_list);

    }






    public function updateKataSandi(Request $request){

        if ($request->passwordbaru != $request->passwordulang){
            session()->flash('error', "Password tidak sama");
            return redirect()->back();
        }


        if (Hash::check($request->passwordsaatini, Auth::user()->password)) {

            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->passwordbaru);

            if ($user->save()){
                session()->flash('success', "Berhasil mengubah password");
                return redirect()->back();
            }else{
                session()->flash('error', "Gagal mengubah password");
                return redirect()->back();
            }


        }else {
            session()->flash('error', "Password saat ini tidak tepat");
            return redirect()->back();
        }

    }

    public function upload($jenis, $request){

        if($request->hasFile('file')) {

            DB::beginTransaction();
            try{

                $user = User::find(Auth::user()->id);



                if ($jenis == "pas_foto"){
                    $destinationPath = 'storage/pas_foto/';
                    if (json_decode($user->path_file)->pas_foto != null){
                        File::delete(public_path($destinationPath.json_decode($user->path_file)->pas_foto));
                    }
                }elseif($jenis == "ktp"){
                    $destinationPath = 'storage/ktp/';
                    if (json_decode($user->path_file)->ktp != null){
                        File::delete(public_path($destinationPath.json_decode($user->path_file)->ktp));
                    }
                }elseif($jenis == "npwp"){
                    $destinationPath = 'storage/npwp/';
                    if (json_decode($user->path_file)->npwp != null){
                        File::delete(public_path($destinationPath.json_decode($user->path_file)->npwp));
                    }
                }

                // Create directory if not exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                    // Get file extension
                    $extension = $request->file('file')->getClientOriginalExtension();

                    // Valid extensions
                    $validextensions = array("jpg","jpeg", "png");

                    // Check extension
                    if(in_array(strtolower($extension), $validextensions)){

                        // Rename file
                        $fileName = $request->file('file')->getClientOriginalName().time() .'.' . $extension;
                        // Uploading file to given path
                        $request->file('file')->move($destinationPath, $fileName);

                    }

                    $pathNow = $destinationPath.'/'.$fileName;
                    $user = User::find(Auth::user()->id);

                    if ($jenis == "pas_foto"){
                        $file = [
                            'ktp' => json_decode($user->path_file)->ktp,
                            'pas_foto' => $fileName,
                            'npwp' =>  json_decode($user->path_file)->npwp
                        ];
                    }elseif($jenis == "ktp"){
                        $file = [
                            'ktp' => $fileName,
                            'pas_foto' =>  json_decode($user->path_file)->pas_foto,
                            'npwp' =>  json_decode($user->path_file)->npwp
                        ];
                    }elseif($jenis == "npwp"){
                        $file = [
                            'ktp' => json_decode($user->path_file)->ktp,
                            'pas_foto' => json_decode($user->path_file)->pas_foto,
                            'npwp' =>  $fileName
                        ];
                    }


                    $user->path_file =  json_encode($file);

                    if ($user->save()){
                        DB::commit();
                        if ($jenis == 'ktp'){
                            session()->flash('success', 'Berhasil Upload KTP');
                        }  elseif ($jenis == "pas_foto"){
                            session()->flash('success', 'Berhasil Upload Pas Foto');
                        }else{
                            session()->flash('success', 'Berhasil Upload NPWP');
                        }



                    }else{
                        DB::rollback();
                        if ($jenis == 'ktp'){
                            session()->flash('error', 'Gagal Upload KTP');
                        }  elseif ($jenis == "pas_foto"){
                            session()->flash('error', 'Gagal Upload Pas Foto');
                        }else{
                            session()->flash('error', 'Gagal Upload NPWP');
                        }
                    }
            }catch (\Exception $ex){
                DB::rollback();
                if ($jenis == 'ktp'){
                    session()->flash('error', 'Gagal Upload KTP');
                }  elseif ($jenis == "pas_foto"){
                    session()->flash('error', 'Gagal Upload Pas Foto');
                }else{
                    session()->flash('error', 'Gagal Upload NPWP');
                }
            }
        }


    }
}
