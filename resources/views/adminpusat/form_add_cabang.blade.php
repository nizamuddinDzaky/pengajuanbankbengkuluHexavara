
<link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
<form method="POST" action="{{$url_post}}">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Cabang @if($id_parent != 1) {{'Pembantu'}} @endif</h3>
        </div>
        <div class="card-body">
            @csrf
            @if($id_parent != 1 &&  $role == 'AdminPusat')
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Cabang Pembantu</label>
                        <select class="form-control select2" name="parent" id="provinsi">
                            @foreach($cabang as $data)
                                <option value="{{$data->id}}">{{$data->nama_kantor}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @else
                <input type="hidden" class="form-control" id="formGroupExampleInput" placeholder="" name="parent" value="{{$id_parent}}">
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Nama Cabang</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Nama Cabang" name="name">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Alamat Cabang</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="address"></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Provinsi</label>
                        <select class="form-control select2" name="provinsi" id="provinsi">
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
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Akun Cabang @if($id_parent != 1) {{'Pembantu'}} @endif</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Nama Akun Cabang @if($id_parent != 1) {{'Pembantu'}} @endif</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Nama Cabang" name="name_account">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Email Akun Cabang @if($id_parent != 1) {{'Pembantu'}} @endif</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Nama Cabang" name="email_account">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-orange float-right">Simpan</button>
        </div>
    </div>
</form>
<script src="{{asset('admin/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script>
    $('.timepicker').datetimepicker({
      format: 'LT'
    })

    $('#kabkot').on('change', function (){
        var id = $(this).val();

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-Token': "{{csrf_token()}}"
            },
            url: "{{url('/user/biodata/getkecamatan')}}",
            data: {id: id},
            success: function (data) {
                $('#kecamatan').empty();
                $('#kecamatan').append('<option selected disabled>-Pilih Kecamatan-</option>');
                for (var i = 0 ; i < data[0].length ; i++){
                    var kecamatan = '<option value="'+data[0][i]['id']+'">'+data[0][i]['kecamatan']+'</option>';
                    $('#kecamatan').append(kecamatan);
                }

                $('#kelurahan').empty();
                $('#kelurahan').append('<option selected disabled>-Pilih Kelurahan-</option>');
                for (var i = 0 ; i < data[1].length ; i++){
                    var kelurahan = '<option value="'+data[1][i]['id']+'">'+data[1][i]['kelurahan']+'</option>';
                    $('#kelurahan').append(kelurahan);
                }

                $('#kode_pos').val('');
            }
        });

    });

    $('#kecamatan').on('change', function (){
        var id = $(this).val();

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-Token': "{{csrf_token()}}"
            },
            url: "{{url('/user/biodata/getkelurahan')}}",
            data: {id: id},
            success: function (data) {
                $('#kelurahan').empty();
                for (var i = 0 ; i < data.length ; i++){
                    var kelurahan = '<option value="'+data[i]['id']+'">'+data[i]['kelurahan']+'</option>';
                    $('#kelurahan').append(kelurahan);
                }
                $('#kode_pos').val(data[0]['kd_pos']);
            }
        });

    });

    $('#kelurahan').on('change', function (){
        var id = $(this).val();

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-Token': "{{csrf_token()}}"
            },
            url: "{{url('/user/biodata/getkodepos')}}",
            data: {id: id},
            success: function (data) {
                $('#kode_pos').val(data['kd_pos']);
            }
        });

    });
</script>