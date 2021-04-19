@extends('layouts.user')

@section('title','Biodata Diri')



@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="container d-flex justify-content-center">
                <div class="card mt-5 px-4 pt-4 pb-2">
                    <div class="media p-2"> <img src="https://imgur.com/yVjnDV8.png" class="mr-1 align-self-start">
                        <div class="media-body">
                            <div class="d-flex flex-row justify-content-between">
                                <h6 class="mt-2 mb-0">{{Auth::user()->name}}</h6>
                            </div>
                        </div>
                    </div>
                    <ul class="list text-muted mt-3 pl-0">
                        <li @if(Request::is('user/biodata')) class="option-active" @endif><a href="{{url('user/biodata')}}" style="color: inherit" ><i class="fa fa-user mr-3 ml-2"></i> Biodata Saya</a></li>
                        <li @if(Request::is('user/dokumen')) class="option-active" @endif><a href="{{url('user/dokumen')}}" style="color: inherit" ><i class="fa fa-file mr-3 ml-2"></i> Dokumen Saya</a></li>
                        <li @if(Request::is('user/ubah_katasandi')) class="option-active" @endif><a href="{{url('user/ubah_katasandi')}}" style="color: inherit" ><i class="fa fa-lock mr-3 ml-2"></i> Ubah Kata Sandi </a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <form action="{{url('user/biodata/update')}}" method="post">
                @csrf
                <div class="row">
                    <h3 class="mt-5">Biodata Diri</h3>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" value="{{Auth::user()->name}}" name="name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" value="{{Auth::user()->email}}" name="email" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="noktp">No KTP</label>
                            <input type="text" class="form-control" value="{{Auth::user()->no_ktp}}" name="no_ktp" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nohp">No Handphone</label>
                            <input type="text" class="form-control" value="{{Auth::user()->no_hp}}" name="no_hp" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tempatlahir">Tempat Lahir</label>
                            <input type="text" class="form-control" value="{{Auth::user()->tempat_lahir}}" name="tempat_lahir" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggallahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" value="{{Auth::user()->tanggal_lahir}}" name="tanggal_lahir" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alamat">Alamat Domisili</label>
                            <select name="provinsi" class="form-control" id="provinsi">
                                @foreach($provinsi as $data)
                                    <option value="{{$data->id}}">{{$data->provinsi}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alamat" style="color: #EEEFF3">-</label>
                            <select name="kabkot" class="form-control" id="kabkot">
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
                            <select name="kecamatan" class="form-control" id="kecamatan">
                                <option selected disabled>-Pilih Kecamatan-</option>
                                @foreach($kecamatan as $data)
                                    <option value="{{$data->id}}">{{$data->kecamatan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="kelurahan" class="form-control" id="kelurahan">
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
                            <input type="text" class="form-control" id="kode_pos" readonly placeholder="Kode Pos">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="alamat" class="form-control" value="{{Auth::user()->alamat}}" placeholder="Alamat Lengkap">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggallahir">Pekerjaan</label>
                            <input type="text" class="form-control" value="{{Auth::user()->pekerjaan}}" name="pekerjaan" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggallahir">Nomor NPWP</label>
                            <input type="text" maxlength="15" minlength="15" value="{{Auth::user()->npwp}}" class="form-control" name="no_npwp" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button style="float: right" type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>



    @endsection


@section('script')

    <script type="text/javascript">

        $(document).ready(function() {
            var kabkot = {{Auth::user()->kabkot_id}};
            var kecamatan = {{Auth::user()->kecamatan_id}};
            var kelurahan = {{Auth::user()->kelurahan_id}};

            if (kabkot != null){
                $('#kabkot').val(kabkot);
            }

            if (kecamatan != null){
                $('#kecamatan').val(kecamatan);
            }

            if (kelurahan != null){
                $('#kelurahan').val(kelurahan);
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    },
                    url: "{{url('/user/biodata/getkodepos')}}",
                    data: {id: kelurahan},
                    success: function (data) {
                        $('#kode_pos').val(data['kd_pos']);
                    }
                });
            }


        });

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



    @endsection
