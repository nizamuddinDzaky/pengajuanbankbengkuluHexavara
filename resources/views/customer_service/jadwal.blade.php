@extends('layouts.admin')

@section('title', 'Jadwal')


@section('content')

    <div class="container-fluid">
        <div class="row" style="border: 1px black">
            <div class="col-10">
                <div class="row">
                <h1 class="m-0 text-dark ml-4 mt-4 mb-3">Jadwal</h1>
                </div>
                <div class="row">
                    <h4 class="m-0 text-dark ml-4 mb-3">Terdapat : <span class="font-weight-bold">20 Nasabah</span> </h4>
                </div>
            </div>
            <div class="col-2 mt-5 my-auto">
                <input type="text" value="{{\Carbon\Carbon::now()->format('d F Y')}}" class="form-control" disabled>
            </div>

        </div>
        <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="jadwal" class="table table-hover">
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

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>


@endsection

@section('script')
    <script type="text/javascript">
        $('#jadwal').DataTable({
            "lengthChange": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    </script>



    @endsection
