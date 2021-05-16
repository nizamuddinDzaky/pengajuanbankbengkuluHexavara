@extends('layouts.admin')

@section('title', 'Pelayanan Nasabah')


@section('css')
    <link href="{{asset('css/tab_bar_modal.css')}}" rel="stylesheet" type="text/css" />

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
                <input type="text" value="{{\Carbon\Carbon::now()->locale('id')->isoFormat('LL')}}" class="form-control" disabled>
            </div>

        </div>
        <div class="row">
            @if(!isset($nasabah[0]) )
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <h3>Tidak Ada Nasabah Baru</h3>
                        </div>
                    </div>
                </div>

                @endif
            @if(isset($nasabah[0]))
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 text-left">
                                <p class="text-muted">Nasabah saat ini</p>
                            </div>
                            <div class="col-6 text-right">
                                <p class="text-muted">Sesi {{$nasabah[0]->sesi}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-left">
                                <h3 >{{$nasabah[0]->name}}</h3>
                            </div>
                            <div class="col-6 text-right">
                                <p >{{substr($nasabah[0]->jam_mulai,0,5).' - '.substr($nasabah[0]->jam_selesai,0,5)}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-left">
                                <p class="text-muted">{{$nasabah[0]->nama}}</p>
                            </div>
                            <div class="col-6 text-right">
                                <p class="text-muted"> Jangka Waktu</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-left">
                                <p class="text-muted">Rp {{number_format( $nasabah[0]->plafond , 0 , ',' , '.' )}}</p>
                            </div>
                            <div class="col-6 text-right">
                                <p> {{$nasabah[0]->masa_tenor}} Bulan</p>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer" style="background-color: white">
                        <div class="row">
                            <div class="col-4 btnProses" >
                                <button class="btn mr-2 orange-primary widthmax " onclick="setTimer({{$nasabah[0]->transaksi_id}})">Proses</button>
                                <input type="hidden" value="{{$nasabah[0]->status_mulai}}" id="status_mulai">
                                @if(isset($nasabah[0]->durasi))
                                <input type="hidden" value="{{$nasabah[0]->durasi}}" id="durasi">
                                @endif
                            </div>
                            <div class="col-4">
                                <button class="btn orange-outline mr-2 widthmax" data-toggle="modal" data-target="#detailPengajuanModal" data-transaksi_id="{{$nasabah[0]->transaksi_id}}" >Detail Pengajuan</button>
                            </div>
                            <div class="col-4">
                                <button class="btn orange-outline mr-2 widthmax" data-toggle="modal" data-target="#cetakBlangkoModal" data-transaksi_id="{{$nasabah[0]->transaksi_id}}"><i class="fa fa-print icon"> </i> Cetak Blangko</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            @endif
            @if(isset($nasabah[1]))
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 text-left">
                                <p class="text-muted">Nasabah berikutnya</p>
                            </div>
                            <div class="col-6 text-right">
                                <p class="text-muted">Sesi {{$nasabah[1]->sesi}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-left">
                                <h3 class="text-muted">{{$nasabah[1]->name}}</h3>
                            </div>
                            <div class="col-6 text-right">
                                <p class="text-muted">{{substr($nasabah[1]->jam_mulai,0,5).' - '.substr($nasabah[1]->jam_selesai,0,5)}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-left">
                                <p class="text-muted">{{$nasabah[1]->nama}}</p>
                            </div>
                            <div class="col-6 text-right">
                                <p class="text-muted">Jangka waktu</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-left">
                                <p class="text-muted">Rp {{number_format( $nasabah[1]->plafond , 0 , ',' , '.' )}}</p>
                            </div>
                            <div class="col-6 text-right">
                                <p class="text-muted">{{$nasabah[1]->masa_tenor}} Bulan</p>
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
                @endif
        </div>
        <div class="row cardTimer">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 text-center">
                                <h3 class="text-muted mt-4 mb-5">Waktu Pelayanan</h3>
                                <p id="time" style="font-size: 90pt">{{$durasi}} : 00</p>
                                <p style="font-size: 20pt">Menit  Detik</p>
                                <form action="{{route('customer_service.selesai_pelayanan')}}" method="post">
                                    @csrf
                                    @if(isset($nasabah[0]))
                                <input type="hidden" value="{{$nasabah[0]->transaksi_id}}" name="transaksi_id" id="transaksi_id">
                                    @endif
                                <button onClick='return confirmSubmit()' class="btn orange-primary mt-3" style="width: 30%">Selesai</button>
                                </form>
                            </div>
                            <div class="col-6">
                                <img src="{{asset('images/cs-timer.png')}}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




@section('modal')
    @include('user.daftar_pengajuan.modal.detail_pengajuan')
    @include('customer_service.modal.cetak_blangko')
@endsection


@section('script')
    <script src="{{asset('js/detail_pengajuan.js')}}"></script>
    <script src="{{asset('js/tab-bar.js')}}"></script>
    <script type="text/javascript">





        function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                if (timer < 0){
                    minutes = minutes < 10 ?  minutes :  minutes;
                    seconds = seconds < 10 ?   seconds : "0" + seconds;
                }else{
                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;
                }





                if (--timer < 0) {
                    display.textContent = minutes + " : " + seconds;

                }else{
                    display.textContent = minutes + " : " + seconds;
                }
            }, 1000);
        }

        window.onload = function () {

            var status = $('#status_mulai').val();
            var durasi_sekarang = $('#durasi').val();
            if (status == true){
                $('.cardTimer').show();
                $('.btnProses').remove();
                var minutes = 60 * durasi_sekarang,
                    display = document.querySelector('#time');
                startTimer(minutes, display);
            }else{
                $('.cardTimer').hide();
            }



            //handle template blangko
            var id = $('#transaksi_id').val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                url: "{{route('customer_service.get_jenis_dokumen')}}",
                dataType: "JSON",
                data : {id : id},
                success: function (response) {
                    var link = "/"+response
                    $('.template_blangko_pdf').attr('src',link);
                    $('.blangko_nasabah_pdf').attr('src',link);

                }
            });







        };


        function generateDocument(){

            console.log('test');
            var id = $('#transaksi_id').val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                url: "  {{route('user.download_blangko')}}",
                dataType: "JSON",
                data : {transaksi_id : id},
                success: function (response) {
                }
            });

        }



      function setTimer (id) {
          $('.cardTimer').show();
          $('.btnProses').remove();
          var minutes = 60 * {{$durasi}},
              display = document.querySelector('#time');
          startTimer(minutes, display);
          mulaiPelayanan(id);


      }

      function mulaiPelayanan(id){
          $.ajax({
              type: "POST",
              headers: {
                  'X-CSRF-Token': "{{csrf_token()}}"
              },
              url: "{{route('customer_service.mulai_pelayanan')}}",
              dataType: "JSON",
              data : {id : id},
              success: function (response) {
                  if (response == true){
                      toastr.success('Berhasil Memulai Pelayanan');
                  }else{
                      toastr.error('Gagal Memulai Pelayanan');
                  }
              }
          });

      }


        function confirmSubmit(){
            var agree=confirm("Apakah anda yakin ingin menyelesaikan pelayanan?");
            if (agree) {
                return true ;
            }else {
                return false;
            }

        }









    </script>

    @endsection
