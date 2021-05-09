<div class="row mt-3">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama">Foto E-KTP (3x4) </label>
            <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode(Auth::user()->path_file)->ktp, "/"),1),"/"),1)}}">
            <a href="{{"/".json_decode(Auth::user()->path_file)->ktp}}" target="_blank" >Lihat</a>

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Pas Foto Saya (3x4) </label>
            <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode(Auth::user()->path_file)->pas_foto, "/"),1),"/"),1)}}">
            <a href="{{"/".json_decode(Auth::user()->path_file)->pas_foto}}" target="_blank" >Lihat</a>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label >NPWP (3x4) </label>
            <input type="text" disabled class="form-control" value="{{substr(strstr(substr(strstr(json_decode(Auth::user()->path_file)->npwp, "/"),1),"/"),1)}}">
            <a href="{{"/".json_decode(Auth::user()->path_file)->npwp}}" target="_blank" >Lihat</a>

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label >Scan Kartu Keluarga </label>
            <input type="text" disabled class="form-control" id="kartu_keluarga_detail">
            <a target="_blank" id="kartu_keluarga_image" >Lihat</a>
        </div>
    </div>
</div>
<div class="row dokumenSayaKawin">
    <div class="col-md-6">
        <div class="form-group">
            <label >Foto KTP Suami / Istri </label>
            <input type="text" disabled class="form-control" id="ktp_pasangan_detail">
            <a target="_blank" id="ktp_pasangan_image" >Lihat</a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label >Pas Foto Suami / Istri </label>
            <input type="text" disabled class="form-control" id="pas_foto_pasangan_detail">
            <a target="_blank" id="pas_foto_pasangan_image" >Lihat</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label >Buku Tabungan</label>
            <input type="text" disabled class="form-control" id="buku_tabungan_detail">
            <a target="_blank" id="buku_tabungan_image" >Lihat</a>
        </div>
    </div>
    <div class="col-md-6 dokumenSayaKawin">
        <div class="form-group">
            <label >Foto Buku Nikah </label>
            <input type="text" disabled class="form-control" id="buku_nikah_detail">
            <a target="_blank" id="buku_nikah_image" >Lihat</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label >Jaminan SHM / BPKB </label>
            <input type="text" disabled class="form-control" id="jaminan_shm_detail">
            <a target="_blank" id="jaminan_shm_image" >Lihat</a>
        </div>
    </div>
    <div class="col-md-6 ">
        <div class="form-group">
            <label >SPPT PBB  </label>
            <input type="text" disabled class="form-control" id="dokumen_spt_detail">
            <a target="_blank" id="dokumen_spt_image" >Lihat</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama">Scan Gaji Terakhir Terlegalisir </label>
            <input type="text" disabled class="form-control" id="gaji_terakhir_detail">
            <a target="_blank" id="gaji_terakhir_image" >Lihat</a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Scan Struk Gaji Asli Bulan Terakhir </label>
            <input type="text" disabled class="form-control" id="struk_gaji_bulan_terakhir_detail">
            <a target="_blank" id="struk_gaji_bulan_terakhir_image" >Lihat</a>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 ">
        <div class="form-group">
            <label>SK CAPEG (CPNS) </label>
            <input type="text" disabled class="form-control" id="SK_CAPEG_detail">
            <a target="_blank" id="SK_CAPEG_image" >Lihat</a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="noktp">SK Pegawai Tetap </label>
            <input type="text" disabled class="form-control" id="SK_pegawai_tetap_detail">
            <a target="_blank" id="SK_pegawai_tetap_image" >Lihat</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama"> SK Pangkat Terakhir </label>
            <input type="text" disabled class="form-control" id="SK_pangkat_terakhir_detail">
            <a target="_blank" id="SK_pangkat_terakhir_image" >Lihat</a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="">SK Berkala Terakhir </label>
            <input type="text" disabled class="form-control" id="SK_berkala_terakhir_detail">
            <a target="_blank" id="SK_berkala_terakhir_image" >Lihat</a>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-md-6">
        <div class="form-group">
            <label for="noktp">Kartu Pegawai (KARPEG)  </label>
            <input type="text" disabled class="form-control" id="kartu_pegawai_detail">
            <a target="_blank" id="kartu_pegawai_image" >Lihat</a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="noktp">Kartu TASPEN </label>
            <input type="text" disabled class="form-control" id="kartu_taspen_detail">
            <a target="_blank" id="kartu_taspen_image" >Lihat</a>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-md-6 ">
        <div class="form-group">
            <label >Nomor SK CAPEG </label>
            <input type="text" disabled class="form-control" id="nomor_sk_capeg_detail">
        </div>
    </div>
    <div class="col-md-6 pns">
        <div class="form-group">
            <label >Nomor SK Pegawai Tetap </label>
            <input type="text" disabled class="form-control" id="nomor_sk_pegawai_tetap_detail">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label >Nomor SK Pangkat Terakhir </label>
            <input type="text" disabled class="form-control" id="nomor_sk_pangkat_terakhir_detail">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label >Nomor SK Berkala Terakhir </label>
            <input type="text" disabled class="form-control" id="nomor_sk_berkala_terakhir_detail">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label >Nomor SHM / BPKB </label>
            <input type="text" disabled class="form-control" id="nomor_shm_detail">

        </div>
    </div>
</div>

