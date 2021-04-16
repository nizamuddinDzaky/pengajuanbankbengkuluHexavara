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
                    <div class="card-header">
                        <h3 class="card-title">Daftar Cabang</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-default" id="btn-add-cabang" data-url-add = "{{$url}}" data-csrf = "{{csrf_token()}}">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="list-kantor" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Cabang</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kantor as $kant)
                                <tr>
                                    <td>{{$kant->nama_kantor}}</td>
                                    <td>{{$kant->alamat}}</td>
                                    <td class = "text-center">
                                        <span class="td-status badge badge-{{$kant->is_active == 1 ? 'success':'danger'}}" 
                                            data-id = "{{$kant->id}}"
                                            data-status = "{{$kant->is_active}}"
                                            data-name = "{{$kant->name}}",
                                            data-url = "{{route(
                                                            $role == 'AdminPusat'? 'admin.pusat.delete.kantor' : 'admin.cabang.delete.kantor', 
                                                                ['id_kantor' => $kant->id , 'next_status' => ($kant->is_active == 1 ? 0 : 1) ]
                                                        )}}"
                                        >
                                            {{$kant->is_active == 1 ? 'Aktif':'Tidak Aktif'}}</span>
                                    </td>
                                    <td class = "text-center">
                                        @if($role == 'AdminPusat')
                                        <button class="btn btn-sm btn-primary btn-list-cabang" data-cabang = "{{$kant->children}}" title="Daftar Cabang Pembantu" data-id = "{{$kant->id}}" data-url-form = "{{route('admin.pusat.form.add.cabang', ['id_cabang' => $kant->id])}}"><i class="fa fa-list" aria-hidden="true"></i></button>
                                        @endif
                                        <a href="{{route($role == 'AdminPusat'? 'admin.pusat.detail.kantor' : 'admin.cabang.detail.kantor', ['id_kantor' => $kant->id])}}" class="btn btn-sm btn-success" title="Detail"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
@endsection

@section('modal')
    @include('modal.list_cabang');
@endsection

@section('script')
<script>
    $('#list-kantor').DataTable({
      "paging": true,
      "lengthChange": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $(document).ready(function(){
        $('.btn-list-cabang').click(function(){
            if ( $.fn.DataTable.isDataTable('#list-cabang') ) {
              $('#list-cabang').DataTable().destroy();
            }
            $('#list-cabang tbody').empty();

            let data_cabang = $(this).data("cabang");
            let tr = '';
            $.each(data_cabang, function(key, value){
                tr += '<tr>' +
                            '<td>'+value.nama_kantor+'</td>' +
                            '<td>'+value.alamat+'</td>' +
                            '<td>'+value.is_active+'</td>' +
                            '<td> <a  href="{{url("/admin-pusat/detail_kantor/")}}/'+value.id+'" class="btn btn-sm btn-success" title="Detail" ><i class="fa fa-eye" aria-hidden="true"></i></a>'+'</td>' +
                        '</tr>'
            });
            $('#btn-tambah-cabang-pembantu').attr('data-url-form', $(this).data('url-form'))
            $('#tb-list-cabang').html(tr)
            $('#modal-list-cabang').modal('toggle');
            $('#modal-list-cabang').modal('show');
            $('#list-cabang').dataTable({});
        });
        $('#btn-add-cabang').click(function(){
            $.ajax({
               type:'GET',
               url:$(this).data('url-add'),
               data: {
                    _token : $(this).data('csrf')
               },
               success:function(data) {
                    $('#modal-content-add-cabang').html(data.view)
                    $('#add-cabang').modal('toggle');
                    $('#add-cabang').modal('show');
               }
            });
        });

        $('#btn-tambah-cabang-pembantu').click(function(){
            $('#modal-list-cabang').modal('toggle');

            $.ajax({
               type:'GET',
               url:$(this).data('url-form'),
               data: {
                    _token : $(this).data('csrf')
               },
               success:function(data) {
                    $('#modal-content-add-cabang').html(data.view)
                    $('#add-cabang').modal('toggle');
                    $('#add-cabang').modal('show');
               }
            });
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
        })
    })
</script>
@endsection