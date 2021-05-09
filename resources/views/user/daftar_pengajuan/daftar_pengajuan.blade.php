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
                                <p style="font-weight: lighter">Menuju waktu pencairan dana</p>
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


        $('#detailPengajuanModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('transaksi_id');

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                url: "{{route('user.get_detail_transaksi')}}",
                dataType: "JSON",
                data : {id : id},
                success: function (response) {


                    //header
                    $('#jadwal_detail').val(response['tanggal']);
                    $('#slot_detail').val(response['slot_waktu']);
                    $('#cabang_detail').val(response['nama_cabang']);
                    $('#customer_service_detail').val(response['nama_cs']);

                    //formulir pengajuan
                    $('#produk_kredit_detail').val(response['nama_produk']);
                    $('#penghasilan_per_bulan_detail').val(response['penghasilan']);
                    $('#jangka_waktu_kredit_detail').val(response['masa_tenor']);
                    $('#suku_bunga_detail').val(response['suku_bunga']);
                    $('#max_plafond_detail').val(response['max_plafond']);
                    $('#nominal_pengajuan_kredit_detail').val(response['plafond']);
                    $('#jumlah_angsuran_per_bulan_detail').val(response['jumlah_angsuran']);
                    $('#keperluan_pinjaman_detail').val(response['keperluan_pinjaman']);


                    //biodata
                    $('#nama_panggilan_detail').val(JSON.parse(response['biodata']).nama_panggilan);
                    $('#masa_berlaku_ktp_detail').val(JSON.parse(response['biodata']).masa_berlaku_ktp);
                    $('#nama_ibu_kandung_detail').val(JSON.parse(response['biodata']).nama_ibu_kandung);
                    $('#status_perkawinan_detail').val(JSON.parse(response['biodata']).status_perkawinan);
                    $('#agama_detail').val(JSON.parse(response['biodata']).agama);
                    $('#nama_pasangan_detail').val(JSON.parse(response['biodata']).nama_pasangan);
                    $('#no_ktp_pasangan_detail').val(JSON.parse(response['biodata']).no_ktp_pasangan);
                    $('#pekerjaan_pasangan_detail').val(JSON.parse(response['biodata']).pekerjaan_pasangan);
                    $('#alamat_nohp_pasangan_detail').val(JSON.parse(response['biodata']).alamat_nohp_pasangan);
                    $('#hubungan_pasangan_detail').val(JSON.parse(response['biodata']).hubungan);
                    $('#pendidikan_detail').val(JSON.parse(response['biodata']).pendidikan);
                    $('#keterangan_gelar_detail').val(JSON.parse(response['biodata']).keterangan_gelar);
                    $('#kewarganegaraan_detail').val(JSON.parse(response['biodata']).kewarganegaraan);
                    $('#jumlah_anak_detail').val(JSON.parse(response['biodata']).jumlah_anak);
                    $('#no_telp_rumah_detail').val(JSON.parse(response['biodata']).no_telp_rumah);
                    $('#status_kepemilikan_rumah_detail').val(JSON.parse(response['biodata']).status_kepemilikan_rumah);
                    $('#jabatan_detail').val(JSON.parse(response['biodata']).jabatan);
                    $('#pangkat_detail').val(JSON.parse(response['biodata']).pangkat);
                    $('#kantor_detail').val(JSON.parse(response['biodata']).kantor);
                    $('#nip_detail').val(JSON.parse(response['biodata']).NIP);
                    $('#no_telp_kantor_detail').val(JSON.parse(response['biodata']).no_telp_kantor);
                    $('#no_fax_kantor_detail').val(JSON.parse(response['biodata']).no_fax_kantor);
                    $('#email_kantor_detail').val(JSON.parse(response['biodata']).email_kantor);
                    $('#lama_bekerja_detail').val(JSON.parse(response['biodata']).lama_bekerja);
                    $('#alamat_kantor_detail').val(JSON.parse(response['biodata']).alamat_kantor);
                    $('#provinsi_detail').val(response['provinsi']);
                    $('#kabkot_detail').val(response['kabkot']);
                    $('#kecamatan_detail').val(response['kecamatan']);
                    $('#kelurahan_detail').val(response['kelurahan']);
                    $('#kode_pos_detail').val(response['kode_pos']);


                    //dokumen
                    setImageDokumenSaya(response, "kartu_keluarga");
                    setImageDokumenSaya(response, "ktp_pasangan");
                    setImageDokumenSaya(response, "pas_foto_pasangan");
                    setImageDokumenSaya(response, "buku_tabungan");
                    setImageDokumenSaya(response, "buku_nikah");
                    setImageDokumenSaya(response, "jaminan_shm");
                    setImageDokumenSaya(response, "dokumen_spt");

                    setImageDokumenKredit(response, "gaji_terakhir")
                    setImageDokumenKredit(response, "struk_gaji_bulan_terakhir")
                    setImageDokumenKredit(response, "SK_CAPEG")
                    setImageDokumenKredit(response, "SK_pegawai_tetap")
                    setImageDokumenKredit(response, "SK_pangkat_terakhir")
                    setImageDokumenKredit(response, "SK_berkala_terakhir")
                    setImageDokumenKredit(response, "kartu_pegawai")
                    setImageDokumenKredit(response, "kartu_taspen")

                    $('#nomor_sk_capeg_detail').val(JSON.parse(response['path_file']).no_SK_CAPEG);
                    $('#nomor_sk_pegawai_tetap_detail').val(JSON.parse(response['path_file']).no_SK_pegawai_tetap);
                    $('#nomor_sk_pangkat_terakhir_detail').val(JSON.parse(response['path_file']).no_SK_pangkat_terakhir);
                    $('#nomor_sk_berkala_terakhir_detail').val(JSON.parse(response['path_file']).no_SK_berkala_terakhir);
                    $('#nomor_shm_detail').val(JSON.parse(response['path_file_dokumen_saya']).no_shm_bpkb);


                }
            });

        });

        function setImageDokumenSaya(response, nama){
            $('#'+nama+'_detail').val(response[nama]);
            if(response[nama] != "Tidak Ada File yang Diunggah"){
                $('#'+nama+'_image').attr("href", "/"+JSON.parse(response['path_file_dokumen_saya'])[nama]);
                $('#'+nama+'_image').show();
            }else{
                $('#'+nama+'_image').hide();
            }
        }

        function setImageDokumenKredit(response, nama){
            $('#'+nama+'_detail').val(response[nama]);
            if(response[nama] != "Tidak Ada File yang Diunggah"){
                $('#'+nama+'_image').attr("href", "/"+JSON.parse(response['path_file'])[nama]);
                $('#'+nama+'_image').show();
            }else{
                $('#'+nama+'_image').hide();
            }
        }


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


    {{--    handle tahap akhir--}}
    <script type="text/javascript">

        $('#biodata_diri_tab').on('click', function(){
            $('#biodata_diri_link').addClass('tab-bar-konfirmasi-active')
            $('#biodata_diri_link').removeClass('tab-bar-konfirmasi-inactive');
            $('#formulir_pengajuan_link').removeClass('tab-bar-konfirmasi-active')
            $('#dokumen_link').removeClass('tab-bar-konfirmasi-active');
            $('#formulir_pengajuan_link').addClass('tab-bar-konfirmasi-inactive')
            $('#dokumen_link').addClass('tab-bar-konfirmasi-inactive');
        });

        $('#formulir_pengajuan_tab').on('click', function(){
            $('#biodata_diri_link').addClass('tab-bar-konfirmasi-inactive')
            $('#biodata_diri_link').removeClass('tab-bar-konfirmasi-active');
            $('#formulir_pengajuan_link').removeClass('tab-bar-konfirmasi-inactive')
            $('#dokumen_link').removeClass('tab-bar-konfirmasi-active');
            $('#formulir_pengajuan_link').addClass('tab-bar-konfirmasi-active')
            $('#dokumen_link').addClass('tab-bar-konfirmasi-inactive');
        });


        $('#dokumen_tab').on('click', function(){
            $('#biodata_diri_link').addClass('tab-bar-konfirmasi-inactive')
            $('#biodata_diri_link').removeClass('tab-bar-konfirmasi-active');
            $('#formulir_pengajuan_link').removeClass('tab-bar-konfirmasi-active')
            $('#dokumen_link').removeClass('tab-bar-konfirmasi-inactive');
            $('#formulir_pengajuan_link').addClass('tab-bar-konfirmasi-inactive')
            $('#dokumen_link').addClass('tab-bar-konfirmasi-active');
        });


    </script>






@endsection
