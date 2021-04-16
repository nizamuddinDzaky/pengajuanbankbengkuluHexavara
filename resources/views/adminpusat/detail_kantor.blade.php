@extends('layouts.admin')

@section('title', $kantor->nama_kantor)

@section('css')
    <style>
        .td-status{
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="m-0 text-dark ml-4 mt-4 mb-3"></h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Account Admin    </h3>

                        <div class="card-tools">
                            <button type="button"class="btn btn-outline-warning" id= "btn-edit-account" data-value = "{{$account_admin}}">
                                Edit Data
                            </button>
                            <button type="button"class="btn btn-outline-warning" id="btn-reset-password" 
                                data-id = "{{ $account_admin->id }}"
                                data-url = "{{route(
                                                $role == 'AdminPusat' ? 'admin.pusat.edit.reset.password' : 'admin.cabang.edit.reset.password'
                                                , ['id_account' => $account_admin->id]
                                            )}}"
                            >
                                Reset Password
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>Nama</th>
                                <td>{{$account_admin->name}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{$account_admin->email}}</td>
                            </tr>
                        </table>
                    </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <span class="info-box-text"><h4>{{$kantor->nama_kantor}}</h4></span>
                            <span class="info-box-text"><p>{{$kantor->alamat}} ,Kelurahan {{$kantor->kelurahan->kelurahan ?? '-'}}, Kecamatan {{$kantor->kecamatan->kecamatan ?? '-'}}, {{$kantor->kabupaten->kabupaten_kota}}, {{$kantor->provinsi->provinsi}}</p></span>
                            <span class="info-box-text">Waktu Layanan</span>
                            <span class="info-box-text"><p>{{$kantor->start_service}} s/d {{$kantor->end_service}}</p></span>
                            <span class="info-box-text">Waktu Layanan Customer Servis</span>
                            <span class="info-box-text"><p>{{$kantor->duration_service}} Menit/Layanan</p></span>
                        </div>
                        <div class="col-md-2">
                            <button type="button"class="btn btn-outline-warning" id="edit-kantor" data-value = "{{$kantor}}">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Account Admin </h3>
                    <div class="card-tools">
                        <button type="button"class="btn btn-outline-warning" id= "btn-add-cs" data-url="{{route(
                                                                                                                $role == 'AdminPusat' ? 'admin.pusat.add.teller' :'admin.cabang.add.teller'
                                                                                                        )}}" 
                                data-id-kantor = "{{$kantor->id}}">
                            Tambah Cs
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    
                    <table class="table table-bordered table-hover" id="table-cs">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customer_service as $cs)
                            <tr>
                                <td>{{ $cs->name }}</td>
                                <td>{{ $cs->email }}</td>
                                <td>{{ $cs->alamat }}</td>
                                <!-- <td>{{ $cs->is_active }}</td> -->
                                <td>
                                    <span class="td-status badge badge-{{$cs->is_active == 1 ? 'success':'danger'}}" 
                                            data-id = "{{$cs->id}}"
                                            data-status = "{{$cs->is_active}}"
                                            data-name = "{{$cs->name}}",
                                            data-url = "{{route(
                                                            $role == 'AdminPusat'? 'admin.pusat.edit.status.cs' : 'admin.cabang.edit.status.cs', 
                                                                ['id_cs' => $cs->id , 'next_status' => ($cs->is_active == 1 ? 0 : 1) ]
                                                        )}}"
                                    > {{$cs->is_active == 1 ? 'Aktif':'Tidak Aktif'}} </span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-primary btn-edit-cs" data-cs = "{{$cs}}" title="update data user" 
                                            data-url = "{{ route(
                                                                $role == 'AdminPusat' ? 'admin.pusat.edit.cs' : 'admin.cabang.edit.cs'
                                                            ) }}"
                                    >
                                        Edit
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
@include('modal.detail_kantor');
@endsection

@section('script')
<script>
    var data_kantor = [];
    var data_cs = [];
    $('#table-cs').DataTable({});
    $(document).ready(function(){

        $('.btn-edit-cs').click(async function(){
            data_cs = $(this).data('cs');
            $('#form-cs').attr('action', $(this).data('url'));
            await setup_data_form_cs();
            $('#modal-cs').modal('toggle');
            $('#modal-cs').modal('show');
        })

        $('.td-status').click(function(){
            let is_active = $(this).data("status");
            let message = '';
            let name = $(this).data("name");
            let url = $(this).data("url");
            if(is_active == 1 || is_active == '1'){
                message = 'Apakah Anda Ingin Me non Aktifkan Kantor ?';
            }else{
                message = 'Apakah Anda Ingin Meng Aktifkan Kantor ?';
            }
            sweet_alert("question", name, message, true).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                } else if (result.isDismissed) {
                    return false;
                }
            })
        });

        $('#btn-reset-password').click(function(){
            sweet_alert("question", "Reset Password", "Apakah Anda Ingin Reset Password", true).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = $(this).data('url');
                } else if (result.isDismissed) {
                    return false;
                }
            })
        })
        
        $('#edit-kantor').click(async function(){
            console.log($(this).data('value'))
            data_kantor = $(this).data('value')
            await setup_data_form()
            $('#modal-edit-kantor').modal('toggle');
            $('#modal-edit-kantor').modal('show');
        })

        $('#btn-edit-account').click(function(){
            let data = $(this).data('value');
            $('#name-account').val(data.name);
            $('#email-account').val(data.email);
            $('#id-account').val(data.id);
            
            $('#modal-edit-akun').modal('toggle');
            $('#modal-edit-akun').modal('show');
        });

        $('#btn-add-cs').click(function(){
            $('#id-kantor-cs').val($(this).data('id-kantor'))
            $('#form-cs').attr('action', $(this).data('url'));
            $('#modal-cs').modal('toggle');
            $('#modal-cs').modal('show');
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
                        let selected_kecamatan = '';
                        if(data_kantor.kecamatan_id == data[0][i]['id']){
                            selected_kecamatan = 'selected'
                        }
                        var kecamatan = '<option value="'+data[0][i]['id']+'" '+selected_kecamatan+'>'+data[0][i]['kecamatan']+'</option>';
                        $('#kecamatan').append(kecamatan);
                    }

                    if(data_kantor.kecamatan_id != ''){
                        $('#kecamatan').change();
                    }

                    $('#kelurahan').empty();
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
                        let selected_kelurahan = '';
                        if(data_kantor.kelurahan_id == data[i]['id']){
                            selected_kelurahan = 'selected'
                        }
                        var kelurahan = '<option value="'+data[i]['id']+'" '+selected_kelurahan+'>'+data[i]['kelurahan']+'</option>';
                        $('#kelurahan').append(kelurahan);
                    }
                    if(data_kantor.kelurahan_id != ''){
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


        $('#kabkot-cs').on('change', function (){
            var id = $(this).val();

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                url: "{{url('/user/biodata/getkecamatan')}}",
                data: {id: id},
                success: function (data) {
                    $('#kecamatan-cs').empty();
                    $('#kecamatan-cs').append('<option selected disabled>-Pilih Kecamatan-</option>');
                    for (var i = 0 ; i < data[0].length ; i++){
                        let selected_kecamatan = '';
                        if(data_cs.kecamatan_id == data[0][i]['id']){
                            selected_kecamatan = 'selected'
                        }
                        var kecamatan = '<option value="'+data[0][i]['id']+'" '+selected_kecamatan+'>'+data[0][i]['kecamatan']+'</option>';
                        $('#kecamatan-cs').append(kecamatan);
                    }

                    if(data_cs.kecamatan_id != ''){
                        $('#kecamatan-cs').change();
                    }

                    $('#kelurahan-cs').empty();
                }
            });

        });

        $('#kecamatan-cs').on('change', function (){
            var id = $(this).val();

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                url: "{{url('/user/biodata/getkelurahan')}}",
                data: {id: id},
                success: function (data) {
                    $('#kelurahan-cs').empty();
                    for (var i = 0 ; i < data.length ; i++){
                        let selected_kelurahan = '';
                        if(data_cs.kelurahan_id == data[i]['id']){
                            selected_kelurahan = 'selected'
                        }
                        var kelurahan = '<option value="'+data[i]['id']+'" '+selected_kelurahan+'>'+data[i]['kelurahan']+'</option>';
                        $('#kelurahan-cs').append(kelurahan);
                    }
                    if(data_cs.kelurahan_id != ''){
                        $('#kelurahan-cs').change();
                    }

                    $('#kode_pos-cs').val(data[0]['kd_pos']);
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
    })

    function setup_data_form(){
        console.log(data_kantor.nama_kantor);
        $('#name').val(data_kantor.nama_kantor);
        $('#address').val(data_kantor.alamat);
        $('#provinsi').val(data_kantor.provinsi_id);
        $('#id').val(data_kantor.id);
        if(data_kantor.kabkot_id != ''){
            $('#kabkot').val(data_kantor.kabkot_id).change()
        }
    }

    function setup_data_form_cs(){
        $('#name-cs').val(data_cs.name);
        $('#address-cs').val(data_cs.alamat);
        $('#provinsi-cs').val(data_cs.provinsi_id);
        $('#id-cs').val(data_cs.id);
        $('#email-cs').val(data_cs.email);
        if(data_cs.kabkot_id != ''){
            $('#kabkot-cs').val(data_cs.kabkot_id).change()
        }
    }
</script>
@endsection