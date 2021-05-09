<form action="" id="formBiodataDiri" method="post" class="pengajuan_multiguna">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nama">Nama <span class="red">*</span></label>
                <input type="text" class="form-control" value="{{Auth::user()->name}}" name="name" id="name" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email <span class="red">*</span></label>
                <input type="text" class="form-control" value="{{Auth::user()->email}}" name="email" id="email" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nama">Nama Panggilan</label>
                    <input type="text" class="form-control"  @if(isset(json_decode($transaksi->biodata)->nama_panggilan)) value="{{json_decode($transaksi->biodata)->nama_panggilan}}" @endif id="nama_panggilan" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Jenis Kelamin <span class="red">*</span> </label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                    <option value="Laki-laki" @if(Auth::user()->jenis_kelamin == "Laki-laki") selected @endif >Laki-laki</option>
                    <option value="Perempuan"  @if(Auth::user()->jenis_kelamin == "Perempuan")selected  @endif>Perempuan</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="noktp">No KTP <span class="red">*</span></label>
                <input type="text" class="form-control" value="{{Auth::user()->no_ktp}}" name="no_ktp" id="no_ktp" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="nohp">No Handphone <span class="red">*</span></label>
                <input type="text" class="form-control" value="{{Auth::user()->no_hp}}" name="no_hp" id="no_hp" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="noktp">Masa Berlaku KTP</label>
                <input type="date"     @if(isset(json_decode($transaksi->biodata)->masa_berlaku_ktp)) value="{{json_decode($transaksi->biodata)->masa_berlaku_ktp}}" @endif class="form-control"  id="masa_berlaku_ktp" name="masa_berlaku_ktp">
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
                <label for="tanggallahir">Tanggal Lahir <span class="red">*</span></label>
                <input type="date" class="form-control" value="{{Auth::user()->tanggal_lahir}}" name="tanggal_lahir" id="tanggal_lahir" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tempatlahir">Status Perkawinan <span class="red">*</span></label>
                <select id="status_perkawinan" name="status_perkawinan" id="status_perkawinan"  class="form-control" required>
                    @if(isset(json_decode($transaksi->biodata)->status_perkawinan))
                        <option value="Belum Kawin"   @if(json_decode($transaksi->biodata)->status_perkawinan == "Belum Kawin") selected @endif>Belum Kawin</option>
                        <option value="Kawin"    @if(json_decode($transaksi->biodata)->status_perkawinan == "Kawin") selected @endif>Kawin</option>
                        <option value="Janda" @if(json_decode($transaksi->biodata)->status_perkawinan == "Janda") selected @endif >Janda</option>
                        <option value="Duda"  @if(json_decode($transaksi->biodata)->status_perkawinan == "Duda") selected @endif >Duda</option>
                    @else
                        <option value="Belum Kawin">Belum Kawin</option>
                        <option value="Kawin">Kawin</option>
                        <option value="Janda">Janda</option>
                        <option value="Duda">Duda</option>
                    @endif

                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggallahir">Agama <span class="red">*</span></label>
                <select id="agama" name="agama" class="form-control" required>
                    @if(isset(json_decode($transaksi->biodata)->agama))
                    <option value="Islam" @if(json_decode($transaksi->biodata)->agama == "Islam") selected @endif>Islam</option>
                    <option value="Kristen Protestan" @if(json_decode($transaksi->biodata)->agama == "Kristen Protestan") selected @endif>Kristen Protestan</option>
                    <option value="Katolik" @if(json_decode($transaksi->biodata)->agama == "Katolik") selected @endif>Katolik</option>
                    <option value="Hindu" @if(json_decode($transaksi->biodata)->agama == "Hindu") selected @endif>Hindu</option>
                    <option value="Buddha" @if(json_decode($transaksi->biodata)->agama == "Buddha") selected @endif>Buddha</option>
                    <option value="Kong Hu Cu" @if(json_decode($transaksi->biodata)->agama == "Kong Hu Cu") selected @endif>Kong Hu Cu</option>
                    @else
                        <option value="Islam">Islam</option>
                        <option value="Kristen Protestan">Kristen Protestan</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Kong Hu Cu">Kong Hu Cu</option>
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="row referensi_kawin">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggallahir">Nama Suami / Istri</label>
                <input type="text" class="form-control" @if(isset(json_decode($transaksi->biodata)->nama_pasangan)) value="{{json_decode($transaksi->biodata)->nama_pasangan}}"  @endif name="nama_pasangan" id="nama_pasangan" >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggallahir">Nomor KTP Suami / Istri</label>
                <input type="text" class="form-control" @if(isset(json_decode($transaksi->biodata)->no_ktp_pasangan)) value="{{json_decode($transaksi->biodata)->no_ktp_pasangan}}"  @endif  maxlength="16" name="no_ktp_pasangan" id="no_ktp_pasangan" >
            </div>
        </div>
    </div>
    <div class="row referensi_kawin">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggallahir">Pekerjaan Suami / Istri</label>
                <input type="text" class="form-control" @if(isset(json_decode($transaksi->biodata)->pekerjaan_pasangan)) value="{{json_decode($transaksi->biodata)->pekerjaan_pasangan}}"  @endif name="pekerjaan_pasangan" id="pekerjaan_pasangan" >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggallahir">Alamat / Nomor HP Suami / Istri</label>
                <input type="text" class="form-control" @if(isset(json_decode($transaksi->biodata)->alamat_nohp_pasangan)) value="{{json_decode($transaksi->biodata)->alamat_nohp_pasangan}}"  @endif name="alamat_nohp_pasangan" id="alamat_nohp_pasangan" >
            </div>
        </div>
    </div>
    <div class="row referensi_kawin">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggallahir">Hubungan</label>
                <select class="form-control"  name="hubungan_pasangan" id="hubungan_pasangan">
                    @if(isset(json_decode($transaksi->biodata)->hubungan))
                        <option value="Suami"  @if(isset(json_decode($transaksi->biodata)->hubungan) == "Suami") selected @endif>Suami</option>
                        <option value="Istri" @if(isset(json_decode($transaksi->biodata)->hubungan) == "Istri") selected @endif>Istri</option>
                    @else
                        <option value="Suami">Suami</option>
                        <option value="Istri">Istri</option>

                    @endif
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tempatlahir">Pendidikan <span class="red">*</span></label>
                <select id="pendidikan" name="pendidikan" class="form-control" required>
                    @if(isset(json_decode($transaksi->biodata)->pendidikan))
                    <option value="Tidak Sekolah"  @if(json_decode($transaksi->biodata)->pendidikan == "Tidak Sekolah") selected @endif>Tidak Sekolah</option>
                    <option value="SD" @if(json_decode($transaksi->biodata)->pendidikan == "SD") selected @endif>SD</option>
                    <option value="SMP" @if(json_decode($transaksi->biodata)->pendidikan == "SMP") selected @endif>SMP</option>
                    <option value="SMA" @if(json_decode($transaksi->biodata)->pendidikan == "SMA") selected @endif>SMA</option>
                    <option value="D3" @if(json_decode($transaksi->biodata)->pendidikan == "D3") selected @endif>D3</option>
                    <option value="S1" @if(json_decode($transaksi->biodata)->pendidikan == "S1") selected @endif>S1</option>
                    <option value="S2" @if(json_decode($transaksi->biodata)->pendidikan == "S2") selected @endif>S2</option>
                    <option value="S3" @if(json_decode($transaksi->biodata)->pendidikan == "S3") selected @endif>S3</option>
                    @else
                        <option value="Tidak Sekolah">Tidak Sekolah</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="D3">D3</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggallahir">Keterangan Gelar</label>
                <input type="text" class="form-control" id="keterangan_gelar" @if(isset(json_decode($transaksi->biodata)->keterangan_gelar)) value="{{json_decode($transaksi->biodata)->keterangan_gelar}}"  @endif name="keterangan_gelar">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggallahir">Kewarganegaraan <span class="red">*</span></label>
                <select name="kewarganegaraan" id="kewarganegaraan" class="form-control">
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
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggallahir">Jumlah Anak</label>
                <input type="number" class="form-control" @if(isset(json_decode($transaksi->biodata)->jumlah_anak)) value="{{json_decode($transaksi->biodata)->jumlah_anak}}"  @endif id="jumlah_anak" name="jumlah_anak">
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="form-group">
                <label for="alamat">Alamat Lengkap Rumah <span class="red">*</span></label>
                <select name="provinsi" class="form-control" id="provinsi" name="provinsi"  required>
                    @foreach($provinsi as $data)
                        <option value="{{$data->id}}">{{$data->provinsi}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="alamat" style="color: #EEEFF3">-</label>
                <select name="kabkot" class="form-control" id="kabkot" name="kabkot" required>
                    <option selected disabled>-Pilih Kabupaten / Kota-</option>
                    @foreach($kabkot as $data)
                        <option value="{{$data->id}}">{{$data->kabupaten_kota}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <select name="kecamatan" class="form-control" id="kecamatan" name="kecamatan" required>
                    <option selected disabled>-Pilih Kecamatan-</option>
                    @foreach($kecamatan as $data)
                        <option value="{{$data->id}}">{{$data->kecamatan}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <select name="kelurahan" class="form-control" id="kelurahan" name="kelurahan" required>
                    <option selected disabled>-Pilih Kelurahan-</option>
                    @foreach($kelurahan as $data)
                        <option value="{{$data->id}}">{{$data->kelurahan}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" id="kode_pos" name="kode_pos" readonly placeholder="Kode Pos">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <textarea  id="alamat" name="alamat" class="form-control" placeholder="Alamat Lengkap" required>{{Auth::user()->alamat}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Nomor Telepon Rumah <span class="red">*</span></label>
                <input type="text" class="form-control" @if(isset(json_decode($transaksi->biodata)->no_telp_rumah)) value="{{json_decode($transaksi->biodata)->no_telp_rumah}}"  @endif id="no_telp_rumah" name="no_telp_rumah" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Status Kepemilikan Rumah <span class="red">*</span></label>
                <select id="status_kepemilikan_rumah" name="status_kepemilikan_rumah" class="form-control" required>
                    @if(isset(json_decode($transaksi->biodata)->status_kepemilikan_rumah))
                    <option value="Milik Sendiri" @if(json_decode($transaksi->biodata)->status_kepemilikan_rumah == "Milik Sendiri") selected @endif>Milik Sendiri</option>
                    <option value="Sewa" @if(json_decode($transaksi->biodata)->status_kepemilikan_rumah == "Sewa") selected @endif>Sewa</option>
                    @else
                        <option value="Milik Sendiri">Milik Sendiri</option>
                        <option value="Sewa">Sewa</option>
                    @endif
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggallahir">Pekerjaan <span class="red">*</span></label>
                <select name="pekerjaan" class="form-control" id="pekerjaan" required>
                    <option value="CPNS">CPNS</option>
                    <option value="PNS">PNS</option>
                    <option value="Pensiunan PNS">Pensiunan PNS</option>
                    <option value="DPRD">DPRD</option>
                    <option value="Pejabat Non PNS / Komisioner KPU">Pejabat Non PNS / Komisioner KPU</option>
                    <option value="Perangkat Desa">Perangkat Desa</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggallahir">Nomor NPWP <span class="red">*</span></label>
                <input type="text" maxlength="15" minlength="15" value="{{Auth::user()->npwp}}" class="form-control" name="no_npwp" id="no_npwp" required>
            </div>
        </div>
    </div>
    <div class="row" id="keterangan_lainnya">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggallahir">Nama Pekerjaan <span class="red">*</span></label>
                <input type="text" class="form-control" id="pekerjaan_lainnya" name="pekerjaan_lainnya" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Jabatan <span class="red">*</span> </label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" required @if(isset(json_decode($transaksi->biodata)->jabatan)) value="{{json_decode($transaksi->biodata)->jabatan}}"  @endif>
            </div>
        </div>
        <div class="col-md-6 pangkat">
            <div class="form-group">
                <label for="email">Pangkat <span class="red">*</span></label>
                <select name="pangkat" id="pangkat" class="form-control">
                    @foreach($pangkat as $data)
                        @if(isset(json_decode($transaksi->biodata)->pangkat))
                            @if($data == json_decode($transaksi->biodata)->pangkat)
                                <option value="{{$data}}" selected>{{$data}}</option>
                            @else
                                <option value="{{$data}}">{{$data}}</option>
                            @endif

                        @else
                            <option value="{{$data}}">{{$data}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Nama Dinas / Instansi / Kantor <span class="red">*</span></label>
                <input type="text" class="form-control" id="kantor" name="kantor" required @if(isset(json_decode($transaksi->biodata)->kantor)) value="{{json_decode($transaksi->biodata)->kantor}}"  @endif>
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
                <label for="email">Nomor Telp Kantor <span class="red">*</span></label>
                <input type="text" class="form-control" id="no_telp_kantor" name="no_telp_kantor" required @if(isset(json_decode($transaksi->biodata)->no_telp_kantor)) value="{{json_decode($transaksi->biodata)->no_telp_kantor}}"  @endif>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Nomor Fax </label>
                <input type="text" class="form-control" id="no_fax_kantor" name="no_fax_kantor" @if(isset(json_decode($transaksi->biodata)->no_fax_kantor)) value="{{json_decode($transaksi->biodata)->no_fax_kantor}}"  @endif>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Alamat Email </label>
                <input type="email" class="form-control" id="email_kantor" name="email_kantor" @if(isset(json_decode($transaksi->biodata)->email_kantor)) value="{{json_decode($transaksi->biodata)->email_kantor}}"  @endif>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Lama Bekerja <span class="red">*</span></label>
                <div class="input-group mb-3">
                    <input type="number" class="form-control"  id="lama_bekerja" name="lama_bekerja" required @if(isset(json_decode($transaksi->biodata)->lama_bekerja)) value="{{json_decode($transaksi->biodata)->lama_bekerja}}"  @endif>
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Tahun</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Alamat Kantor <span class="red">*</span></label>
                <textarea class="form-control" id="alamat_kantor" name="alamat_kantor" required >@if(isset(json_decode($transaksi->biodata)->alamat_kantor)) {{json_decode($transaksi->biodata)->alamat_kantor}}  @endif</textarea>
            </div>
        </div>

    </div>
</form>
