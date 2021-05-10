@extends('layouts.admin')

@section('title', 'Jadwal')

@section('css')
    <link href="{{asset('css/tab_bar_modal.css')}}" rel="stylesheet" type="text/css" />
    @endsection



@section('content')

    <div class="container-fluid">
        <div class="row" style="border: 1px black">
            <div class="col-10">
                <div class="row">
                <h1 class="m-0 text-dark ml-4 mt-4 mb-3">Jadwal</h1>
                </div>
                <div class="row">
                    <h4 class="m-0 text-dark ml-4 mb-3">Terdapat : <span class="font-weight-bold">{{$jumlah}} Nasabah</span> </h4>
                </div>
            </div>
            <div class="col-2 mt-5 my-auto">
                <input type="text" value="{{\Carbon\Carbon::now()->locale('id')->isoFormat('LL')}}" class="form-control" disabled>
            </div>

        </div>
        <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="jadwal_table" class="table">
                                <thead>
                                <tr>
                                    <th>Kode Registrasi</th>
                                    <th>Slot Waktu</th>
                                    <th>Nama Nasabah</th>
                                    <th>Produk Kredit</th>
                                    <th>Jumlah Plafond</th>
                                    <th>Jangka Waktu</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transaksi as $data)
                                    <tr>
                                        <td>{{$data->kode_pengajuan}}</td>
                                        <td>{{substr($data->jam_mulai,0,5).' - '.substr($data->jam_selesai,0,5)}}</td>
                                        <td>{{$data->name}}</td>
                                        <td>{{$data->nama}}</td>
                                        <td>Rp {{number_format( $data->plafond , 0 , ',' , '.' )}}</td>
                                        <td>{{$data->masa_tenor}} bulan</td>
                                        <td><button class="btn btn-outline-secondary" data-toggle="modal" data-target="#detailPengajuanModal" data-transaksi_id = {{$data->transaksi_id}}>Lihat Detail</button></td>
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
    @include('user.daftar_pengajuan.modal.detail_pengajuan')
    @endsection

@section('script')
    <script src="{{asset('js/detail_pengajuan.js')}}"></script>
    <script src="{{asset('js/tab-bar.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#jadwal_table').DataTable();
        });
    </script>







    @endsection
