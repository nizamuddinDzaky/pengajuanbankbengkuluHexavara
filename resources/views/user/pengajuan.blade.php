@extends('layouts.user')

@section('title', 'Pengajuan Kredit')

@section('style')

    <link href="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/tab_bar_modal.css')}}" rel="stylesheet" type="text/css" />
    <style>
        body {
            background-color: #EEEFF3;
        }

        input.error {
            border: 1px dashed red;
            font-weight: 300;
            color: red;
        }

        label.error {
            color: red;
            font-size: 1rem;
            display: block;
            margin-top: 5px;
        }

        .dropzone .dz-message {
            margin: 3em!important;
        }

        .red {
            color: red;
        }

        .sw-theme-dots>.nav::before {
            background-color: grey;!important
        }

        .sw-theme-dots .toolbar>.btn {
            background-color: #e46931!important;
            border : none!important;
        }

        .dz-image img{
            width: 130px;
            height:130px;
        }





        @media only screen and (max-width: 640px) and (min-width: 0px) {

            .sw>.nav {
                flex-direction: inherit!important;
            }

        }

    </style>
    @endsection



@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <h2>Pengajuan Kredit</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-2">

                <div id="smartwizard">

                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#formulir-pengajuan">
                                Formulir Pengajuan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#biodata-diri">
                                Biodata Diri
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#dokumen-saya">
                                Dokumen Saya
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#dokumen-kredit">
                                Dokumen Kredit
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tahap-terakhir">
                                Tahap Terakhir
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div id="formulir-pengajuan" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                            <form action="" method="post" id="formPengajuan">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Produk Kredit</label>
                                        <select class="form-control" name="produk_kredit" id="produk_kredit" required>
                                            <option selected disabled>-Pilih Produk Kredit-</option>
                                            @foreach($produk as $data)
                                                @if($transaksi->produk_id == $data->id)
                                                    <option value="{{$data->id}}" selected>{{$data->nama}}</option>
                                                    @else
                                                    <option value="{{$data->id}}">{{$data->nama}}</option>
                                                    @endif

                                                @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Penghasilan per Bulan</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                            </div>
                                            <input type="text" class="form-control currency"  value="{{$transaksi->penghasilan}}" id="penghasilan_per_bulan" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nama">Jangka Waktu Kredit</label>
                                        <div class="input-group mb-3">
                                            <input type="number" value="{{$transaksi->masa_tenor}}" class="form-control"  name="jangka_waktu_kredit" id="jangka_waktu_kredit"  required>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Bulan</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nama">Suku Bunga per Tahun</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="suku_bunga" value="{{$transaksi->suku_bunga}}" disabled>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Maksimal Plafond yang Dapat Diambil</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                            </div>
                                            <input type="text" class="form-control currency" value="{{$transaksi->max_plafond}}"  id="max_plafond"  readonly>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nominal Pengajuan Kredit</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                            </div>
                                            <input type="text" class="form-control currency"  id="nominal_pengajuan_kredit" value="{{$transaksi->plafond}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Jumlah Angsuran per Bulan</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                            </div>
                                            <input type="text" class="form-control currency" value="{{$transaksi->jumlah_angsuran}}"  id="jumlah_angsuran_per_bulan" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Keperluan Pinjaman</label>
                                            <input type="text" required class="form-control" name="keperluan_pinjaman"  id="keperluan_pinjaman" value="{{$transaksi->keperluan_pinjaman}}" >
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>



                        <div id="biodata-diri" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                @include('user.pengajuan.biodata.multiguna')
                                @include('user.pengajuan.biodata.kredit_guna_usaha')
                        </div>


                        <div id="dokumen-saya" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                            @include('user.pengajuan.dokumen_saya')
                        </div>






                        <div id="dokumen-kredit" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                            @include('user.pengajuan.dokumen_kredit.multiguna_aktif')
                            @include('user.pengajuan.dokumen_kredit.multiguna_aktif_pensiun')
                            @include('user.pengajuan.dokumen_kredit.multiguna_pensiun')
                            @include('user.pengajuan.dokumen_kredit.multiguna_anggota_dprd')
                            @include('user.pengajuan.dokumen_kredit.multiguna_nonpns_kpu')
                            @include('user.pengajuan.dokumen_kredit.multiguna_perangkat_desa')
                            @include('user.pengajuan.dokumen_kredit.kredit_guna_usaha')
                        </div>


                        <div id="tahap-terakhir" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                            <form action="" id="formTahapAkhir">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Cabang atau Capem</label>
                                        <select name="cabang" class="form-control" id="cabang" required>
                                            <option selected disabled>-Pilih Cabang atau Capem Terdekat-</option>
                                            @foreach($cabang as $data)
                                                @if($transaksi->kantor_id == $data->id)
                                                    <option selected value="{{$data->id}}">{{$data->nama_kantor}}</option>
                                                @else
                                                    <option value="{{$data->id}}">{{$data->nama_kantor}}</option>
                                                    @endif
                                                @endforeach
                                        </select>
                                        <input type="hidden" value="{{$transaksi->kantor_id}}" id="checkerCabang">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Customer Service</label>
                                        <select name="customer_service" class="form-control" id="customer_service" required>
                                            <option selected disabled>-Pilih CS yang Tersedia di Cabang atau Capem Terdekat-</option>
                                        </select>
                                        <input type="hidden" value="{{$transaksi->cs_id}}" id="checkerCS">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Jadwal Verifikasi Data Fisik</label>
                                        @if($transaksi->tanggal != null)
                                            <input type="date" min="{{\Carbon\Carbon::now()->toDateString()}}" value="{{$transaksi->tanggal}}" class="form-control" name="tanggalVerifikasi" id="tanggalVerifikasi" required >
                                        @else
                                            <input type="date" min="{{\Carbon\Carbon::now()->toDateString()}}" value="{{$dateVerifikasi}}" class="form-control" name="tanggalVerifikasi" id="tanggalVerifikasi" required >
                                            @endif
                                        <input type="hidden" value="{{$transaksi->tanggal}}" id="checkerTanggal">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Slot Waktu Verifikasi Data Fisik</label>
                                        <select name="slotWaktu" class="form-control" id="slotWaktu" required>
                                            <option selected disabled>-Pilih Slot Waktu yang Tersedia-</option>
                                        </select>
                                        <input type="hidden" value="{{$transaksi->jam_mulai}}" id="checkerMulai">
                                        <input type="hidden" value="{{$transaksi->jam_selesai}}" id="checkerSelesai">
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>


</div>





    @endsection


@section('modal')
    @include('user.modal.konfirmasi_pengajuan')
@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="{{asset('js/validation/messages_id.min.js')}}"></script>
    <script src="{{asset('js/smart-wizard.js')}}"></script>
    <script src="{{asset('js/upload_pengajuan_file/upload_dokumen_saya.js')}}"></script>
    <script src="{{asset('js/upload_pengajuan_file/upload_dokumen_kredit.js')}}"></script>
    <script src="{{asset('js/pengajuan/tahap_akhir.js')}}"></script>

{{--   handle toastr --}}
    <script type="text/javascript">

        @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
        @elseif(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
        @endif

    </script>


{{--    handle validation and insert tab data--}}
<script type="text/javascript">
    //for validation dokumen saya
    var status = "";
    var statusJaminan = "";

    $("#smartwizard").on("leaveStep", function (e, anchorObject, stepNumber, stepDirection) {

        if (stepDirection > stepNumber){

            if (stepNumber == 0){
                if ($('#formPengajuan').valid()) {
                    insertFormulirPengajuan();
                } else {
                    return false;
                }
            }


            if(stepNumber == 1){
                var tipe = "";
                if ($('#formBiodataDiri').valid()) {
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-Token': "{{csrf_token()}}"
                        },
                        url: "{{route('user.getjenisproduk')}}",
                        dataType: "JSON",
                        success: function (response) {
                            tipe = response;
                            insertBiodataDiri(tipe);
                        }
                    });

                    return true;
                } else {
                    return false;
                }

            }


            if (stepNumber == 2){


                $("#wajibValidation").validate({
                    ignore: "",
                    errorPlacement: function (error, element) {
                        return true;
                    }
                });

                if ($('#wajibValidation').valid()) {

                    if (status == "Kawin") {

                        $("#kawinValidation").validate({
                            ignore: "",
                            errorPlacement: function (error, element) {
                                return true;
                            }
                        });


                        if ($('#kawinValidation').valid()) {


                            if (statusJaminan == true) {

                                $("#jaminanValidation").validate({
                                    ignore: "",
                                    errorPlacement: function (error, element) {
                                        return true;
                                    }
                                });

                                if ($('#jaminanValidation').valid()) {

                                    var noSHM = $('#no_shm_bpkb').val();

                                    if(noSHM === ""){
                                        toastr.error("Isi nomor SHM / BPKB");
                                        return false;

                                    }else {
                                        $.ajax({
                                            type: "POST",
                                            headers: {
                                                'X-CSRF-Token': "{{csrf_token()}}"
                                            },
                                            url: "{{url('user/pengajuan/insertnoshm')}}",
                                            dataType: "JSON",
                                            data: {data: noSHM},
                                            success: function (response) {

                                            }
                                        });
                                    }

                                        return true;

                                }else {
                                    console.log('masuk sini');
                                    toastr.error("Upload Semua File yang Bertanda Bintang Merah");
                                    return false;
                                }


                            }else {
                                return true;
                            }

                        }else {
                            toastr.error("Upload Semua File yang Bertanda Bintang Merah");
                            return false;
                        }

                    }else {

                        if (statusJaminan == true) {

                            $("#jaminanValidation").validate({
                                ignore: "",
                                errorPlacement: function (error, element) {
                                    return true;
                                }
                            });

                            if ($('#jaminanValidation').valid()) {

                                var noSHM = $('#no_shm_bpkb').val();

                                if(noSHM === ""){
                                    toastr.error("Isi nomor SHM / BPKB");
                                    return false;


                                }else {
                                    $.ajax({
                                        type: "POST",
                                        headers: {
                                            'X-CSRF-Token': "{{csrf_token()}}"
                                        },
                                        url: "{{url('user/pengajuan/insertnoshm')}}",
                                        dataType: "JSON",
                                        data: {data: noSHM},
                                        success: function (response) {

                                            if (response === "success"){
                                                return true;
                                            }else{
                                                return false;
                                            }

                                        }
                                    });
                                }

                                return true;

                            }else {
                                toastr.error("Upload Semua File yang Bertanda Bintang Merah");
                                return false;

                            }
                        }else {
                            return true;
                        }
                    }


                }else{
                    toastr.error("Upload Semua File yang Bertanda Bintang Merah");
                    return false;

                }



            }


            if (stepNumber == 3){

                var pekerjaan = $('#pekerjaan').val();


                if (pekerjaan === "CPNS"){

                    $("#dokumenMultigunaAktifCPNS").validate({
                        ignore: "",
                        errorPlacement: function (error, element) {
                            return true;
                        }
                    });

                    if ($('#dokumenMultigunaAktifCPNS').valid()) {


                        if ($('#nomorSKMultigunaAktif').valid()){
                            var no_SK_pangkat_terakhir = $('#no_SK_pangkat_terakhir').val();
                            var no_SK_berkala_terakhir = $('#no_SK_berkala_terakhir').val();
                            var no_SK_CAPEG = $('#no_SK_CAPEG').val();


                            $.ajax({
                                type: "POST",
                                headers: {
                                    'X-CSRF-Token': "{{csrf_token()}}"
                                },
                                url: "{{url('user/pengajuan/insertnoSK')}}",
                                dataType: "JSON",
                                data: {data: [no_SK_berkala_terakhir, no_SK_pangkat_terakhir, no_SK_CAPEG], tipe : ["no_SK_pangkat_terakhir", "no_SK_berkala_terakhir", "no_SK_CAPEG"]},
                                success: function (response) {

                                    if (response === "success"){
                                        return true;
                                    }else{
                                        return false;
                                    }

                                }
                            });





                        }else{
                            return false;
                        }


                        return true;
                    }else {
                        toastr.error("Upload Semua File yang Bertanda Bintang Merah");
                        return false;
                    }
                }else{

                    $("#dokumenMultigunaAktifPNS").validate({
                        ignore: "",
                        errorPlacement: function (error, element) {
                            return true;
                        }
                    });

                    if ($('#dokumenMultigunaAktifPNS').valid()) {


                        if ($('#nomorSKMultigunaAktif').valid()){
                            var no_SK_pangkat_terakhir = $('#no_SK_pangkat_terakhir').val();
                            var no_SK_berkala_terakhir = $('#no_SK_berkala_terakhir').val();
                            var no_SK_pegawai_tetap = $('#no_SK_pegawai_tetap').val();


                            $.ajax({
                                type: "POST",
                                headers: {
                                    'X-CSRF-Token': "{{csrf_token()}}"
                                },
                                url: "{{url('user/pengajuan/insertnoSK')}}",
                                dataType: "JSON",
                                data: {data: [no_SK_berkala_terakhir, no_SK_pangkat_terakhir, no_SK_pegawai_tetap], tipe : ["no_SK_pangkat_terakhir", "no_SK_berkala_terakhir", "no_SK_pegawai_tetap"]},
                                success: function (response) {

                                    if (response === "success"){
                                        return true;
                                    }else{
                                        return false;
                                    }

                                }
                            });





                        }else{
                            return false;
                        }

                        return true;

                    }else {
                        toastr.error("Upload Semua File yang Bertanda Bintang Merah");
                        return false;
                    }
                }

            }
        }



    });


    $("#smartwizard").on("showStep", function(e, anchorObject, stepIndex, stepDirection) {

        if(stepIndex == 1){
            $('.pengajuan_multiguna').hide();
            $('.pengajuan_kgu').hide();

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                url: "{{route('user.getjenisproduk')}}",
                dataType: "JSON",
                success: function (response) {
                    if (response == 'multiguna'){
                        $('.pengajuan_multiguna').show();
                    }else if(response == 'kredit_guna_usaha'){
                        $('.pengajuan_kgu').show();
                    }


                }
            });
        }

        if(stepIndex == 2){
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                url: "{{route('user.getstatuskawin')}}",
                dataType: "JSON",
                success: function (response) {
                    if (response == 'Kawin'){
                        $('.dokumenSayaKawin').show();
                        status = "Kawin";
                    }else{
                        $('.dokumenSayaKawin').hide();
                        status = response;
                    }

                }
            });

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                url: "{{route('user.getstatusjaminan')}}",
                dataType: "JSON",
                success: function (response) {
                    if (response == true){
                        $('.jaminanSHMBPKB').show();
                        statusJaminan = response;
                    }else{
                        $('.jaminanSHMBPKB').hide();
                        statusJaminan = response;
                    }

                }
            });

        }


        if(stepIndex == 3){

            $('.dokumenMultigunaAktif').hide();
            $('.dokumenMultigunaAktifPensiun').hide();
            $('.dokumenMultigunaPensiun').hide();
            $('.dokumenMultigunaAnggotaDPRD').hide();
            $('.dokumenMultigunaNonPNSKPU').hide();
            $('.dokumenMultigunaPerangkatDesa').hide();
            $('.dokumenKreditGunaUsaha').hide();

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                url: "{{route('user.getnamaproduk')}}",
                dataType: "JSON",
                success: function (response) {
                    if (response === "Multiguna Aktif"){
                        $('.dokumenMultigunaAktif').css('display','block');

                        var pekerjaan = $('#pekerjaan').val();
                        if (pekerjaan == "PNS"){
                            $('.cpns').hide();
                            $('.pns').show();
                        }else if(pekerjaan == "CPNS"){
                            $('.cpns').show();
                            $('.pns').hide();
                        }


                    }else if(response  === "Multiguna Aktif Pensiun"){
                        $('.dokumenMultigunaAktifPensiun').show();
                    }else if(response === "Multiguna Pensiun"){
                        $('.dokumenMultigunaPensiun').show();
                    }else if(response === "Multiguna Anggota DPRD"){
                        $('.dokumenMultigunaAnggotaDPRD').show();
                    }else if(response === "Multiguna Non PNS / Komisioner KPU"){
                        $('.dokumenMultigunaNonPNSKPU').show();
                    }else if(response == "Multiguna Perangkat Desa"){
                        $('.dokumenMultigunaPerangkatDesa').show();
                    }else if(response == "Kredit Guna Usaha"){
                        $('.dokumenKreditGunaUsaha').show();
                    }

                }
            });

        }

        if (stepIndex == 4){
            $('.sw-btn-next').html('Konfirmasi');
            $('.sw-btn-next').attr('onClick', 'insertTahapAkhir()');
            $('.sw-btn-next').removeClass('disabled');

            if ($('#checkerCabang').val() != ""){
                getCustomerService($('#cabang').val());
                getSlotWaktu($('#tanggalVerifikasi').val(), $('#customer_service').val());
            }

        }else{
            $('.sw-btn-next').html('Selanjutnya');
            $('.sw-btn-next').removeClass('disabled');
            $('.sw-btn-next').removeAttr('onClick');
        }
    });




    function insertFormulirPengajuan(){
        var produk_kredit = $('#produk_kredit').val();
        var penghasilan = $('#penghasilan_per_bulan').val();
        var jangka_waktu_kredit = $('#jangka_waktu_kredit').val();
        var keperluan_pinjaman = $('#keperluan_pinjaman').val();
        var suku_bunga = $('#suku_bunga').val();
        var max_plafond = $('#max_plafond').val();
        var jumlah_angsuran = $('#jumlah_angsuran_per_bulan').val();
        var nominal_pengajuan = $('#nominal_pengajuan_kredit').val();

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-Token': "{{csrf_token()}}"
            },
            url: "{{url('/user/pengajuan/insertformulir')}}",
            dataType: "JSON",
            data: {produk: produk_kredit, penghasilan : penghasilan, jangka_waktu_kredit : jangka_waktu_kredit, keperluan_pinjaman : keperluan_pinjaman , suku_bunga : suku_bunga, jumlah_angsuran : jumlah_angsuran, max_plafond : max_plafond, nominal_pengajuan : nominal_pengajuan},
            success: function (response) {
                if (response == "success"){
                    return true;
                }
                else{
                    return false;
                }


            }
        });
    }


    function insertBiodataDiri(tipe){

        if (tipe == 'multiguna'){
            //dari biodata
            var name = $('#name').val();
            var email = $('#email').val();
            var no_ktp = $('#no_ktp').val();
            var no_hp = $('#no_hp').val();
            var tempat_lahir = $('#tempat_lahir').val();
            var tanggal_lahir = $('#tanggal_lahir').val();
            var jenis_kelamin = $('#jenis_kelamin').val();
            var provinsi = $('#provinsi').val();
            var kabkot = $('#kabkot').val();
            var kecamatan = $('#kecamatan').val();
            var kelurahan = $('#kelurahan').val();
            var alamat = $('#alamat').val();
            var no_npwp = $('#no_npwp').val();
            var pekerjaan = $('#pekerjaan').val();
            if (pekerjaan  == "Lainnya"){
                pekerjaan = $('#pekerjaan_lainnya').val();
            }


            //wajib ada
            var nama_ibu_kandung = $('#nama_ibu_kandung').val();
            var status_perkawinan = $('#status_perkawinan').val();
            var agama = $('#agama').val();
            var pendidikan = $('#pendidikan').val();
            var kewarganegaraan = $('#kewarganegaraan').val();
            var no_telp_rumah = $('#no_telp_rumah').val();
            var status_kepemilikan_rumah = $('#status_kepemilikan_rumah').val();
            var kantor =  $('#kantor').val();
            var alamat_kantor =  $('#alamat_kantor').val();
            var no_telp_kantor = $('#no_telp_kantor').val();
            var lama_bekerja = $('#lama_bekerja').val();
            var jabatan = $('#jabatan').val();
            var pangkat = $('#pangkat').val();
            var NIP = $('#nip').val();



            //tidak wajib ada
            var nama_panggilan = $('#nama_panggilan').val();
            var masa_berlaku_ktp = $('#masa_berlaku_ktp').val();
            var keterangan_gelar = $('#keterangan_gelar').val();
            var jumlah_anak = $('#jumlah_anak').val();
            var no_fax_kantor = $('#no_fax_kantor').val();
            var email_kantor = $('#email_kantor').val();


            //tidak wajib hanya kalo kawin
            var nama_pasangan = $('#nama_pasangan').val();
            var no_ktp_pasangan = $('#no_ktp_pasangan').val();
            var pekerjaan_pasangan = $('#pekerjaan_pasangan').val();
            var alamat_nohp_pasangan = $('#alamat_nohp_pasangan').val();
            var hubungan = $('#hubungan_pasangan').val();


            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                url: "{{url('/user/pengajuan/insertbiodatadiri')}}",
                dataType: "JSON",
                data: {tipe : tipe, name : name, email : email, no_ktp : no_ktp, no_hp: no_hp, tempat_lahir : tempat_lahir, tanggal_lahir : tanggal_lahir, provinsi : provinsi, kabkot : kabkot , kecamatan : kecamatan, kelurahan : kelurahan, alamat : alamat, jenis_kelamin : jenis_kelamin , pekerjaan : pekerjaan , no_npwp : no_npwp, nama_ibu_kandung : nama_ibu_kandung, status_perkawinan : status_perkawinan, agama : agama, pendidikan : pendidikan, kewarganegaraan : kewarganegaraan, no_telp_rumah : no_telp_rumah, status_kepemilikan_rumah : status_kepemilikan_rumah, kantor: kantor, alamat_kantor : alamat_kantor, no_telp_kantor : no_telp_kantor, lama_bekerja : lama_bekerja, jabatan : jabatan, pangkat : pangkat, NIP : NIP, nama_panggilan : nama_panggilan, masa_berlaku_ktp : masa_berlaku_ktp, keterangan_gelar: keterangan_gelar, no_fax_kantor : no_fax_kantor, email_kantor : email_kantor, nama_pasangan : nama_pasangan, no_ktp_pasangan : no_ktp_pasangan, pekerjaan_pasangan : pekerjaan_pasangan, alamat_nohp_pasangan : alamat_nohp_pasangan, hubungan : hubungan, jumlah_anak : jumlah_anak},
                success: function (response) {
                    if (response == "success"){
                        return true;
                    }
                    else{
                        return false;
                    }


                }
            });



        }else if(tipe == 'kredit_guna_usaha'){
            var name = $('#name').val();
            var tempat_lahir = $('#tempat_lahir').val();
            var tanggal_lahir = $('#tanggal_lahir').val();
            var alamat = $('#alamat').val();
            var no_npwp = $('#no_npwp').val();


            //wajib ada
            var nama_ibu_kandung = $('#nama_ibu_kandung').val();
            var kewarganegaraan = $('#kewarganegaraan').val();
            var no_telp_rumah = $('#no_telp_rumah').val();
            var NIP = $('#nip').val();
            var status_usaha = $('#status_usaha').val();
            var nama_usaha = $('#nama_usaha').val();
            var jenis_usaha = $('#jenis_usaha').val();
            var alamat_usaha = $('#alamat_usaha').val();
            var instansi = $('#instansi').val();
            var alamat_instansi = $('#alamat_instansi').val();
            var pendapatan_per_bulan = $('#pendapatan_per_bulan').val();
            pendapatan_per_bulan = pendapatan_per_bulan.replaceAll('.', '');
            var keuntungan_per_bulan = $('#keuntungan_per_bulan').val();
            keuntungan_per_bulan = keuntungan_per_bulan.replaceAll('.', '');
            var biaya_sekolah = $('#biaya_sekolah').val();
            biaya_sekolah = biaya_sekolah.replaceAll('.', '');
            var biaya_konsumsi_keluarga = $('#biaya_konsumsi_keluarga').val();
            biaya_konsumsi_keluarga = biaya_konsumsi_keluarga.replaceAll('.', '');
            var listrik_air_telepon = $('#listrik_air_telepon').val();




            //tidak wajib hanya kalo kawin
            var nama_pasangan = $('#nama_pasangan').val();
            var no_ktp_pasangan = $('#no_ktp_pasangan').val();


            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                url: "{{url('/user/pengajuan/insertbiodatadiri')}}",
                dataType: "JSON",
                data: {tipe : tipe, name : name, email : email, no_ktp : no_ktp, no_hp: no_hp, tempat_lahir : tempat_lahir, tanggal_lahir : tanggal_lahir, provinsi : provinsi, kabkot : kabkot , kecamatan : kecamatan, kelurahan : kelurahan, alamat : alamat, jenis_kelamin : jenis_kelamin , pekerjaan : pekerjaan , no_npwp : no_npwp, nama_ibu_kandung : nama_ibu_kandung, status_perkawinan : status_perkawinan, agama : agama, pendidikan : pendidikan, kewarganegaraan : kewarganegaraan, no_telp_rumah : no_telp_rumah, status_kepemilikan_rumah : status_kepemilikan_rumah, kantor: kantor, alamat_kantor : alamat_kantor, no_telp_kantor : no_telp_kantor, lama_bekerja : lama_bekerja, jabatan : jabatan, pangkat : pangkat, NIP : NIP, nama_panggilan : nama_panggilan, masa_berlaku_ktp : masa_berlaku_ktp, keterangan_gelar: keterangan_gelar, no_fax_kantor : no_fax_kantor, email_kantor : email_kantor, nama_pasangan : nama_pasangan, no_ktp_pasangan : no_ktp_pasangan, pekerjaan_pasangan : pekerjaan_pasangan, alamat_nohp_pasangan : alamat_nohp_pasangan, hubungan : hubungan, jumlah_anak : jumlah_anak},
                success: function (response) {
                    if (response == "success"){
                        return true;
                    }
                    else{
                        return false;
                    }


                }
            });
        }





    }




</script>

{{-- handle formulir pengajuan--}}
    <script type="text/javascript">
            $('#produk_kredit').on('change', function () {
                var produk = $(this).val();
                var jangka_waktu = $('#jangka_waktu_kredit').val();
                var nominal = $('#nominal_pengajuan_kredit').val();
                nominal = nominal.replaceAll('.', '');

                updateSukuBunga(produk, jangka_waktu);

                var suku_bunga =  $('#suku_bunga').val();

                updateJumlahAngsuranPerBulan(nominal, jangka_waktu, suku_bunga);

        });


            $('#penghasilan_per_bulan').on('keyup', function () {
                var penghasilan = $(this).val();
                var jangka_waktu = $('#jangka_waktu_kredit').val();

                if (penghasilan != ""){
                   updatePlafond(penghasilan, jangka_waktu)
                }else{
                    $('#max_plafond').val("");
                }

            });

            $('#jangka_waktu_kredit').on('keyup', function () {
                var jangka_waktu = $(this).val();
                var produk = $('#produk_kredit').val();
                var nominal = $('#nominal_pengajuan_kredit').val();
                var penghasilan =  $('#penghasilan_per_bulan').val();
                penghasilan = penghasilan.replaceAll('.', '');
                nominal = nominal.replaceAll('.', '');

                if (jangka_waktu != ""){

                    updateSukuBunga(produk,jangka_waktu);

                    var suku_bunga =  $('#suku_bunga').val();

                    updateJumlahAngsuranPerBulan(nominal, jangka_waktu, suku_bunga);
                    updatePlafond(penghasilan , jangka_waktu);

                }else{
                    $('#suku_bunga').val("");
                    $('#jangka_waktu_kredit').val("");
                    $('#jumlah_angsuran_per_bulan').val("");
                }

            });

            $('#nominal_pengajuan_kredit').on('keyup', function () {
                var nominal = $(this).val();
                var jangka_waktu = $('#jangka_waktu_kredit').val();
                var suku_bunga =  $('#suku_bunga').val();
                var max_plafond =  $('#max_plafond').val();


                if (nominal != ""){
                    var nominal = nominal.replaceAll('.', '');
                    var max_plafond = max_plafond.replaceAll('.','');

                    if (parseInt(nominal) > parseInt(max_plafond) ){
                        $(this).val(max_plafond);
                        $(this).maskMoney('mask', $(this).val());
                        updateJumlahAngsuranPerBulan(max_plafond, jangka_waktu, suku_bunga);

                    }else{
                        updateJumlahAngsuranPerBulan(nominal, jangka_waktu, suku_bunga);
                    }

                }else{
                    $('#nominal_pengajuan_kredit').val("");
                    $('#jumlah_angsuran_per_bulan').val("");
                }





            });





            function updateJumlahAngsuranPerBulan(nominal, jangka_waktu, suku_bunga){

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    },
                    url: "{{route('user.getjumlahangsuran')}}",
                    data: {nominal: nominal, jangka_waktu : jangka_waktu, suku_bunga: suku_bunga},
                    success: function (data) {
                        $('#jumlah_angsuran_per_bulan').val(data);
                        $('#jumlah_angsuran_per_bulan').maskMoney('mask', $('#jumlah_angsuran_per_bulan').val());
                    }
                });

            }

            function updatePlafond(penghasilan , jangka_waktu){
                 penghasilan = penghasilan.replaceAll('.', '');
                 var nominal = $('#nominal_pengajuan_kredit').val();
                 nominal = nominal.replaceAll('.', '');


                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    },
                    url: "{{route('user.getplafond')}}",
                    data: {penghasilan: penghasilan, jangka_waktu : jangka_waktu},
                    success: function (data) {
                        $('#max_plafond').val(data);
                        if (parseInt(nominal) > parseInt(data)){
                            $('#nominal_pengajuan_kredit').val(data);

                        }
                        $('#max_plafond').maskMoney('mask', $('#max_plafond').val());
                        $('#nominal_pengajuan_kredit').maskMoney('mask', $('#nominal_pengajuan_kredit').val());





                    }
                });
            }

            function updateSukuBunga(produk, jangka_waktu){

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    },
                    url: "{{route('user.getsukubunga')}}",
                    data: {produk: produk, jangka_waktu : jangka_waktu},
                    success: function (data) {
                        $('#suku_bunga').val(data);
                    }
                });
            }


    </script>




{{--    handle biodata diri--}}
    <script type="text/javascript">
        $(document).ready(function() {

            var kabkot = "{{Auth::user()->kabkot_id}}";
            var kecamatan = "{{Auth::user()->kecamatan_id}}";
            var kelurahan = "{{Auth::user()->kelurahan_id}}";

            if (kabkot != null){
                $('#kabkot').val(kabkot);
            }

            if (kecamatan != null){
                $('#kecamatan').val(kecamatan);
            }

            if (kelurahan != null){
                $('#kelurahan').val(kelurahan);
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    },
                    url: "{{url('/user/biodata/getkodepos')}}",
                    data: {id: kelurahan},
                    success: function (data) {
                        $('#kode_pos').val(data['kd_pos']);
                    }
                });
            }

            var pekerjaan = "{{Auth::user()->pekerjaan}}";
            if(pekerjaan !== 'CPNS' && pekerjaan!== 'PNS' && pekerjaan!== 'Pensiunan PNS' && pekerjaan !== 'DPRD' && pekerjaan !== 'Pejabat Non PNS / Komisioner KPU' && pekerjaan !== 'Perangkat Desa') {
                $('#pekerjaan').val('Lainnya');
                $('#pekerjaan_lainnya').val(pekerjaan);
                $('.pangkat').hide();
            }else{
                $('#pekerjaan').val(pekerjaan);
                $('#keterangan_lainnya').hide();
                if (pekerjaan == 'Pensiunan PNS' || pekerjaan == "PNS"){
                    $('.pangkat').show();
                }
            }


            var status_kawin = $('#status_perkawinan').val();
            if(status_kawin == 'Kawin' ) {
                $('#status_perkawinan').val('Kawin');
                $('.referensi_kawin').show();
            }else{
                $('.referensi_kawin').hide();
            }




        });

        $('#kabkot').on('change', function (){
            var id = $(this).val();

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                url: "{{url('/user/biodata/getkecamatan')}}",
                data: {id: id},
                success: function (data) {
                    $('#kecamatan').empty();
                    $('#kecamatan').append('<option selected disabled>-Pilih Kecamatan-</option>');
                    for (var i = 0 ; i < data[0].length ; i++){
                        var kecamatan = '<option value="'+data[0][i]['id']+'">'+data[0][i]['kecamatan']+'</option>';
                        $('#kecamatan').append(kecamatan);
                    }

                    $('#kelurahan').empty();
                    $('#kelurahan').append('<option selected disabled>-Pilih Kelurahan-</option>');
                    for (var i = 0 ; i < data[1].length ; i++){
                        var kelurahan = '<option value="'+data[1][i]['id']+'">'+data[1][i]['kelurahan']+'</option>';
                        $('#kelurahan').append(kelurahan);
                    }

                    $('#kode_pos').val('');
                }
            });

        });

        $('#kecamatan').on('change', function (){
            var id = $(this).val();

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                url: "{{url('/user/biodata/getkelurahan')}}",
                data: {id: id},
                success: function (data) {
                    $('#kelurahan').empty();
                    for (var i = 0 ; i < data.length ; i++){
                        var kelurahan = '<option value="'+data[i]['id']+'">'+data[i]['kelurahan']+'</option>';
                        $('#kelurahan').append(kelurahan);
                    }
                    $('#kode_pos').val(data[0]['kd_pos']);
                }
            });

        });

        $('#kelurahan').on('change', function (){
            var id = $(this).val();

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                url: "{{url('/user/biodata/getkodepos')}}",
                data: {id: id},
                success: function (data) {
                    $('#kode_pos').val(data['kd_pos']);
                }
            });

        });

        $('#pekerjaan').on('change', function (){
            var pekerjaan = $(this).val();

            if(pekerjaan == 'Lainnya'){
                $('#keterangan_lainnya').show();
                $('.pangkat').hide();
            }else{
                if (pekerjaan == "Pensiunan PNS" || pekerjaan == "PNS"){
                    $('.pangkat').show();
                }else{
                    $('.pangkat').hide();
                }
                $('#keterangan_lainnya').hide();
            }

        });


        $('#status_perkawinan').on('change', function (){
            var status = $(this).val();

            if(status == 'Kawin'){
                $('.referensi_kawin').show();
            }else{
                $('.referensi_kawin').hide();
            }

        });





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


        function confirmSubmit(){
            var agree=confirm("Apakah seluruh data yang Anda isi telah sesuai dan benar?");
            if (agree) {
                return true ;
            }else {
                return false;
            }

        }



    </script>


    @endsection
