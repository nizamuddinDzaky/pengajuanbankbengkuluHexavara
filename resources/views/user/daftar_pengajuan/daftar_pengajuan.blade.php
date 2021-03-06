@extends('layouts.user')

@section('title', 'Daftar Pengajuan')


@section('style')
    <link href="{{asset('css/tab_bar_modal.css')}}" rel="stylesheet" type="text/css" />
    <style>

        @media only screen and (max-width: 640px) and (min-width: 0px) {
            .float-left-mobile {
                float : left!important
            }

            .text-left-mobile {
                text-align: left!important;
            }

            .button-row{
                text-align: initial;
            }

            .button-block {
                display: block;
                width: 100%;
                margin-bottom: 3%;
            }

            .title {
             margin-left: 5%;
            }


        }

        .orange-outline{
            border-color:#E46931;
            color: #E46931;
        }

        .orange-primary {
            background-color: #E46931;
            color: white;
        }

        .popover-option {
            color: black;
            text-decoration: none;
            font-size: 15pt;
        }

        .popover-option:hover {
            color: #E46931;
        }

    </style>

    @endsection

@section('content')

    <div class="container">
        <div class="row">
            <h3 class="mt-3 title">Daftar Pengajuan</h3>
        </div>
        <div class="row mt-4">
            @foreach($transaksi as $data)
            <div class="col-12 mt-3">
                <div class="card" style="width: 100%; border-radius: 10px">
                    <div class="card-header" style="display: inline; background-color: white">
                        <div class="row">
                            <div class="col-md-6 py-2 px-2">
                                <h5>{{$data->nama}}</h5>
                            </div>
                            <div class="col-md-6 py-2 px-2">
                                <button
                                   class="btn float-right popOver"
                                   data-html="true"
                                   data-id = "{{$data->id_transaksi}}"
                                   data-toggle="popover"
                                   data-content="  <a href='#detailPengajuanModal' class='popover-option' id='detailPengajuan' >Detail Pengajuan</a><br>
                                  <a role='button' id='jadwalkanUlang' class='popover-option' href='#jadwalkanUlangModal' data-transaksi_id='{{$data->id_transaksi}}' >Jadwalkan Ulang</a><br>
                                    <a id='batalkanPengajuan' class='popover-option' href='#batalkanPengajuanModal' >Batalkan Pengajuan</a>"
                                   ><i class="fa fa-ellipsis-v"></i>
                                </button>
                                <h5 style="float: right" class="float-left-mobile mr-3">#{{$data->kode_pengajuan}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <p style="font-size: 24px; margin-bottom: 3px">{{$data->name}}</p>
                                <p style="font-size: 18px; margin-bottom: 3px" class="text-muted">{{$data->no_ktp}}</p>
                                <p style="font-size: 18px" class="text-muted">{{$data->pekerjaan}}</p>
                            </div>
                            <div class="col-md-4 text-center text-left-mobile">
                                <label class="text-muted">Jumlah Plafond</label>
                                <h4 >Rp {{number_format($data->plafond) }}</h4>
                                <label class="text-muted ">Angsuran Per Bulan</label>
                                <h4 >Rp {{number_format($data->jumlah_angsuran)}}</h4>
                            </div>
                            <div class="col-md-4 text-right text-left-mobile">
                                <label class="text-muted">Jadwal Verifikasi Data Fisik</label><br>
                                <h4>{{\Carbon\Carbon::createFromFormat('Y-m-d',$data->tanggal)->locale('id')->isoFormat('LL')}}</h4>
                                <label class="text-muted">Jangka Waktu</label>
                                <h4 >{{$data->masa_tenor}} Bulan</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="background-color: white">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <p style="color: #E46931; margin-bottom: 0">{{$data->countdown}}</p>
                                <p style="font-weight: lighter">Menuju waktu verifikasi data fisik</p>
                            </div>
                            <div class="col-md-6 text-right button-row">
                                <button class="btn orange-outline mr-2 mt-3 button-block" data-toggle="modal" data-target="#unggahBlangkoModal" data-transaksi_id="{{$data->id_transaksi}}">Unggah Blangko</button>
                                <button class="btn orange-outline mr-2 mt-3 button-block" data-toggle="modal" data-target="#unduhBlangkoModal" data-transaksi_id="{{$data->id_transaksi}}">Unduh Blangko</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
        <div class="row mt-3">
            <div class="col-12 offset-5">
                {{$transaksi->links()}}
            </div>
        </div>
    </div>




    @endsection

@section('modal')
    @include('user.daftar_pengajuan.modal.jadwalkan_ulang')
    @include('user.daftar_pengajuan.modal.batalkan_pengajuan')
    @include('user.daftar_pengajuan.modal.unduh_blangko')
    @include('user.daftar_pengajuan.modal.unggah_blangko')
    @include('user.daftar_pengajuan.modal.detail_pengajuan')
@endsection

@section('script')
    <script src="{{asset('js/daftar_pengajuan/jadwalkan_ulang.js')}}"></script>
    <script src="{{asset('js/detail_pengajuan.js')}}"></script>
    <script src="{{asset('js/tab-bar.js')}}"></script>

    <script type="text/javascript">

        $("[data-toggle='popover']").popover({
            trigger: "click"
        }).click(function (event) {
            event.stopPropagation();
        });

        $(document).click(function () {
            $("[data-toggle='popover']").popover('hide')
        });





        $('.popOver').on('shown.bs.popover', function (event) {
            var popover = $(event.target).data('id');

            $('#jadwalkanUlang').attr('data-toggle', 'modal');
            $('#jadwalkanUlang').attr('data-target', '#jadwalkanUlangModal');
            $('#jadwalkanUlang').attr('data-transaksi_id', popover);


            $('#batalkanPengajuan').attr('data-toggle', 'modal');
            $('#batalkanPengajuan').attr('data-target', '#batalkanPengajuanModal');
            $('#batalkanPengajuan').attr('data-transaksi_id', popover);


            $('#detailPengajuan').attr('data-toggle', 'modal');
            $('#detailPengajuan').attr('data-target', '#detailPengajuanModal');
            $('#detailPengajuan').attr('data-transaksi_id', popover);



        })

    </script>

    <script type="text/javascript">

        @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
        @elseif(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
        @endif

    </script>

    <script>



        $('#jadwalkanUlangModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('transaksi_id');

            $('#transaksi_id').val(id);

        });

        $('#batalkanPengajuanModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('transaksi_id');

            $('#transaksi_id_batal').val(id);

        });

        $('#unduhBlangkoModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('transaksi_id');

            $('#transaksi_id_unduh').val(id);

        });

        $('#unggahBlangkoModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('transaksi_id');

            var myDropzone = Dropzone.forElement("#unggahDokumen");
            myDropzone.removeAllFiles();
            $(".dz-message").removeClass("hidden");

            $('#transaksi_id_unggah').val(id);
            $('#keteranganUnggah').empty();

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                url: "{{route('user.get_blangko_status')}}",
                dataType: "JSON",
                data : {id : id},
                success: function (response) {
                   if (response[0] == true){
                       var content =  '<div class="alert alert-success" role="alert">'+
                          ' File sudah terunggah       <a href="'+response[1]+'" target="_blank">Lihat</a></div>'
                       $('#keteranganUnggah').append(content);
                   }else{
                       var content  =  '<div class="alert alert-secondary" role="alert">'+
                           ' File belum diunggah</div>'
                       $('#keteranganUnggah').append(content);
                   }
                }
            });






        });


        Dropzone.options.unggahDokumen = {
            autoProcessQueue: true,
            url: '/user/blangko/unggah_blangko',
            addRemoveLinks: true,
            uploadMultiple: false,
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            autoDiscover : false,
            maxFilesize: 5,
            acceptedFiles: '.pdf',
            maxFiles: 1,
            parallelUploads : 3,
            init: function () {

                this.on("processing", function(file) {
                    var transaksi_id = $('#transaksi_id_unggah').val();
                    this.options.url = "/user/blangko/unggah_blangko/"+transaksi_id;
                });

                this.on('sending', function(file, xhr, formData) {
                    // Append all form inputs to the formData Dropzone will POST
                    var data = $('#frmTarget').serializeArray();
                    $.each(data, function(key, el) {
                        formData.append(el.name, el.value);
                    });
                });


                this.on("success", function() {
                    toastr.success('Berhasil Upload File')
                    var content =  '<div class="alert alert-success" role="alert">'+
                        ' File sudah terunggah</div>'

                    $('#keteranganUnggah').empty();
                    $('#keteranganUnggah').append(content);
                });


            }
        }








    </script>






@endsection
