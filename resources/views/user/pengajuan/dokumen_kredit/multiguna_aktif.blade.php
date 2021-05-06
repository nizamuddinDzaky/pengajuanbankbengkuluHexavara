<div class="dokumenMultigunaAktif">
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
            <div class="col-md-6 cpns">
                <div class="form-group">
                    <label>SK CAPEG (CPNS) <span class="red">*</span></label>
                    <div class='content'>
                        <!-- Dropzone -->
                        <div  id="dokumenSKCAPEG" class="dropzone" >
                            @csrf
                            <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                        </div>
                    </div>
                    <small  class="form-text text-muted">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group pns">
                    <label for="noktp">SK Pegawai Tetap <span class="red">*</span></label>
                    <div class='content'>
                        <!-- Dropzone -->
                        <div  id="dokumenSKPegawaiTetap" class="dropzone" >
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
                <label for="nama"> SK Pangkat Terakhir <span class="red">*</span></label>
                <div class='content'>
                    <!-- Dropzone -->
                    <div id="dokumenSKPangkatTerakhir" class="dropzone">
                        @csrf
                        <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                    </div>
                </div>
                <small  class="form-text text-muted">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">SK Berkala Terakhir <span class="red">*</span></label>
                <div class='content'>
                    <!-- Dropzone -->
                    <div id="dokumenSKBerkalaTerakhir" class="dropzone" >
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
                <label for="noktp">Kartu Pegawai (KARPEG) <span class="red">*</span> </label>
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

    <form action="" id="nomorSKMultigunaAktif">
    <div class="row mt-3">
        <div class="col-md-6 cpns">
            <div class="form-group">
                <label >Nomor SK CAPEG <span class="red">*</span></label>
                @if(isset(json_decode($transaksi->path_file)->no_SK_CAPEG))
                    <input type="text" class="form-control" required name="no_SK_CAPEG" id="no_SK_CAPEG" value="{{json_decode($transaksi->path_file)->no_SK_CAPEG}}">
                @else
                    <input type="text" class="form-control" required name="no_SK_CAPEG" id="no_SK_CAPEG">
                @endif
            </div>
        </div>
        <div class="col-md-6 pns">
            <div class="form-group">
                <label >Nomor SK Pegawai Tetap <span class="red">*</span></label>
                @if(isset(json_decode($transaksi->path_file)->no_SK_pegawai_tetap))
                    <input type="text" class="form-control" required name="no_SK_pegawai_tetap" id="no_SK_pegawai_tetap" value="{{json_decode($transaksi->path_file)->no_SK_pegawai_tetap}}">
                @else
                    <input type="text" class="form-control" required name="no_SK_pegawai_tetap" id="no_SK_pegawai_tetap">
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label >Nomor SK Pangkat Terakhir <span class="red">*</span></label>
                @if(isset(json_decode($transaksi->path_file)->no_SK_pangkat_terakhir))
                    <input type="text" class="form-control" required name="no_SK_pangkat_terakhir" id="no_SK_pangkat_terakhir" value="{{json_decode($transaksi->path_file)->no_SK_pangkat_terakhir}}">
                @else
                    <input type="text" class="form-control" required name="no_SK_pangkat_terakhir" id="no_SK_pangkat_terakhir">
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label >Nomor SK Berkala Terakhir <span class="red">*</span></label>
                @if(isset(json_decode($transaksi->path_file)->no_SK_berkala_terakhir))
                    <input type="text" class="form-control" required name="no_SK_berkala_terakhir" id="no_SK_berkala_terakhir" value="{{json_decode($transaksi->path_file)->no_SK_berkala_terakhir}}">
                @else
                    <input type="text" class="form-control" required name="no_SK_berkala_terakhir" id="no_SK_berkala_terakhir">
                @endif
            </div>
        </div>
    </div>
    </form>


    <form action="" id="dokumenMultigunaAktifPNS">
        <input type="hidden"  name="gaji_terakhir" class="gaji_terakhir" required>
        <input type="hidden"  name="struk_gaji_bulan_terakhir" class="struk_gaji_bulan_terakhir" required>
        <input type="hidden"  name="SK_pegawai_tetap" class="SK_pegawai_tetap" required>
        <input type="hidden"  name="SK_pangkat_terakhir" class="SK_pangkat_terakhir" required>
        <input type="hidden"  name="SK_berkala_terakhir" class="SK_berkala_terakhir" required>
        <input type="hidden"  name="kartu_pegawai" class="kartu_pegawai" required>
    </form>

    <form action="" id="dokumenMultigunaAktifCPNS">
        <input type="hidden"  name="gaji_terakhir" class="gaji_terakhir" required>
        <input type="hidden"  name="struk_gaji_bulan_terakhir" class="struk_gaji_bulan_terakhir" required>
        <input type="hidden"  name="SK_CAPEG" class="SK_CAPEG" required>
        <input type="hidden"  name="SK_pangkat_terakhir" class="SK_pangkat_terakhir" required>
        <input type="hidden"  name="SK_berkala_terakhir" class="SK_berkala_terakhir" required>
        <input type="hidden"  name="kartu_pegawai" class="kartu_pegawai" required>
    </form>

</div>
