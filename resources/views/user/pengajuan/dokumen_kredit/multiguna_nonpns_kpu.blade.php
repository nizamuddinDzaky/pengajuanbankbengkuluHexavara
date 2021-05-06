<div class="dokumenMultigunaNonPNSKPU">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nama">Scan Gaji Terakhir Terlegalisir <span class="red">*</span></label>
                <div class='content'>
                    <!-- Dropzone -->
                    <div id="dokumenScanGajiLegalisir" class="dropzone">
                        @csrf
                        <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                    </div>
                </div>
                <small  class="form-text text-muted">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Scan Struk Gaji Asli Bulan Terakhir <span class="red">*</span></label>
                <div class='content'>
                    <!-- Dropzone -->
                    <div id="dokumenScanStrukGaji" class="dropzone" >
                        @csrf
                        <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                    </div>
                </div>
                <small  class="form-text text-muted">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="form-group">
                <label for="noktp">SK<span class="red">*</span></label>
                <div class='content'>
                    <!-- Dropzone -->
                    <div  id="dokumenSK" class="dropzone" >
                        @csrf
                        <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                    </div>
                </div>
                <small  class="form-text text-muted">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="noktp"> SK Pensiun</label>
                <div class='content'>
                    <!-- Dropzone -->
                    <div  id="dokumenSKPensiun" class="dropzone" >
                        @csrf
                        <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                    </div>
                </div>
                <small  class="form-text text-muted">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="form-group">
                <label for="noktp">Kartu Pegawai (KARPEG) </label>
                <div class='content'>
                    <!-- Dropzone -->
                    <div  id="dokumenKartuPegawai" class="dropzone" >
                        @csrf
                        <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                    </div>
                </div>
                <small  class="form-text text-muted">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="noktp">Kartu TASPEN </label>
                <div class='content'>
                    <!-- Dropzone -->
                    <div  id="dokumenKartuTASPEN" class="dropzone" >
                        @csrf
                        <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                    </div>
                </div>
                <small  class="form-text text-muted">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="noktp">Kartu Identitas Pensiun </label>
                <div class='content'>
                    <!-- Dropzone -->
                    <div  id="dokumenKartuIdentitasPensiun" class="dropzone" >
                        @csrf
                        <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                    </div>
                </div>
                <small  class="form-text text-muted">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
            </div>
        </div>
    </div>


    <form action="" id="dokumenKreditValidation">
        <input type="hidden"  name="ktp_validation" id="ktp_validation" required>
        <input type="hidden"  name="kartu_keluarga_validation" id="kartu_keluarga_validation" required>
        <input type="hidden"  name="pas_foto_validation" id="pas_foto_validation" required>
        <input type="hidden"  name="npwp_validation" id="npwp_validation" required>
    </form>

</div>
