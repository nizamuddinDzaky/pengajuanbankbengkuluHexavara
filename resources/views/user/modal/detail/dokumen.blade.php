<div class="row mt-3">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nama">Foto E-KTP (3x4) </label>
                <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode(Auth::user()->path_file)->ktp, "/"),1),"/"),1)}}">

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Pas Foto Saya (3x4) </label>
                <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode(Auth::user()->path_file)->pas_foto, "/"),1),"/"),1)}}">

            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="form-group">
                <label >NPWP (3x4) </label>
                <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode(Auth::user()->path_file)->npwp, "/"),1),"/"),1)}}">

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label >Scan Kartu Keluarga </label>
                <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->kartu_keluarga, "/"),1),"/"),1)}}">

            </div>
        </div>
    </div>
    <div class="row dokumenSayaKawin">
        <div class="col-md-6">
            <div class="form-group">
                <label >Foto KTP Suami / Istri </label>
                @if(isset(json_decode($transaksi->path_file_dokumen_saya)->ktp_pasangan))
                <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->ktp_pasangan, "/"),1),"/"),1)}}">
                @else
                    <input type="text" disabled class="form-control" value="Tidak Ada File yang Diunggah">
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label >Pas Foto Suami / Istri </label>
                @if(isset(json_decode($transaksi->path_file_dokumen_saya)->pas_foto_pasangan))
                <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->pas_foto_pasangan, "/"),1),"/"),1)}}">
                @else
                    <input type="text" disabled class="form-control" value="Tidak Ada File yang Diunggah">
                @endif

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label >Buku Tabungan</label>
                @if(isset(json_decode($transaksi->path_file_dokumen_saya)->buku_tabungan))
                <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->buku_tabungan, "/"),1),"/"),1)}}">
                @else
                    <input type="text" disabled class="form-control" value="Tidak Ada File yang Diunggah">
                @endif

            </div>
        </div>
        <div class="col-md-6 dokumenSayaKawin">
            <div class="form-group">
                <label >Foto Buku Nikah </label>
                @if(isset(json_decode($transaksi->path_file_dokumen_saya)->buku_nikah))
                <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->buku_nikah, "/"),1),"/"),1)}}">
                @else
                    <input type="text" disabled class="form-control" value="Tidak Ada File yang Diunggah">
                @endif

            </div>
        </div>
    </div>
    <div class="row jaminanSHMBPKB mt-5">
        <div class="col-md-6">
            <div class="form-group">
                <label >Jaminan SHM / BPKB </label>
                @if(isset(json_decode($transaksi->path_file_dokumen_saya)->jaminan_shm))
                <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->jaminan_shm, "/"),1),"/"),1)}}">
                @else
                    <input type="text" disabled class="form-control" value="Tidak Ada File yang Diunggah">
                @endif
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="form-group">
                <label >SPPT PBB  </label>
                @if(isset(json_decode($transaksi->path_file_dokumen_saya)->dokumen_spt))
                <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode($transaksi->path_file_dokumen_saya)->dokumen_spt, "/"),1),"/"),1)}}">
                @else
                    <input type="text" disabled class="form-control" value="Tidak Ada File yang Diunggah">
                @endif
            </div>
        </div>
    </div>
     <div class="row">
         <div class="col-md-6">
             <div class="form-group">
                 <label for="nama">Scan Gaji Terakhir Terlegalisir </label>
                 <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode($transaksi->path_file)->gaji_terakhir, "/"),1),"/"),1)}}">
             </div>
         </div>
         <div class="col-md-6">
             <div class="form-group">
                 <label for="">Scan Struk Gaji Asli Bulan Terakhir </label>
                 <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode($transaksi->path_file)->struk_gaji_bulan_terakhir, "/"),1),"/"),1)}}">

             </div>
         </div>
     </div>
     <div class="row mt-3">
         <div class="col-md-6 cpns">
             <div class="form-group">
                 <label>SK CAPEG (CPNS) </label>
                 @if(isset(json_decode($transaksi->path_file)->SK_CAPEG))
                 <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode($transaksi->path_file)->SK_CAPEG, "/"),1),"/"),1)}}">
                 @else
                     <input type="text" disabled class="form-control" value="Tidak Ada File yang Diunggah">
                 @endif
             </div>
         </div>
         <div class="col-md-6">
             <div class="form-group pns">
                 <label for="noktp">SK Pegawai Tetap </label>
                 @if(isset(json_decode($transaksi->path_file)->SK_pegawai_tetap))
                 <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode($transaksi->path_file)->SK_pegawai_tetap, "/"),1),"/"),1)}}">
                 @else
                     <input type="text" disabled class="form-control" value="Tidak Ada File yang Diunggah">
                 @endif
             </div>
         </div>
     </div>
     <div class="row">
         <div class="col-md-6">
             <div class="form-group">
                 <label for="nama"> SK Pangkat Terakhir </label>
                 @if(isset(json_decode($transaksi->path_file)->SK_pangkat_terakhir))
                     <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode($transaksi->path_file)->SK_pangkat_terakhir, "/"),1),"/"),1)}}">
                 @else
                     <input type="text" disabled class="form-control" value="Tidak Ada File yang Diunggah">
                 @endif

             </div>
         </div>
         <div class="col-md-6">
             <div class="form-group">
                 <label for="">SK Berkala Terakhir </label>
                 @if(isset(json_decode($transaksi->path_file)->SK_berkala_terakhir))
                     <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode($transaksi->path_file)->SK_berkala_terakhir, "/"),1),"/"),1)}}">
                 @else
                     <input type="text" disabled class="form-control" value="Tidak Ada File yang Diunggah">
                 @endif
             </div>
         </div>
     </div>
     <div class="row mt-3">
         <div class="col-md-6">
             <div class="form-group">
                 <label for="noktp">Kartu Pegawai (KARPEG)  </label>
                 @if(isset(json_decode($transaksi->path_file)->kartu_pegawai))
                     <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode($transaksi->path_file)->kartu_pegawai, "/"),1),"/"),1)}}">
                 @else
                     <input type="text" disabled class="form-control" value="Tidak Ada File yang Diunggah">
                 @endif
             </div>
         </div>
         <div class="col-md-6">
             <div class="form-group">
                 <label for="noktp">Kartu TASPEN </label>
                 @if(isset(json_decode($transaksi->path_file)->kartu_taspen))
                     <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode($transaksi->path_file)->kartu_taspen, "/"),1),"/"),1)}}">
                 @else
                     <input type="text" disabled class="form-control" value="Tidak Ada File yang Diunggah">
                 @endif

             </div>
         </div>
     </div>
         <div class="row mt-3">
             <div class="col-md-6 cpns">
                 <div class="form-group">
                     <label >Nomor SK CAPEG </label>
                     @if(isset(json_decode($transaksi->path_file)->no_SK_CAPEG))
                         <input type="text" class="form-control"  name="no_SK_CAPEG" id="no_SK_CAPEG" value="{{json_decode($transaksi->path_file)->no_SK_CAPEG}}" disabled>
                     @else
                         <input type="text" class="form-control"  name="no_SK_CAPEG" id="no_SK_CAPEG" disabled value="Tidak Diinputkan">
                     @endif
                 </div>
             </div>
             <div class="col-md-6 pns">
                 <div class="form-group">
                     <label >Nomor SK Pegawai Tetap </label>
                     @if(isset(json_decode($transaksi->path_file)->no_SK_pegawai_tetap))
                         <input type="text" class="form-control"  name="no_SK_pegawai_tetap" id="no_SK_pegawai_tetap" value="{{json_decode($transaksi->path_file)->no_SK_pegawai_tetap}}" disabled>
                     @else
                         <input type="text" class="form-control"  name="no_SK_pegawai_tetap" id="no_SK_pegawai_tetap" disabled value="Tidak Diinputkan">
                     @endif
                 </div>
             </div>
         </div>

         <div class="row">
             <div class="col-md-6">
                 <div class="form-group">
                     <label >Nomor SK Pangkat Terakhir </label>
                     @if(isset(json_decode($transaksi->path_file)->no_SK_pangkat_terakhir))
                         <input type="text" class="form-control"  name="no_SK_pangkat_terakhir" id="no_SK_pangkat_terakhir" value="{{json_decode($transaksi->path_file)->no_SK_pangkat_terakhir}}" disabled>
                     @else
                         <input type="text" class="form-control"  name="no_SK_pangkat_terakhir" id="no_SK_pangkat_terakhir" disabled value="Tidak Diinputkan">
                     @endif
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="form-group">
                     <label >Nomor SK Berkala Terakhir </label>
                     @if(isset(json_decode($transaksi->path_file)->no_SK_berkala_terakhir))
                         <input type="text" class="form-control"  name="no_SK_berkala_terakhir" id="no_SK_berkala_terakhir" value="{{json_decode($transaksi->path_file)->no_SK_berkala_terakhir}}" disabled>
                     @else
                         <input type="text" class="form-control"  name="no_SK_berkala_terakhir" id="no_SK_berkala_terakhir" disabled value="Tidak Diinputkan">
                     @endif
                 </div>
             </div>
         </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label >Nomor SHM / BPKB </label>
                    @if(isset(json_decode($transaksi->path_file_dokumen_saya)->no_shm_bpkb))
                        <input type="text" disabled class="form-control" value="{{json_decode($transaksi->path_file_dokumen_saya)->no_shm_bpkb}}">
                    @else
                        <input type="text" disabled class="form-control" value="Tidak Diinputkan">
                    @endif

                </div>
            </div>
        </div>

