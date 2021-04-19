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
                                        <input type="text" class="form-control" name="tempat_lahir" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggallahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="tanggal_lahir" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alamat">Alamat Lengkap Rumah</label>
                                        <input type="text" class="form-control" placeholder="Provinsi">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alamat" style="color: #EEEFF3">-</label>
                                        <input type="text" class="form-control" placeholder="Kabupaten / Kota">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Kecamatan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Kelurahan">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Kode Pos">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Alamat Lengkap">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggallahir">Pekerjaan</label>
                                        <input type="text" class="form-control" name="pekerjaan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggallahir">Nomor NPWP</label>
                                        <input type="text" class="form-control" name="no_npwp" required>
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
                                            <form action="{{route('dokumen.uploadktp')}}" id="dokumenUploadKTP" class="dropzone" enctype="multipart/form-data" method="post" >
                                                @csrf
                                                <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                                            </form>
                                        </div>
                                        <small  class="form-text text-muted">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Pas Foto Saya (3x4)</label>
                                        <div class='content'>
                                            <!-- Dropzone -->
                                            <form action="{{route('dokumen.uploadpasfoto')}}" id="dokumenUploadPasfoto" class="dropzone" enctype="multipart/form-data" method="post" >
                                                @csrf
                                                <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                                            </form>
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
                                            <form action="{{route('dokumen.uploadnpwp')}}" id="dokumenUploadNPWP" class="dropzone" enctype="multipart/form-data" method="post" >
                                                @csrf
                                                <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                                            </form>
                                        </div>
                                        <small  class="form-text text-muted">Ukuran file maks 5MB. Format file .jpg, .jpeg, .png.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="formulir-pengajuan" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                            Step 3 Content
                        </div>
                        <div id="dokumen-kredit" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                            Step 4 Content
                        </div>
                        <div id="tahap-terakhir" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                            Step 4 Content
                        </div>
                    </div>
                </div>
        </div>
    </div>
{{--    <div class="card">--}}




{{--    </div>--}}

</div>





    @endsection


@section('script')

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
                    animation: 'none', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
                    speed: '400', // Transion animation speed
                    easing:'' // Transition animation easing. Not supported without a jQuery easing plugin
                },
                toolbarSettings: {
                    toolbarPosition: 'bottom', // none, top, bottom, both
                    toolbarButtonPosition: 'center', // left, right, center
                    showNextButton: true, // show/hide a Next button
                    showPreviousButton: true, // show/hide a Previous button
                    toolbarExtraButtons: [] // Extra buttons to show on toolbar, array of jQuery input/buttons elements
                },
                anchorSettings: {
                    anchorClickable: true, // Enable/Disable anchor navigation
                    enableAllAnchors: false, // Activates all anchors clickable all times
                    markDoneStep: true, // Add done state on navigation
                    markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                    removeDoneStepOnNavigateBack: false, // While navigate back done step after active step will be cleared
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
