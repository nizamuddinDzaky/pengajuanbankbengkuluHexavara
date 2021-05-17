@extends('layouts.admin')

@section('title', 'Daftar Customer Service')

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
                            <p><b>Total : </b> {{count($customer_service)}}</p>
                        </div>
                        <div class="col-md-4">
                            <button class="float-right btn btn-orange" data-url-add = "{{$url_add_form}}" id="btn-add-cs" data-csrf = "{{csrf_token()}}">Tambah </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Kantor</label>
                                <select class="form-control select2" name="" id="filter-cs" data-url-filter-cs = {{$url_filter_cs}}>
                                    <option value="">Pilih Cabang</option>
                                    @if($role == 'AdminPusat')
                                    <optgroup label="Cabang Pusat">
                                        <option value="1">Pusat</option>
                                    </optgroup>
                                    <optgroup label="Cabang">
                                        @foreach($cabang as $cab)
                                        <option value="{{$cab->id}}" @if(app('request')->input('kantor_id') == $cab->id) {{'selected'}} @endif>{{$cab->nama_kantor}}</option>
                                        @endforeach
                                    </optgroup>
                                    @endif
                                    <optgroup label="Cabang Pembantu">
                                        @foreach($cabang_pembantu as $capem)
                                        <option value="{{$capem->id}}" @if(app('request')->input('kantor_id') == $capem->id) {{'selected'}} @endif>{{$capem->nama_kantor}}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Hak Akses</th>
                                    <th scope="col">Rata-rata Pelayanan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Cabang/Capem</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer_service as $cs)
                                <tr>
                                    <th scope="row">#</th>
                                    <td>{{$cs->user->name}}</td>
                                    <td>{{$cs->user->email}}</td>
                                    <td>{{$cs->type_cs->name}}</td>
                                    <td>@mdo</td>
                                    <td>{!! $cs->str_status() !!}</td>
                                    <td>{{$cs->user->kantor->nama_kantor}}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="btn btn-default dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Atur
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item btn-edit-cs" href="#" data-url-edit = "{{ $cs->url_form_edit($role) }}" data-csrf = "{{csrf_token()}}">Edit</a>
                                                <a class="dropdown-item td-status"  href="{{route($param_route_edit_status_cs, $cs->param_route_edit_status())}}">{{$cs->str_change_staus()}}</a>
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
@endsection

@section('modal')
    @include('adminpusat.modal.modal_list_cs');
@endsection


@section('script')
<script>
    $(document).ready(function(){
        $('#btn-add-cs').click(function(){
            $.ajax({
               type:'GET',
               url:$(this).data('url-add'),
               data: {
                    _token : $(this).data('csrf')
               },
               success:function(data) { 
                   console.log(data)
                    $('#modal-content-form-cs').html(data.view)
                    $('#modal-title-form-cs').text("Tambah Customer Service")
                    $('#modal-form-cs').modal('toggle');
                    $('#modal-form-cs').modal('show');
               }
            });  
        })
        $('#filter-cs').change(function(){
            let kantor_id= $(this).val();
            let param ='';
            if(kantor_id != ''){
                param = '?kantor_id='+$(this).val();
            }
            window.location.href =$(this).data('url-filter-cs')+param;
        });

        $('.btn-edit-cs').click(function(){

            $.ajax({
            type:'GET',
            url:$(this).data('url-edit'),
            data: {
                    _token : $(this).data('csrf')
            },
            success:function(data) {
                    $('#modal-content-form-cs').html(data.view)
                    $('#modal-title-form-cs').text("Edit Data cs")
                    $('#modal-form-cs').modal('toggle');
                    $('#modal-form-cs').modal('show');
            }
            });
        });
    })
</script>
@endsection