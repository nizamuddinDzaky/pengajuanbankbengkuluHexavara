<?php


namespace App\Http\Service;


use App\Produk;
use App\Transaksi;
use App\User;
use Illuminate\Support\Facades\Auth;
use DB;
use File;
use Illuminate\Support\Facades\Session;


class UploadService
{

    public function uploadDokumenSaya($jenis, $request){

        if($request->hasFile('file')) {

            DB::beginTransaction();
            try{
                $transaksi = Transaksi::where('pemohon_id', Auth::user()->id)->where('status', 1)->first();

                $destinationPath = 'storage/'.$jenis.'/';
                if (isset(json_decode($transaksi->path_file_dokumen_saya)->$jenis)){
                    if (json_decode($transaksi->path_file_dokumen_saya)->$jenis != null){
                        File::delete(public_path($destinationPath.json_decode($transaksi->path_file_dokumen_saya)->$jenis));
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
                    $fileName = Auth::user()->name.'_'.$jenis.'_'.time() .'.' . $extension;
                    // Uploading file to given path
                    $request->file('file')->move($destinationPath, $fileName);

                }

                $pathNow = $destinationPath.$fileName;
                $user = User::find(Auth::user()->id);

                $file = json_decode($transaksi->path_file_dokumen_saya, true);
                $file[$jenis] = $pathNow;
                $transaksi->path_file_dokumen_saya =  json_encode($file);

                if ($transaksi->save()){
                    DB::commit();
//                    session()->flash('success', 'Berhasil Upload '.$jenis);

                }else{
                    DB::rollback();
                    session()->flash('error', 'Gagal Upload '.$jenis);
                }
            }catch (\Exception $ex){
                DB::rollback();
                session()->flash('error', 'Gagal Upload '.$jenis);
            }
        }


    }

    public function uploadDokumenKredit($jenis, $request){

        if($request->hasFile('file')) {

            DB::beginTransaction();
            try{
                $transaksi = Transaksi::where('pemohon_id', Auth::user()->id)->where('status', 1)->first();

                $destinationPath = 'storage/'.$jenis.'/';
                if (isset(json_decode($transaksi->path_file)->$jenis)){
                    if (json_decode($transaksi->path_file)->$jenis != null){
                        File::delete(public_path($destinationPath.json_decode($transaksi->path_file)->$jenis));
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
                    $fileName = Auth::user()->name.'_'.$jenis.'_'.time() .'.' . $extension;
                    // Uploading file to given path
                    $request->file('file')->move($destinationPath, $fileName);

                }

                $pathNow = $destinationPath.$fileName;
                $user = User::find(Auth::user()->id);

                $file = json_decode($transaksi->path_file, true);
                $file[$jenis] = $pathNow;
                $transaksi->path_file =  json_encode($file);

                if ($transaksi->save()){
                    DB::commit();
//                    session()->flash('success', 'Berhasil Upload '.$jenis);

                }else{
                    DB::rollback();
                    session()->flash('error', 'Gagal Upload '.$jenis);
                }
            }catch (\Exception $ex){
                DB::rollback();
                session()->flash('error', 'Gagal Upload '.$jenis);
            }
        }
    }


    public function getThumbnail($request){

        $jenis = $request->data;
        $tipe = $request->tipe;
        $transaksi = Transaksi::where('pemohon_id', Auth::user()->id)->where('status', 1)->first();
        $file_list = array();

        if ($tipe == "dokumen_saya"){
            if (json_decode($transaksi->path_file_dokumen_saya)->$jenis != null && isset(json_decode($transaksi->path_file_dokumen_saya)->$jenis)){
                // Target directory

                $file = json_decode($transaksi->path_file_dokumen_saya)->$jenis;
                $file_path = public_path($file);
                $file_source = "/".$file;
                $file = explode('/', $file);


                // Check its not folder
                if(!is_dir($file_path)){

                    $size = filesize($file_path);

                    $file_list[] = array('name'=>$file[2],'size'=>$size,'path'=>$file_source);

                }
            }
        }else{
            if (json_decode($transaksi->path_file)->$jenis != null && isset(json_decode($transaksi->path_file)->$jenis)){
                // Target directory

                $file = json_decode($transaksi->path_file)->$jenis;
                $file_path = public_path($file);
                $file_source = "/".$file;
                $file = explode('/', $file);

                // Check its not folder
                if(!is_dir($file_path)){

                    $size = filesize($file_path);

                    $file_list[] = array('name'=>$file[2],'size'=>$size,'path'=>$file_source);

                }
            }
        }



        return $file_list;

    }


    public function unggahBlangko($request){

        if($request->hasFile('file')) {
            $id = $request->id;
            DB::beginTransaction();
            try{
                $transaksi = Transaksi::where('id', $id)->first();
                $produk = DB::table('transaksi')->join('produk', 'transaksi.produk_id', 'produk.id')->where('transaksi.id', $id)->select('produk.nama')->first();
                $destinationPath = 'storage/'.$produk->nama.'/';



                if ($transaksi->path_file_blangko != null){
                    File::delete(public_path($destinationPath.$transaksi->path_file_blangko));
                }


                // Create directory if not exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                // Get file extension
                $extension = $request->file('file')->getClientOriginalExtension();

                // Valid extensions
                $validextensions = array("pdf");

                // Check extension
                if(in_array(strtolower($extension), $validextensions)){

                    // Rename file
                    $fileName = Auth::user()->name.'_'.$produk->nama.'_'.time() .'.' . $extension;
                    // Uploading file to given path
                    $request->file('file')->move($destinationPath, $fileName);

                }

                $pathNow = $destinationPath.$fileName;

                $transaksi->path_file_blangko =  $pathNow;

                if ($transaksi->save()){
                    DB::commit();

                }else{
                    DB::rollback();
                }
            }catch (\Exception $ex){
                DB::rollback();
                session()->flash('error', $ex->getMessage());
            }
        }
    }


    public function unggahBlangkoProduk($request){

        if($request->hasFile('file')) {
            DB::beginTransaction();
            try{

                $destinationPath = 'blangko/';

                // Create directory if not exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                // Get file extension
                $extension = $request->file('file')->getClientOriginalExtension();

                // Valid extensions
                if ($request->jenis == "template"){
                    $validextensions = array("pdf");
                }else{
                    $validextensions = array("docx");
                }


                // Check extension
                if(in_array(strtolower($extension), $validextensions)){

                    // Rename file
                    $fileName = $request->file('file')->getClientOriginalName().'_'.time() .'.' . $extension;
                    // Uploading file to given path
                    $request->file('file')->move($destinationPath, $fileName);

                }

                $pathNow = $destinationPath.$fileName;
                if ($request->jenis == "template"){
                    Session::put('template', $pathNow);
                }else{
                    Session::put('dokumen', $pathNow);
                }

            }catch (\Exception $ex){
                session()->flash('error', $ex->getMessage());
            }
        }
    }

}
