
<link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
<form method="POST" action="{{$url_post}}">
    <div class="card">
        <div class="card-header">
            
        </div>
        <div class="card-body">
            <input type="hidden" name="id" value="{{$cabang->id}}">
            @csrf
            @if($cabang->parent != 1 && $role == 'AdminPusat')
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Cabang Pembantu</label>
                        <select class="form-control select2" name="parent">
                            @foreach($list_cabang as $data)
                                <option value="{{$data->id}}" @if( $data->id == $cabang->parent) {{'selected'}} @endif>{{$data->nama_kantor}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Nama Cabang</label>
                        <input type="text" class="form-control" id="" placeholder="Nama Cabang" name="name" value="{{$cabang->nama_kantor}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Alamat Cabang</label>
                        <textarea class="form-control" id="" rows="3" name="address">{{$cabang->alamat}}</textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Provinsi</label>
                        <select class="form-control select2" name="provinsi" id="provinsi" data-value="{{$cabang->provinsi_id}}">
                            @foreach($provinsi as $data)
                                <option value="{{$data->id}}">{{$data->provinsi}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Kabupaten</label>
                        <select class="form-control" name="kabkot" id="kabkot" data-value="{{$cabang->kabkot_id}}">
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
                        <select class="form-control" name="kecamatan" id="kecamatan" data-value="{{$cabang->kecamatan_id}}">
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
                        <select class="form-control" name="kelurahan" id="kelurahan" data-value="{{$cabang->kelurahan_id}}">
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
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Nama Akun Cabang</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Nama Cabang" name="name_account" value="{{$cabang->admin->name}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Email Akun Cabang</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Nama Cabang" name="email_account" value="{{$cabang->admin->email}}">
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

    $(document).ready(function(){
        if($('#kabkot').data('value') != ''){
            $('#kabkot').val($('#kabkot').data('value')).change();
        }
    })
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
                let value_kecamatan = $('#kecamatan').data('value');
                let is_selected = false;
                for (var i = 0 ; i < data[0].length ; i++){
                    let selected_kecamatan = '';
                    if(value_kecamatan == data[0][i]['id']){
                        selected_kecamatan = 'selected'
                        is_selected = true;
                    }
                    var kecamatan = '<option value="'+data[0][i]['id']+'" '+selected_kecamatan+'>'+data[0][i]['kecamatan']+'</option>';
                    $('#kecamatan').append(kecamatan);
                }
                if(is_selected){
                    $('#kecamatan').change();
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
                
                let value_kelurahan = $('#kelurahan').data('value');
                let is_selected = false;
                for (var i = 0 ; i < data.length ; i++){

                    let selected_kelurahan = '';
                    if(value_kelurahan == data[i]['id']){
                        selected_kelurahan = 'selected'
                        is_selected = true;
                    }

                    var kelurahan = '<option value="'+data[i]['id']+'" '+selected_kelurahan+'>'+data[i]['kelurahan']+'</option>';
                    $('#kelurahan').append(kelurahan);
                }

                if(is_selected){
                    $('#kelurahan').change();
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