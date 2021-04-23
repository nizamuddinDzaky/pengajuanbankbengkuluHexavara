@extends('layouts.user')

@section('title', 'Daftar Pengajuan')


@section('style')
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

    </style>

    @endsection

@section('content')

    <div class="container">
        <div class="row">
            <h3 class="mt-3 title">Daftar Pengajuan</h3>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card" style="width: 100%; border-radius: 10px">
                    <div class="card-header" style="display: inline; background-color: white">
                        <div class="row">
                            <div class="col-md-6 py-2 px-2">
                                <h5>Kredit Multiguna Aktif</h5>
                            </div>
                            <div class="col-md-6 py-2 px-2">
                                <button
                                    style="float: right"
                                    class="btn btn-light"
                                    data-toggle="popover"
                                    data-content="<a href='xyz.com'>Detail Pengajuan</a><br><a href='xyz.com'>Jadwalkan Ulang</a><br><a href='xyz.com'>Batalkan Pengajuan</a>"
                                    data-html="true">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <h5 style="float: right" class="float-left-mobile mr-3">#001.100298.98</h5>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <p style="font-size: 24px">Rana Wijdan Naim</p>
                                <p style="font-size: 18px" class="text-muted">35110231234908671</p>
                                <p style="font-size: 18px" class="text-muted">Pegawai Negeri Sipil</p>
                            </div>
                            <div class="col-md-4 text-center text-left-mobile">
                                <label class="text-muted">Jumlah Plafond</label>
                                <h4 >Rp 70.000.000</h4>
                                <label class="text-muted ">Angsuran Per Bulan</label>
                                <h4 >Rp 2.142.246</h4>
                            </div>
                            <div class="col-md-4 text-right text-left-mobile">
                                <label class="text-muted">Jadwal Pencairan</label><br>
                                <h4>1 April 2021</h4>
                                <label class="text-muted">Jangka Waktu</label>
                                <h4 >36 Bulan</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="background-color: white">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <p style="color: #E46931">1 Hari 2 Jam 54 Menit</p>
                                <p>Menuju waktu pencairan dana</p>
                            </div>
                            <div class="col-md-6 text-right button-row">
                                <button class="btn btn-outline-secondary mr-2 mt-3 button-block">Unggah Blangko</button>
                                <button class="btn btn-outline-secondary mr-2 mt-3 button-block">Unduh Blangko</button>
                            </div>
                        </div>

{{--                        <button class="btn btn-danger mr-2 button-block">Batalkan Pengajuan</button>--}}
{{--                        <button class="btn btn-success mr-2 button-block">Jadwalkan Ulang</button>--}}
{{--                        <button class="btn btn-primary button-block" >Detail Pengajuan</button>--}}
                    </div>
                </div>
            </div>

        </div>
    </div>






    @endsection

@section('script')

    <script type="text/javascript">
        $(function () {
            $('[data-toggle="popover"]').popover({
                trigger: 'focus'
            })
        })
    </script>



    @endsection
