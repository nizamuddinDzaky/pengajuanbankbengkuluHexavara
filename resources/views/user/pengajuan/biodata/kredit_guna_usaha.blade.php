<form action="" id="formBiodataDiri" method="post" class="pengajuan_kgu">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nama">Nama <span class="red">*</span></label>
                <input type="text" class="form-control" value="{{Auth::user()->name}}" name="name" id="name" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="noktp">Nama Ibu Kandung <span class="red">*</span></label>
                <input type="text" class="form-control"  id="nama_ibu_kandung" name="nama_ibu_kandung" required    @if(isset(json_decode($transaksi->biodata)->nama_ibu_kandung)) value="{{json_decode($transaksi->biodata)->nama_ibu_kandung}}"  @endif>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tempatlahir">Tempat Lahir <span class="red">*</span></label>
                <input type="text" class="form-control" value="{{Auth::user()->tempat_lahir}}" name="tempat_lahir" id="tempat_lahir" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label >Tanggal Lahir <span class="red">*</span></label>
                <input type="date" class="form-control" value="{{Auth::user()->tanggal_lahir}}" name="tanggal_lahir" id="tanggal_lahir" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label >Kewarganegaraan <span class="red">*</span></label>
                <select name="kewarganegaraan" id="kewarganegaraan" class="form-control" required>
                    @if(isset(json_decode($transaksi->biodata)->kewarganegaraan))
                        <option value="Warga Negara Indonesia" @if(json_decode($transaksi->biodata)->kewarganegaraan == "Warga Negara Indonesia") selected @endif>Warga Negara Indonesia</option>
                        <option value="Warga Negara Asing" @if(json_decode($transaksi->biodata)->kewarganegaraan == "Warga Negara Asing") selected @endif>Warga Negara Asing</option>
                    @else
                        <option value="Warga Negara Indonesia">Warga Negara Indonesia</option>
                        <option value="Warga Negara Asing">Warga Negara Asing</option>
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="form-group">
                <label for="alamat">Alamat Lengkap Rumah <span class="red">*</span></label>
                <textarea  id="alamat" name="alamat" class="form-control" placeholder="Alamat Lengkap" required>{{Auth::user()->alamat}}</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Nomor Telepon Rumah <span class="red">*</span></label>
                <input type="text" class="form-control" @if(isset(json_decode($transaksi->biodata)->no_telp_rumah)) value="{{json_decode($transaksi->biodata)->no_telp_rumah}}"  @endif id="no_telp_rumah" name="no_telp_rumah" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label >Nomor NPWP <span class="red">*</span></label>
                <input type="text" maxlength="15" minlength="15" value="{{Auth::user()->npwp}}" class="form-control" name="no_npwp" id="no_npwp" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">NIP <span class="red">*</span> </label>
                <input type="text" class="form-control" id="nip" name="nip" required @if(isset(json_decode($transaksi->biodata)->NIP)) value="{{json_decode($transaksi->biodata)->NIP}}"  @endif>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label >Nama Suami / Istri <span class="red">*</span></label>
                <input type="text" class="form-control" @if(isset(json_decode($transaksi->biodata)->nama_pasangan)) value="{{json_decode($transaksi->biodata)->nama_pasangan}}"  @endif name="nama_pasangan" id="nama_pasangan" >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label >Nomor KTP Suami / Istri <span class="red">*</span></label>
                <input type="text" class="form-control" @if(isset(json_decode($transaksi->biodata)->no_ktp_pasangan)) value="{{json_decode($transaksi->biodata)->no_ktp_pasangan}}"  @endif  maxlength="16" name="no_ktp_pasangan" id="no_ktp_pasangan" >
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="form-group">
                <label >Status Usaha <span class="red">*</span></label>
                <input type="text" class="form-control" @if(isset(json_decode($transaksi->biodata)->nama_pasangan)) value="{{json_decode($transaksi->biodata)->nama_pasangan}}"  @endif name="status_usaha" id="status_usaha" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label >Nama Usaha <span class="red">*</span></label>
                <input type="text" class="form-control" @if(isset(json_decode($transaksi->biodata)->no_ktp_pasangan)) value="{{json_decode($transaksi->biodata)->no_ktp_pasangan}}"  @endif  name="nama_usaha" id="nama_usaha" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label >Jenis Usaha <span class="red">*</span></label>
                <input type="text" class="form-control" @if(isset(json_decode($transaksi->biodata)->nama_pasangan)) value="{{json_decode($transaksi->biodata)->nama_pasangan}}"  @endif name="jenis_usaha" id="jenis_usaha" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label >Alamat Usaha <span class="red">*</span></label>
                <textarea class="form-control"    name="alamat_usaha" id="alamat_usaha" required>@if(isset(json_decode($transaksi->biodata)->no_ktp_pasangan)) value="{{json_decode($transaksi->biodata)->no_ktp_pasangan}}" @endif</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label >Instansi <span class="red">*</span></label>
                <input type="text" class="form-control" @if(isset(json_decode($transaksi->biodata)->nama_pasangan)) value="{{json_decode($transaksi->biodata)->nama_pasangan}}"  @endif name="instansi" id="instansi" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label >Alamat Instansi / Kantor <span class="red">*</span></label>
                <textarea class="form-control"    name="alamat_instansi" id="alamat_instansi" required >@if(isset(json_decode($transaksi->biodata)->no_ktp_pasangan)) value="{{json_decode($transaksi->biodata)->no_ktp_pasangan}}" @endif</textarea>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="form-group">
                <label >Pendapatan per Bulan <span class="red">*</span></label>
                <input type="text" class="form-control currency" @if(isset(json_decode($transaksi->biodata)->nama_pasangan)) value="{{json_decode($transaksi->biodata)->nama_pasangan}}"  @endif name="pendapatan_per_bulan" id="pendapatan_per_bulan" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label >Keuntungan per Bulan <span class="red">*</span></label>
                <input type="text" class="form-control currency" @if(isset(json_decode($transaksi->biodata)->no_ktp_pasangan)) value="{{json_decode($transaksi->biodata)->no_ktp_pasangan}}"  @endif   name="keuntungan_per_bulan" id="keuntungan_per_bulan" required >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label >Biaya Sekolah <span class="red">*</span></label>
                <input type="text" class="form-control currency" @if(isset(json_decode($transaksi->biodata)->nama_pasangan)) value="{{json_decode($transaksi->biodata)->nama_pasangan}}"  @endif name="biaya_sekolah" id="biaya_sekolah" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label >Biaya Konsumsi Keluarga <span class="red">*</span></label>
                <input type="text" class="form-control currency" @if(isset(json_decode($transaksi->biodata)->no_ktp_pasangan)) value="{{json_decode($transaksi->biodata)->no_ktp_pasangan}}"  @endif  name="biaya_konsumsi_keluarga" id="biaya_konsumsi_keluarga" required >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label >Listrik, air, telpon / HP<span class="red">*</span></label>
                <input type="text" class="form-control currency" @if(isset(json_decode($transaksi->biodata)->nama_pasangan)) value="{{json_decode($transaksi->biodata)->nama_pasangan}}"  @endif name="listrik_air_telepon" id="listrik_air_telepon" required>
            </div>
        </div>
    </div>

</form>
