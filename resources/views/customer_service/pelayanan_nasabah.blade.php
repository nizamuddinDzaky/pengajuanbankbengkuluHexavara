@extends('layouts.admin')

@section('title', 'Pelayanan Nasabah')


@section('css')
    <style>
        .button-flex{
            display: inline-flex;
            max-width:33%;
        }

        .button-flex .btn {
            display: flex;
            flex: 0 0 100%;
        }

        .widthmax {
            width: 100%;
        }

        .orange-outline{
            border-color:#E46931;
            color: #E46931;
        }

        .orange-primary {
            background-color: #E46931;
            color: white;
        }
    </style>
    @endsection

@section('content')

    <div class="container-fluid">
        <div class="row" style="border: 1px black">
            <div class="col-10">
                <div class="row">
                    <h3 class="m-0 text-dark ml-4 mt-4 mb-3">Pelayanan Nasabah</h3>
                </div>
            </div>
            <div class="col-2 mt-4 my-auto">
                <input type="text" value="{{\Carbon\Carbon::now()->format('d F Y')}}" class="form-control" disabled>
            </div>

        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 text-left">
                                <p class="text-muted">Nasabah saat ini</p>
                            </div>
                            <div class="col-6 text-right">
                                <p class="text-muted">Sesi 1</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-left">
                                <h3 >Indah Kurniasari</h3>
                            </div>
                            <div class="col-6 text-right">
                                <p >08:00 - 08:20</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-left">
                                <p class="text-muted">Multiguna Aktif</p>
                            </div>
                            <div class="col-6 text-right">
                                <p class="text-muted">Jangka waktu</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-left">
                                <p class="text-muted">Rp 50.000.000</p>
                            </div>
                            <div class="col-6 text-right">
                                <p>4 Tahun</p>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer" style="background-color: white">
                        <div class="row">
                            <div class="col-4 btnProses" >
                                <button class="btn mr-2 orange-primary widthmax " onclick="setTimer()">Proses</button>
                            </div>
                            <div class="col-4">
                                <button class="btn orange-outline mr-2 widthmax" data-toggle="modal" data-target="#detailFakturModal" >Detail Pengajuan</button>
                            </div>
                            <div class="col-4">
                                <button class="btn orange-outline mr-2 widthmax"><i class="fa fa-print icon"> </i> Cetak Blangko</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 text-left">
                                <p class="text-muted">Nasabah berikutnya</p>
                            </div>
                            <div class="col-6 text-right">
                                <p class="text-muted">Sesi 1</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-left">
                                <h3 class="text-muted">Indah Kurniasari</h3>
                            </div>
                            <div class="col-6 text-right">
                                <p class="text-muted">08:00 - 08:20</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-left">
                                <p class="text-muted">Multiguna Aktif</p>
                            </div>
                            <div class="col-6 text-right">
                                <p class="text-muted">Jangka waktu</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-left">
                                <p class="text-muted">Rp 50.000.000</p>
                            </div>
                            <div class="col-6 text-right">
                                <p class="text-muted">4 Tahun</p>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer" style="background-color: white">
                        <div class="row">
                            <div class="col-4" >
                                <button class="btn btn-secondary mr-2  widthmax " disabled>Proses</button>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-outline-secondary mr-2 widthmax " disabled>Detail Pengajuan</button>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-outline-secondary mr-2 widthmax" disabled><i class="fa fa-print icon"> </i> Cetak Blangko</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="row cardTimer">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 text-center">
                                <h3 class="text-muted mt-4 mb-5">Waktu Pelayanan</h3>
                                <p id="time" style="font-size: 90pt">20 : 00</p>
                                <p style="font-size: 20pt">Menit  Detik</p>
                                <button class="btn orange-primary mt-3" style="width: 30%">Selesai</button>

                            </div>
                            <div class="col-6">
                                <img src="{{asset('images/cs-timer.png')}}" class="img-fluid"></img>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('modal')
    @include('customer_service.modal.detail_pengajuan')



    @endsection


@section('script')

    <script type="text/javascript">

        function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + " : " + seconds;

                if (--timer < 0) {
                    timer = duration;
                }
            }, 1000);
        }

        window.onload = function () {
          $('.cardTimer').hide();
        };

      function setTimer () {
          $('.cardTimer').show();
          $('.btnProses').remove();
          var fiveMinutes = 60 * 20,
              display = document.querySelector('#time');
          startTimer(fiveMinutes, display);
      }




    </script>

    @endsection
