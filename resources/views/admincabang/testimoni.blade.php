@extends('layouts.admin')

@section('title', 'Testimoni')

@section('css')
    <style>
        .orange-outline{
            border-color:#E46931;
            color: #E46931;
        }
    </style>


@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <h1 class="m-0 text-dark ml-4 mt-4 mb-3">Pengelolaan Produk dan Akad Kredit</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <h3 >Total : {{$jumlah_testimoni}} Testimoni</h3>
                            </div>
                            <div class="col-3 offset-6 text-right">
                                <select name="" class="form-control" id="filter_kantor">
                                    @foreach($kantor as $data)
                                        @if($kantor_selected == $data->id)
                                            <option value="{{$data->id}}" selected>{{$data->nama_kantor}}</option>
                                        @else
                                            <option value="{{$data->id}}">{{$data->nama_kantor}}</option>
                                        @endif

                                    @endforeach

                                </select>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="list-produk" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Produk Kredit</th>
                                <th>Tanggal</th>
                                <th>Rating</th>
                                <th>Testimoni</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($testimoni as $data)
                                <tr>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->nama}}</td>
                                    <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->locale('id')->isoFormat('LL')}}</td>
                                    <td>{{$data->rating}}</td>
                                    <td>{{$data->testimoni}}</td>
                                    <td>  <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Lihat
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#" data-produk_id="{{$data->id}}" ><i class="fa fa-pencil-alt"></i> Edit</a>
                                            <a class="dropdown-item" onclick="hapusProduk({{$data->id}})"><i class="fa fa-trash-alt"></i> Hapus</a>
                                        </div></td>
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
    @include('adminpusat.modal.tambah_produk_kredit')
    @include('adminpusat.modal.edit_produk_kredit')
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script>
        $('#list-produk').DataTable();
    </script>

    <script>
        function hapusProduk(id){
            var agree=confirm("Apakah anda yakin ingin menghapus produk ini?");
            if (agree) {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    },
                    url: "{{route('admin.pusat.delete_produk')}}",
                    dataType: "JSON",
                    data : {id : id},
                    success: function (response) {
                        if (response == true){
                            location.reload();
                        }else{
                            toastr.error('Gagal Menghapus Nasabah');
                        }

                    }
                });

            }else {
                return false;
            }
        }

        $('#tambahProdukModal').on('show.bs.modal', function (event) {

            var jenis = $('#suku_bunga_tambah').val();
            if (jenis == "berjangka"){
                $('#suku_bunga_berjangka').show();
                $('#suku_bunga_flat').hide();
                $('.berjangka').attr('required');
                $('#bunga_flat').removeAttr('required');
            }else{
                $('#suku_bunga_flat').show();
                $('#suku_bunga_berjangka').hide();
                $('#bunga_flat').attr('required');
                $('.berjangka').removeAttr('required');
            }



        });




        $('#filter_kantor').on('change', function () {
            var kantor = $(this).val()
            window.location = '{{url('/admin-cabang/testimoni')}}'+"/"+kantor;
        });



    </script>
@endsection
