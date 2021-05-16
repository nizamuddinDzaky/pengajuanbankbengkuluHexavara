@extends('layouts.admin')

@section('title', 'Pengelolaan Nasabah')

@section('css')
    <link href="{{asset('css/tab_bar_modal.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <h1 class="m-0 text-dark ml-4 mt-4 mb-3">Pengelolaan Nasabah</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <h3 >Total : {{$jumlah_nasabah}} Nasabah</h3>
                            </div>
                            <div class="col-3">
                                <select name="" id="" class="form-control">
                                    <option value="" selected disabled>Semua Kantor</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="" id="" class="form-control">
                                    <option value="" selected disabled>Pilih Filter</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="" id="" class="form-control">
                                    <option value="" selected disabled>Urutkan Berdasarkan</option>
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
                        <table id="list-nasabah" class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID Nasabah</th>
                                <th>Informasi Nasabah</th>
                                <th>No KTP</th>
                                <th>Email</th>
                                <th>Cabang / Capem</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($nasabah as $data)
                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->name}}<br><span class="text-muted">{{$data->pekerjaan}}</span></td>
                                    <td>{{$data->no_ktp}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->nama_kantor}}</td>
                                    <td>  <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Atur
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#detailNasabahModal" data-id="{{$data->id}}" >Lihat Detail</a>
                                            <a class="dropdown-item" onclick="hapusNasabah({{$data->id}})">Hapus</a>
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
    @include('adminpusat.modal.detail_nasabah')
@endsection

@section('script')
    <script src="{{asset('js/tab-bar.js')}}"></script>
    <script>
        $('#list-nasabah').DataTable({
            "paging": true,
            "lengthChange": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    </script>

    <script>
        function hapusNasabah(id){
            var agree=confirm("Apakah anda yakin ingin menghapus nasabah ini?");
            if (agree) {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    },
                    url: "{{route('admin.pusat.delete_nasabah')}}",
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

        $('#detailNasabahModal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget);
            var id = button.data('id');


            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                url: "{{route('admin.pusat.detail_nasabah')}}",
                dataType: "JSON",
                data : {id : id},
                success: function (response) {
                    $('#nama').val(response['name'])
                    $('#email').val(response['email'])
                    $('#no_ktp').val(response['no_ktp'])
                    $('#no_hp').val(response['no_hp'])
                    $('#tempat_lahir').val(response['tempat_lahir'])
                    $('#tanggal_lahir').val(response['tanggal_lahir'])
                    $('#jenis_kelamin').val(response['jenis_kelamin'])
                    $('#pekerjaan').val(response['pekerjaan'])
                    $('#no_npwp').val(response['npwp'])
                    $('#alamat').val(response['alamat'])
                    $('#provinsi').val(response['provinsi'])
                    $('#kabkot').val(response['kabkot'])
                    $('#kecamatan').val(response['kecamatan'])
                    $('#kelurahan').val(response['kelurahan'])
                    $('#kode_pos').val(response['kode_pos'])


                    //dokumen
                    $('#foto_ktp').val(JSON.parse(response['path_file']).ktp)
                    $('#pas_foto').val(JSON.parse(response['path_file']).pas_foto)
                    $('#foto_npwp').val(JSON.parse(response['path_file']).npwp)



                    $('#lihat_ktp').attr("href","/"+JSON.parse(response['path_file']).ktp);
                    $('#lihat_pas_foto').attr("href","/"+JSON.parse(response['path_file']).pas_foto);
                    $('#lihat_npwp').attr("href","/"+JSON.parse(response['path_file']).npwp);









                }
            });






        });

    </script>
@endsection
