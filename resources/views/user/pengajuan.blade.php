@extends('layouts.user')

@section('title', 'Pengajuan Kredit')

@section('style')

    <link href="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
    <style>
        body {
            background-color: #EEEFF3;
        }

        .sw-theme-dots>.nav::before {
            background-color: grey;!important
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
                            <a class="nav-link" href="#formulir-pengajuan">
                                Formulir Pengajuan
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
                    <form action="{{url('/user/pengajuan/update')}}" method="post" id="formPengajuan">
                    <div class="tab-content">
                        <div id="biodata-diri" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" value="{{Auth::user()->name}}" name="name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" value="{{Auth::user()->email}}" name="email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noktp">No KTP</label>
                                        <input type="text" class="form-control" value="{{Auth::user()->no_ktp}}" name="no_ktp" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nohp">No Handphone</label>
                                        <input type="text" class="form-control" value="{{Auth::user()->no_hp}}" name="no_hp" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tempatlahir">Tempat Lahir</label>
                                        <input type="text" class="form-control" value="{{Auth::user()->tempat_lahir}}" name="tempat_lahir" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggallahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control" value="{{Auth::user()->tanggal_lahir}}" name="tanggal_lahir" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alamat">Alamat Domisili</label>
                                        <select name="provinsi" class="form-control" id="provinsi">
                                            @foreach($provinsi as $data)
                                                <option value="{{$data->id}}">{{$data->provinsi}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alamat" style="color: #EEEFF3">-</label>
                                        <select name="kabkot" class="form-control" id="kabkot">
                                            <option selected disabled>-Pilih Kabupaten / Kota-</option>
                                            @foreach($kabkot as $data)
                                                <option value="{{$data->id}}">{{$data->kabupaten_kota}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="kecamatan" class="form-control" id="kecamatan">
                                            <option selected disabled>-Pilih Kecamatan-</option>
                                            @foreach($kecamatan as $data)
                                                <option value="{{$data->id}}">{{$data->kecamatan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="kelurahan" class="form-control" id="kelurahan">
                                            <option selected disabled>-Pilih Kelurahan-</option>
                                            @foreach($kelurahan as $data)
                                                <option value="{{$data->id}}">{{$data->kelurahan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="kode_pos" readonly placeholder="Kode Pos">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="alamat" class="form-control" value="{{Auth::user()->alamat}}" placeholder="Alamat Lengkap">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggallahir">Pekerjaan</label>
                                        <input type="text" class="form-control" value="{{Auth::user()->pekerjaan}}" name="pekerjaan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggallahir">Nomor NPWP</label>
                                        <input type="text" maxlength="15" minlength="15" value="{{Auth::user()->npwp}}" class="form-control" name="no_npwp" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="dokumen-saya" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Foto E-KTP (3x4)</label>
                                        <div class='content'>
                                            <!-- Dropzone -->
                                            <div id="dokumenUploadKTP" class="dropzone">
                                                @csrf
                                                <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                                            </div>
                                        </div>
                                        <small  class="form-text text-muted">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Pas Foto Saya (3x4)</label>
                                        <div class='content'>
                                            <!-- Dropzone -->
                                            <div id="dokumenUploadPasfoto" class="dropzone" >
                                                @csrf
                                                <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                                            </div>
                                        </div>
                                        <small  class="form-text text-muted">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noktp">NPWP (3x4)</label>
                                        <div class='content'>
                                            <!-- Dropzone -->
                                            <div  id="dokumenUploadNPWP" class="dropzone" >
                                                @csrf
                                                <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                                            </div>
                                        </div>
                                        <small  class="form-text text-muted">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="formulir-pengajuan" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Produk Kredit</label>
                                        <select class="form-control" name="produk_kredit">
                                            <option selected disabled>-Pilih Produk Kredit-</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Penghasilan per Bulan</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                            </div>
                                            <input type="text" class="form-control"  name="penghasilan_per_bulan" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nama">Jangka Waktu Kredit</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"  name="jangka_waktu_kredit" required>
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
                                            <input type="text" class="form-control"  name="suku_bunga" required>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Maksimal Plafond yang Dapat Diambil</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                            </div>
                                            <input type="text" class="form-control"  name="max_plafond"  readonly required>
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
                                            <input type="text" class="form-control"  name="nominal_pengajuan_kredit" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="" style="color: #EEEFF3">-</label>
                                    <div class="form-group">
                                      <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#simulasiKredit" >Simulasi Kredit</button>
                                    </div>
                                </div>
                                <div class="col-md-4 pl-0 ml-0">
                                    <label for="" style="color: #EEEFF3">-</label>
                                    <div class="form-group">
                                        <small  style="float: left" class="form-text text-muted">Simulasi kredit menggunakan metode anuitas</small>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div id="dokumen-kredit" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                            Step 4 Content
                        </div>
                        <div id="tahap-terakhir" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Cabang atau Capem</label>
                                        <select name="cabang" class="form-control" id="">
                                            <option selected disabled>-Pilih Cabang atau Capem Terdekat-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Customer Service</label>
                                        <select name="cs" class="form-control" id="">
                                            <option selected disabled>-Pilih CS yang Tersedia di Cabang atau Capem Terdekat-</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Jadwal Pencairan Dana</label>
                                        <input type="date" class="form-control" name="jadwal_pencairan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Slot Waktu Pencairan Dana</label>
                                        <select name="slot_waktu" class="form-control" id="">
                                            <option selected disabled>-Pilih Slot Waktu yang Tersedia-</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-5">
                                    <button class="btn btn-primary" type="submit" style="float: right">Konfirmasi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
        </div>
    </div>
{{--    <div class="card">--}}




{{--    </div>--}}

</div>





    @endsection


@section('modal')
    @include('user.modal.simulasi_kredit')
    @endsection


@section('script')
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
{{--   handle toastr --}}
    <script type="text/javascript">

        @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
        @elseif(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
        @endif

    </script>


{{--    handle validation--}}
<script type="text/javascript">

    $("#smartwizard").on("leaveStep", function (e, anchorObject, stepNumber, stepDirection) {

        var $myForm = $('#formPengajuan');
        if(! $myForm[0].checkValidity()) {
            $myForm.find(':submit').click();

        }
    });

    // $(".sw-btn-next").on('click', function(){ // when the button is clicked...
    //     console.log('hello world');
    //
    //
    // })

</script>

{{--    handle biodata diri--}}
    <script type="text/javascript">
        $(document).ready(function() {
            var kabkot = {{Auth::user()->kabkot_id}};
            var kecamatan = {{Auth::user()->kecamatan_id}};
            var kelurahan = {{Auth::user()->kelurahan_id}};

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


    </script>


{{--handle dokumen saya--}}
<script type="text/javascript">

    var dropzone1 =  Dropzone.options.dokumenUploadKTP = {
        autoProcessQueue: true,
        url: '{{route('dokumen.uploadktp')}}',
        addRemoveLinks: true,
        uploadMultiple: false,
        headers: {
            'X-CSRF-Token': "{{csrf_token()}}"
        },
        autoDiscover : false,
        maxFilesize: 5,
        acceptedFiles: '.jpg, .jpeg, .png',
        maxFiles: 1,
        parallelUploads : 3,
        init: function () {

            var myDropzone = this;

            $.ajax({
                url: '{{route('dokumen.getthumbnail')}}',
                type: 'post',
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                data: {data: "ktp"},
                dataType: 'json',
                success: function(response){

                    $.each(response, function(key,value) {
                        var mockFile = { name: value.name, size: value.size };

                        myDropzone.emit("addedfile", mockFile);
                        myDropzone.emit("thumbnail", mockFile, value.path);
                        myDropzone.emit("complete", mockFile);

                    });

                }
            });

            // Update selector to match your button
            $("#upload_dokumen").click(function (e) {
                e.preventDefault();
                myDropzone.processQueue();
            });

            this.on('sending', function(file, xhr, formData) {
                // Append all form inputs to the formData Dropzone will POST
                var data = $('#frmTarget').serializeArray();
                $.each(data, function(key, el) {
                    formData.append(el.name, el.value);
                });
            });

            this.on("success", function() {
                location.reload();
            });
        }
    }

    var dropzone2 =  Dropzone.options.dokumenUploadPasfoto = {
        autoProcessQueue: true,
        url: '{{route('dokumen.uploadpasfoto')}}',
        addRemoveLinks: true,
        uploadMultiple: false,
        autoDiscover : false,
        headers: {
            'X-CSRF-Token': "{{csrf_token()}}"
        },
        maxFilesize: 5,
        acceptedFiles: '.jpg, .jpeg, .png',
        maxFiles: 1,
        parallelUploads : 3,
        init: function () {

            var myDropzone = this;


            $.ajax({
                url: '{{route('dokumen.getthumbnail')}}',
                type: 'post',
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                data: {data: "pas_foto"},
                dataType: 'json',
                success: function(response){

                    $.each(response, function(key,value) {
                        var mockFile = { name: value.name, size: value.size };

                        myDropzone.emit("addedfile", mockFile);
                        myDropzone.emit("thumbnail", mockFile, value.path);
                        myDropzone.emit("complete", mockFile);

                    });

                }
            });

            // Update selector to match your button
            $("#upload_dokumen").click(function (e) {
                e.preventDefault();
                myDropzone.processQueue();
            });

            this.on('sending', function(file, xhr, formData) {
                // Append all form inputs to the formData Dropzone will POST
                var data = $('#frmTarget').serializeArray();
                $.each(data, function(key, el) {
                    formData.append(el.name, el.value);
                });
            });

            this.on("success", function() {
                location.reload();
            });
        }
    }

    var dropzone3 =  Dropzone.options.dokumenUploadNPWP = {
        autoProcessQueue: true,
        url: '{{route('dokumen.uploadnpwp')}}',
        addRemoveLinks: true,
        uploadMultiple: false,
        autoDiscover : false,
        headers: {
            'X-CSRF-Token': "{{csrf_token()}}"
        },
        maxFilesize: 5,
        acceptedFiles: '.jpg, .jpeg, .png',
        maxFiles: 1,
        parallelUploads : 3,
        init: function () {

            var myDropzone = this;


            $.ajax({
                url: '{{route('dokumen.getthumbnail')}}',
                type: 'post',
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                data: {data: "npwp"},
                dataType: 'json',
                success: function(response){

                    $.each(response, function(key,value) {
                        var mockFile = { name: value.name, size: value.size };
                        myDropzone.emit("addedfile", mockFile);
                        myDropzone.emit("thumbnail", mockFile, value.path);
                        myDropzone.emit("complete", mockFile);

                    });

                }
            });

            // Update selector to match your button
            $("#upload_dokumen").click(function (e) {
                e.preventDefault();
                myDropzone.processQueue();
            });

            this.on('sending', function(file, xhr, formData) {
                // Append all form inputs to the formData Dropzone will POST
                var data = $('#frmTarget').serializeArray();
                $.each(data, function(key, el) {
                    formData.append(el.name, el.value);
                });
            });

            this.on("success", function() {
                location.reload();
            });
        }
    }




</script>





{{--    handle wizard--}}
    <script src="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#smartwizard').smartWizard({
                selected: 0, // Initial selected step, 0 = first step
                theme: 'dots', // theme for the wizard, related css need to include for other than default theme
                justified: true, // Nav menu justification. true/false
                darkMode:false, // Enable/disable Dark Mode if the theme supports. true/false
                autoAdjustHeight: false, // Automatically adjust content height
                cycleSteps: false, // Allows to cycle the navigation of steps
                backButtonSupport: true, // Enable the back button support
                transition: {
                    animation: 'fade', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
                    speed: '400', // Transion animation speed
                    easing:'' // Transition animation easing. Not supported without a jQuery easing plugin
                },
                toolbarSettings: {
                    toolbarPosition: 'bottom', // none, top, bottom, both
                    toolbarButtonPosition: 'right', // left, right, center
                    showNextButton: true, // show/hide a Next button
                    showPreviousButton: true, // show/hide a Previous button
                    toolbarExtraButtons: [] // Extra buttons to show on toolbar, array of jQuery input/buttons elements
                },
                anchorSettings: {
                    anchorClickable: true, // Enable/Disable anchor navigation
                    enableAllAnchors: false, // Activates all anchors clickable all times
                    markDoneStep: true, // Add done state on navigation
                    markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                    removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
                    enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                },
                keyboardSettings: {
                    keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
                    keyLeft: [37], // Left key code
                    keyRight: [39] // Right key code
                },
                lang: { // Language variables for button
                    next: 'Selanjutnya',
                    previous: 'Sebelumnya'
                },
                disabledSteps: [], // Array Steps disabled
                errorSteps: [], // Highlight step with errors
                hiddenSteps: [] // Hidden steps
            });

        });
    </script>

    @endsection
