@extends('layouts.admin')

@section('title', 'Daftar Cabang')

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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h5><b>Kantor Pusat</b></h5>
                                <p>Jl. Basuki Rahmat No.6, Belakang Pd., Kec. Ratu Samban, Kota Bengkulu, Bengkulu 38222</p>
                                <p>Waktu Layanan: <br/> 08:00 - 15:00</p>
                                <p>Waktu Layanan Customer Service: <br/>20 menit/layanan    </p>
                            </div>
                            <div class="col-md-4">
                                <button class="float-right btn btn-orange">Edit </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    @if($role == 'AdminPusat')
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#cabang" role="tab" aria-controls="home" aria-selected="true">Cabang</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#cabang-pembantu" role="tab" aria-controls="profile" aria-selected="false">Cabang Pembantu</a>
                            </li>
                        </ul>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="cabang" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5>Daftar Cabang</h5>
                                        <p>Total : {{count($cabang)}}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="float-right btn btn-orange" id="btn-add-cabang" data-url-add = "{{$url_add_form}}" data-csrf = "{{csrf_token()}}">Tambah </button>
                                    </div>
                                </div>
                                
                                <table id="list-cabang" class="table table-bordered table-hover datatable">
                                    <thead>
                                        <tr>
                                            <th>Nama Cabang</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Alamat Lengkap</th>
                                            <th>Role</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cabang as $c)
                                            <tr>
                                                <td>{{$c->nama_kantor}}</td>
                                                <td>{{$c->admin->email}}</td>
                                                <th>{!! $c->str_status() !!}</th>
                                                <td>{{$c->alamat}}</td>
                                                <td>{{$c->admin->userRole->role->role}}</td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <a class="btn btn-default dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Atur
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item btn-edit-cabang" href="#" data-url-edit = "{{ $c->url_form_edit($role) }}" data-csrf = "{{csrf_token()}}">Edit</a>
                                                            <a class="dropdown-item td-status" href="{{route($param_route_edit_status_cabang, $c->param_route_edit_status())}}">{{$c->str_change_staus()}}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade " id="cabang-pembantu" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5>Daftar Cabang Pembantu</h5>
                                        <p>Total : {{count($cabangPembantu)}}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="float-right btn btn-orange" id="btn-add-cabang-pembantu" data-url-add = "{{route('admin.pusat.form.add.cabang', ['id_parent' =>  0])}}" data-csrf = "{{csrf_token()}}">Tambah </button>
                                    </div>
                                </div>
                                <table id="" class="table table-bordered table-hover datatable">
                                    <thead>
                                        <tr>
                                            <th>Nama Cabang</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Alamat Lengkap</th>
                                            <th>Role</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cabangPembantu as $cp)
                                            <tr>
                                                <td>{{$cp->nama_kantor}}</td>
                                                <td>{{$cp->admin->email}}</td>
                                                <th>{!! $cp->str_status() !!}</th>
                                                <td>{{$cp->alamat}}</td>
                                                <td>{{$cp->admin->userRole->role->role}}</td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <a class="btn btn-default dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Atur
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item btn-edit-cabang" href="#" data-url-edit = "{{ $cp->url_form_edit($role) }}" data-csrf = "{{csrf_token()}}">Edit</a>
                                                            <a class="dropdown-item td-status" href="{{route($param_route_edit_status_cabang, $cp->param_route_edit_status())}}">{{$cp->str_change_staus()}}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('adminpusat.modal.modal_list_cabang');
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('#btn-add-cabang').click(function(){
            $.ajax({
               type:'GET',
               url:$(this).data('url-add'),
               data: {
                    _token : $(this).data('csrf')
               },
               success:function(data) {
                    $('#modal-content-form-cabang').html(data.view)
                    $('#modal-title-form-cabang').text("Tambah Data Cabang")
                    $('#modal-form-cabang').modal('toggle');
                    $('#modal-form-cabang').modal('show');
               }
            });
        });

        $('#btn-add-cabang-pembantu').click(function(){
            $.ajax({
               type:'GET',
               url:$(this).data('url-add'),
               data: {
                    _token : $(this).data('csrf')
               },
               success:function(data) {
                    $('#modal-content-form-cabang').html(data.view)
                    $('#modal-title-form-cabang').text("Tambah Data Cabang")
                    $('#modal-form-cabang').modal('toggle');
                    $('#modal-form-cabang').modal('show');
               }
            });
        });

        $('.btn-edit-cabang').click(function(){

            $.ajax({
               type:'GET',
               url:$(this).data('url-edit'),
               data: {
                    _token : $(this).data('csrf')
               },
               success:function(data) {
                    $('#modal-content-form-cabang').html(data.view)
                    $('#modal-title-form-cabang').text("Edit Data Cabang")
                    $('#modal-form-cabang').modal('toggle');
                    $('#modal-form-cabang').modal('show');
               }
            });
        });

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
        })
    })
</script>
@endsection