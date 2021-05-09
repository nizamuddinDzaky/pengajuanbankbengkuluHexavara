<div class="dokumenSaya">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama">Foto E-KTP (3x4) <span class="red">*</span></label>
            <div class='content'>
                <!-- Dropzone -->
                <div id="dokumenUploadKTP" class="dropzone">
                    @csrf
                    <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                </div>
            </div>
            <small  class="form-text text-muted float-right">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Pas Foto Saya (3x4) <span class="red">*</span></label>
            <div class='content'>
                <!-- Dropzone -->
                <div id="dokumenUploadPasfoto" class="dropzone" >
                    @csrf
                    <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                </div>
            </div>
            <small  class="form-text text-muted float-right">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-6">
        <div class="form-group">
            <label >NPWP (3x4) <span class="red">*</span></label>
            <div class='content'>
                <!-- Dropzone -->
                <div  id="dokumenUploadNPWP" class="dropzone" >
                    @csrf
                    <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                </div>
            </div>
            <small  class="form-text text-muted float-right">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label >Scan Kartu Keluarga <span class="red">*</span></label>
            <div class='content'>
                <!-- Dropzone -->
                <div  id="dokumenKartuKeluarga" class="dropzone" >
                    @csrf
                    <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                </div>
            </div>
            <small  class="form-text text-muted float-right">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
        </div>
    </div>
</div>
    <div class="row dokumenSayaKawin">
        <div class="col-md-6">
            <div class="form-group">
                <label >Foto KTP Suami / Istri <span class="red">*</span></label>
                <div class='content'>
                    <!-- Dropzone -->
                    <div  id="dokumenFotoKTPPasangan" class="dropzone" >
                        @csrf
                        <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                    </div>
                </div>
                <small  class="form-text text-muted float-right">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label >Pas Foto Suami / Istri <span class="red">*</span></label>
                <div class='content'>
                    <!-- Dropzone -->
                    <div  id="dokumenPasFotoPasangan" class="dropzone" >
                        @csrf
                        <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                    </div>
                </div>
                <small  class="form-text text-muted float-right">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label >Buku Tabungan</label>
                <div class='content'>
                    <!-- Dropzone -->
                    <div  id="dokumenFotoBukuTabungan" class="dropzone" >
                        @csrf
                        <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                    </div>
                </div>
                <small  class="form-text text-muted float-right">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
            </div>
        </div>
        <div class="col-md-6 dokumenSayaKawin">
            <div class="form-group">
                <label >Foto Buku Nikah </label>
                <div class='content'>
                    <!-- Dropzone -->
                    <div  id="dokumenFotoBukuNikah" class="dropzone" >
                        @csrf
                        <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                    </div>
                </div>
                <small  class="form-text text-muted float-right">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
            </div>
        </div>
    </div>
    <div class="row jaminanSHMBPKB mt-5">
        <div class="col-md-6">
            <div class="form-group">
                <label >Jaminan SHM / BPKB <span class="red">*</span></label>
                <div class='content'>
                    <!-- Dropzone -->
                    <div  id="dokumenJaminanSHM" class="dropzone" >
                        @csrf
                        <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                    </div>
                </div>
                <small  class="form-text text-muted float-right">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="form-group">
                <label >SPPT PBB <span class="red">*</span> </label>
                <div class='content'>
                    <!-- Dropzone -->
                    <div  id="dokumenSPT" class="dropzone" >
                        @csrf
                        <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                    </div>
                </div>
                <small  class="form-text text-muted float-right">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
            </div>
        </div>
    </div>
    <div class="row jaminanSHMBPKB">
        <div class="col-md-6">
            <div class="form-group">
                <label >Nomor SHM / BPKB <span class="red">*</span></label>
                @if(isset(json_decode($transaksi->path_file_dokumen_saya)->no_shm_bpkb))
                    <input type="text" class="form-control" required name="no_shm_bpkb" id="no_shm_bpkb" value="{{json_decode($transaksi->path_file_dokumen_saya)->no_shm_bpkb}}">
                @else
                    <input type="text" class="form-control" required name="no_shm_bpkb" id="no_shm_bpkb">
                @endif
            </div>
        </div>
    </div>
</div>

<form action="" id="wajibValidation">
    <input type="hidden"  name="ktp_validation" class="ktp_validation" required>
    <input type="hidden"  name="kartu_keluarga_validation" class="kartu_keluarga_validation" required>
    <input type="hidden"  name="pas_foto_validation" class="pas_foto_validation" required>
    <input type="hidden"  name="npwp_validation" class="npwp_validation" required>
</form>

<form action="" id="kawinValidation">
    <input type="hidden"  name="foto_ktp_pasangan" class="foto_ktp_pasangan" required>
    <input type="hidden"  name="pas_foto_pasangan" id="pas_foto_pasangan" required>
</form>


<form action="" id="jaminanValidation">
    <input type="hidden" name="jaminanSHM_validation" class="jaminanSHM_validation" required>
    <input type="hidden" name="SPT_validation" class="SPT_validation" required>
</form>
