<?php


namespace App\Http\Service;


use App\Transaksi;
use App\User;
use Illuminate\Support\Facades\Auth;
use DB;
use File;


class UploadService
{

    public function uploadDokumenSaya($jenis, $request){

        if($request->hasFile('file')) {

            DB::beginTransaction();
            try{
                $transaksi = Transaksi::where('pemohon_id', Auth::user()->id)->where('status', 0)->first();

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
                    $fileName = $request->file('file')->getClientOriginalName().time() .'.' . $extension;
                    // Uploading file to given path
                    $request->file('file')->move($destinationPath, $fileName);

                }

                $pathNow = $destinationPath.'/'.$fileName;
                $user = User::find(Auth::user()->id);

                if ($jenis == "kartu_keluarga"){
                    $file = [
                        "kartu_keluarga" => $fileName,
                        "ktp_pasangan" => json_decode($transaksi->path_file_dokumen_saya)->ktp_pasangan,
                        "pas_foto_pasangan" => json_decode($transaksi->path_file_dokumen_saya)->pas_foto_pasangan,
                        "buku_nikah" => json_decode($transaksi->path_file_dokumen_saya)->buku_nikah,
                        "buku_tabungan" => json_decode($transaksi->path_file_dokumen_saya)->buku_tabungan,
                        "jaminan_shm" => json_decode($transaksi->path_file_dokumen_saya)->jaminan_shm,
                        "dokumen_spt" => json_decode($transaksi->path_file_dokumen_saya)->dokumen_spt,
                    ];
                }elseif($jenis == "ktp_pasangan"){
                    $file = [
                        "kartu_keluarga" => json_decode($transaksi->path_file_dokumen_saya)->kartu_keluarga,
                        "ktp_pasangan" => $fileName,
                        "pas_foto_pasangan" => json_decode($transaksi->path_file_dokumen_saya)->pas_foto_pasangan,
                        "buku_nikah" => json_decode($transaksi->path_file_dokumen_saya)->buku_nikah,
                        "buku_tabungan" => json_decode($transaksi->path_file_dokumen_saya)->buku_tabungan,
                        "jaminan_shm" => json_decode($transaksi->path_file_dokumen_saya)->jaminan_shm,
                        "dokumen_spt" => json_decode($transaksi->path_file_dokumen_saya)->dokumen_spt,
                    ];
                }elseif($jenis  == "pas_foto_pasangan"){
                    $file = [
                        "kartu_keluarga" => json_decode($transaksi->path_file_dokumen_saya)->kartu_keluarga,
                        "ktp_pasangan" => json_decode($transaksi->path_file_dokumen_saya)->ktp_pasangan,
                        "pas_foto_pasangan" => $fileName,
                        "buku_nikah" => json_decode($transaksi->path_file_dokumen_saya)->buku_nikah,
                        "buku_tabungan" => json_decode($transaksi->path_file_dokumen_saya)->buku_tabungan,
                        "jaminan_shm" => json_decode($transaksi->path_file_dokumen_saya)->jaminan_shm,
                        "dokumen_spt" => json_decode($transaksi->path_file_dokumen_saya)->dokumen_spt,
                    ];
                }elseif ($jenis == "buku_nikah"){
                    $file = [
                        "kartu_keluarga" => json_decode($transaksi->path_file_dokumen_saya)->kartu_keluarga,
                        "ktp_pasangan" => json_decode($transaksi->path_file_dokumen_saya)->ktp_pasangan,
                        "pas_foto_pasangan" => json_decode($transaksi->path_file_dokumen_saya)->pas_foto_pasangan,
                        "buku_nikah" => $fileName,
                        "buku_tabungan" => json_decode($transaksi->path_file_dokumen_saya)->buku_tabungan,
                        "jaminan_shm" => json_decode($transaksi->path_file_dokumen_saya)->jaminan_shm,
                        "dokumen_spt" => json_decode($transaksi->path_file_dokumen_saya)->dokumen_spt,
                    ];
                }elseif($jenis == "buku_tabungan"){
                    $file = [
                        "kartu_keluarga" => json_decode($transaksi->path_file_dokumen_saya)->kartu_keluarga,
                        "ktp_pasangan" => json_decode($transaksi->path_file_dokumen_saya)->ktp_pasangan,
                        "pas_foto_pasangan" => json_decode($transaksi->path_file_dokumen_saya)->pas_foto_pasangan,
                        "buku_nikah" =>  json_decode($transaksi->path_file_dokumen_saya)->buku_nikah,
                        "buku_tabungan" => $fileName,
                        "jaminan_shm" => json_decode($transaksi->path_file_dokumen_saya)->jaminan_shm,
                        "dokumen_spt" => json_decode($transaksi->path_file_dokumen_saya)->dokumen_spt,
                    ];
                }elseif($jenis == "jaminan_shm"){
                    $file = [
                        "kartu_keluarga" => json_decode($transaksi->path_file_dokumen_saya)->kartu_keluarga,
                        "ktp_pasangan" => json_decode($transaksi->path_file_dokumen_saya)->ktp_pasangan,
                        "pas_foto_pasangan" => json_decode($transaksi->path_file_dokumen_saya)->pas_foto_pasangan,
                        "buku_nikah" =>  json_decode($transaksi->path_file_dokumen_saya)->buku_nikah,
                        "buku_tabungan" => json_decode($transaksi->path_file_dokumen_saya)->buku_tabungan,
                        "jaminan_shm" => $fileName,
                        "dokumen_spt" => json_decode($transaksi->path_file_dokumen_saya)->dokumen_spt,
                    ];
                }
                elseif($jenis == "dokumen_spt"){
                    $file = [
                        "kartu_keluarga" => json_decode($transaksi->path_file_dokumen_saya)->kartu_keluarga,
                        "ktp_pasangan" => json_decode($transaksi->path_file_dokumen_saya)->ktp_pasangan,
                        "pas_foto_pasangan" => json_decode($transaksi->path_file_dokumen_saya)->pas_foto_pasangan,
                        "buku_nikah" =>  json_decode($transaksi->path_file_dokumen_saya)->buku_nikah,
                        "buku_tabungan" => json_decode($transaksi->path_file_dokumen_saya)->buku_tabungan,
                        "jaminan_shm" => json_decode($transaksi->path_file_dokumen_saya)->jaminan_shm,
                        "dokumen_spt" => $fileName,
                    ];
                }


                $transaksi->path_file_dokumen_saya =  json_encode($file);

                if ($transaksi->save()){
                    DB::commit();
                    session()->flash('success', 'Berhasil Upload '.$jenis);
//                    if ($jenis == 'kartu_keluarga'){
//                        session()->flash('success', 'Berhasil Upload Kartu Keluarga');
//                    } elseif ($jenis == "ktp_pasangan"){
//                        session()->flash('success', 'Berhasil Upload KTP Pasangan');
//                    }elseif($jenis == "pas_foto_pasangan"){
//                        session()->flash('success', 'Berhasil Upload Pas Foto Pasangan');
//                    }elseif($jenis == "buku_nikah"){
//                        session()->flash('success', 'Berhasil Upload Buku Nikah');
//                    }elseif($jenis == "buku_tabungan"){
//                        session()->flash('success', 'Berhasil Upload Buku Tabungan');
//                    }



                }else{
                    DB::rollback();
                    session()->flash('error', 'Gagal Upload '.$jenis);
//                    if ($jenis == 'kartu_keluarga'){
//                        session()->flash('error', 'Gagal Upload Kartu Keluarga');
//                    }  elseif ($jenis == "ktp_pasangan"){
//                        session()->flash('error', 'Gagal Upload KTP Pasangan');
//                    }elseif ($jenis == "pas_foto_pasangan"){
//                        session()->flash('error', 'Gagal Upload Pas Foto Pasangan');
//                    }elseif ($jenis == "buku_nikah"){
//                        session()->flash('error', 'Gagal Upload Buku Nikah');
//                    }elseif ($jenis == "buku_tabungan"){
//                        session()->flash('error', 'Gagal Upload Buku Tabungan');
//                    }
                }
            }catch (\Exception $ex){
                DB::rollback();
                session()->flash('error', 'Gagal Upload '.$jenis);
//                if ($jenis == 'kartu_keluarga'){
//                    session()->flash('error', 'Gagal Upload Kartu Keluarga');
//                }  elseif ($jenis == "ktp_pasangan"){
//                    session()->flash('error', 'Gagal Upload KTP Pasangan');
//                }elseif ($jenis == "pas_foto_pasangan"){
//                    session()->flash('error', 'Gagal Upload Pas Foto Pasangan');
//                }elseif ($jenis == "buku_nikah"){
//                    session()->flash('error', 'Gagal Upload Buku Nikah');
//                }elseif ($jenis == "buku_tabungan"){
//                    session()->flash('error', 'Gagal Upload Buku Tabungan');
//                }
            }
        }


    }


    public function getThumbnail($request){

        $jenis = $request->data;
        $transaksi = Transaksi::where('pemohon_id', Auth::user()->id)->where('status', 0)->first();
        $file_list = array();
            if (json_decode($transaksi->path_file_dokumen_saya)->$jenis != null && isset(json_decode($transaksi->path_file_dokumen_saya)->$jenis)){
                // Target directory

                $file = json_decode($transaksi->path_file_dokumen_saya)->$jenis;
                $file_path = public_path("storage/$jenis/").$file;
                $file_source = "/storage/$jenis/".$file;

                // Check its not folder
                if(!is_dir($file_path)){

                    $size = filesize($file_path);

                    $file_list[] = array('name'=>$file,'size'=>$size,'path'=>$file_source);

                }
            }

        return $file_list;

    }

}
