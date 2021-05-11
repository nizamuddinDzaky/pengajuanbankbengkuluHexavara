@extends('layouts.admin')

@section('title', 'Daftar Cabang')

@section('css')
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <h1 class="m-0 text-dark ml-4 mt-4 mb-3">Report</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <h3 >Total : {{$jumlah_transaksi}} Transaksi</h3>
                            </div>
                            <div class="col-3">
                                <select name="" id="" class="form-control">
                                    <option value="" selected disabled>Semua Kantor</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="" id="" class="form-control">
                                    <option value="" selected disabled>Pilih Bulan</option>
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
                        <table id="list-transaksi" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Kode Registrasi</th>
                                <th>Tanggal Transaksi</th>
                                <th>Nama Nasabah</th>
                                <th>Produk Kredit</th>
                                <th>Jumlah Plafond</th>
                                <th>Jangka Waktu</th>
                                <th>Status Transaksi</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($transaksi as $data)
                                <tr>
                                    <td>{{$data->kode_registrasi}}</td>
                                    <td>{{\Carbon\Carbon::createFromFormat('Y-m-d',$data->tanggal)->locale('id')->isoFormat('LL')}}</span></td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->nama_produk}}</td>
                                    <td>Rp {{number_format($data->plafond, 0 , ',' , '.')}}</td>
                                    <td>{{$data->masa_tenor}} Bulan</td>
                                    @if(\Carbon\Carbon::now() > \Carbon\Carbon::createFromFormat('Y-m-d', $data->tanggal) && $data->jam_mulai_pelayanan == null)
                                        <td>Tidak Datang</td>
                                    @else
                                        <td>{{$data->status}}</td>
                                        @endif
                                    <td>  <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Lihat
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#detailNasabahModal" >Lihat Detail</a>
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
    @include('adminpusat.modal.detail_nasabah');
@endsection

@section('script')
    <script>
        $('#list-transaksi').DataTable();
    </script>

    <script>
        {{--function hapusNasabah(id){--}}
        {{--    var agree=confirm("Apakah anda yakin ingin menghapus nasabah ini?");--}}
        {{--    if (agree) {--}}
        {{--        $.ajax({--}}
        {{--            type: "POST",--}}
        {{--            headers: {--}}
        {{--                'X-CSRF-Token': "{{csrf_token()}}"--}}
        {{--            },--}}
        {{--            url: "{{route('admin.pusat.delete_nasabah')}}",--}}
        {{--            dataType: "JSON",--}}
        {{--            data : {id : id},--}}
        {{--            success: function (response) {--}}
        {{--                if (response == true){--}}
        {{--                    location.reload();--}}
        {{--                }else{--}}
        {{--                    toastr.error('Gagal Menghapus Nasabah');--}}
        {{--                }--}}

        {{--            }--}}
        {{--        });--}}

        {{--    }else {--}}
        {{--        return false;--}}
        {{--    }--}}
        {{--}--}}
    </script>
@endsection
