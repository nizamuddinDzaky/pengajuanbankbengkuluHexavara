{{-- Modal Edit Data Kantor --}}
<div class="modal fade bd-example-modal-lg" id="modal-edit-kantor" role="dialog" aria-labelledby="addOrgLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form method="POST" action="{{
                    route( $role == 'AdminPusat' ? 'admin.pusat.edit.cabang' : 'admin.cabang.edit.cabang' )
                }}">
                    @csrf
                    <input type="hidden" class="form-control"  placeholder="" name = "id" id="id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nama Cabang</label>
                                <input type="text" class="form-control"  placeholder="Nama Cabang" name="name" id="name">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Alamat Cabang</label>
                                <textarea class="form-control"  rows="3" name="address" id="address"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Provinsi</label>
                                <select class="form-control select2" name="provinsi" id="provinsi" id="provinsi">
                                    @foreach($provinsi as $data)
                                        <option value="{{$data->id}}">{{$data->provinsi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Kabupaten</label>
                                <select class="form-control" name="kabkot" id="kabkot">
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
                                <label for="formGroupExampleInput">Kecamatan</label>
                                <select class="form-control" name="kecamatan" id="kecamatan">
                                    <option selected disabled>-Pilih Kecamatan-</option>
                                    @foreach($kecamatan as $data)
                                        <option value="{{$data->id}}">{{$data->kecamatan}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Kelurahan</label>
                                <select class="form-control" name="kelurahan" id="kelurahan">
                                    <option selected disabled>-Pilih Kelurahan-</option>
                                    @foreach($kelurahan as $data)
                                        <option value="{{$data->id}}">{{$data->kelurahan}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary float-right">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Edit Data Akun --}}

<div class="modal fade bd-example-modal-lg" id="modal-edit-akun" role="dialog" aria-labelledby="addOrgLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form method="POST" action="{{
                    route( $role == 'AdminPusat' ? 'admin.pusat.edit.account.cabang' : 'admin.cabang.edit.account.cabang' )
                }}">
                    @csrf
                    <input type="hidden" class="form-control"  placeholder="" name = "id" id="id-account">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nama Akun Cabang</label>
                                <input type="text" class="form-control"  placeholder="Nama Cabang" name="name_account" id="name-account">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Email Akun </label>
                                <input type="text" class="form-control"  placeholder="Email" name="email_account" id="email-account">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary float-right">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- Modal CS --}}
<div class="modal fade bd-example-modal-lg" id="modal-cs" role="dialog" aria-labelledby="addOrgLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form method="POST" action="" id="form-cs">
                    @csrf
                    <!-- <input type="hidden" class="form-control"  placeholder="" name = "id" id="id-account"> -->
                    <input type="hidden" name="id_kantor" id="id-kantor-cs">
                    <input type="" name="id_cs" id="id-cs">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nama </label>
                                <input type="text" class="form-control"  placeholder="Nama Cabang" name="name_cs" id="name-cs">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Email  </label>
                                <input type="text" class="form-control"  placeholder="Email" name="email_cs" id="email-cs">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Alamat</label>
                                <textarea class="form-control"  rows="3" name="address_cs" id="address-cs"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Provinsi</label>
                                <select class="form-control select2" name="provinsi_cs" id="provinsi-cs">
                                    @foreach($provinsi as $data)
                                        <option value="{{$data->id}}">{{$data->provinsi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Kabupaten</label>
                                <select class="form-control" name="kabkot_cs" id="kabkot-cs">
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
                                <label for="formGroupExampleInput">Kecamatan</label>
                                <select class="form-control" name="kecamatan_cs" id="kecamatan-cs">
                                    <option selected disabled>-Pilih Kecamatan-</option>
                                    @foreach($kecamatan as $data)
                                        <option value="{{$data->id}}">{{$data->kecamatan}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Kelurahan</label>
                                <select class="form-control" name="kelurahan_cs" id="kelurahan-cs">
                                    <option selected disabled>-Pilih Kelurahan-</option>
                                    @foreach($kelurahan as $data)
                                        <option value="{{$data->id}}">{{$data->kelurahan}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary float-right">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
