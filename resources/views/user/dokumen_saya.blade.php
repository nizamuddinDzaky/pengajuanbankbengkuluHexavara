@extends('layouts.user')

@section('title','Dokumen Saya')

@section('style')
    <style>
        small {
            float: right;
        }

        .dz-image img{
            width: 130px;
            height:130px;
        }
        
    </style>
    @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="container d-flex justify-content-center">
                    <div class="card mt-5 px-4 pt-4 pb-2">
                        <div class="media p-2"> <img src="https://imgur.com/yVjnDV8.png" class="mr-1 align-self-start">
                            <div class="media-body">
                            </div>
                            <div class="d-flex flex-row justify-content-between">
                                <h6 class="mt-2 mb-0">{{Auth::user()->name}}</h6>
                            </div>
                        </div>
                        <ul class="list text-muted mt-3 pl-0">
                            <li @if(Request::is('user/biodata')) class="option-active" @endif><a href="{{url('user/biodata')}}" style="color: inherit" ><i class="fa fa-user mr-3 ml-2"></i> Biodata Saya</a></li>
                            <li @if(Request::is('user/dokumen')) class="option-active" @endif><a href="{{url('user/dokumen')}}" style="color: inherit" ><i class="fa fa-file mr-3 ml-2"></i> Dokumen Saya</a></li>
                            <li @if(Request::is('user/ubah_katasandi')) class="option-active" @endif><a href="{{url('user/ubah_katasandi')}}" style="color: inherit" ><i class="fa fa-lock mr-3 ml-2"></i> Ubah Kata Sandi </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                    <div class="row">
                        <h3 class="mt-5">Dokumen Saya</h3>
                    </div>
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
{{--                    <div class="row mt-3">--}}
{{--                        <div class="col-md-12">--}}
{{--                            <button style="float: right" type="button" id="upload_dokumen" class="btn btn-primary">Simpan</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}


            </div>
        </div>

    </div>
@endsection
@section('script')
    <script type="text/javascript">

            @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
            @elseif(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
            @endif

    </script>
     <script>
       var dropzone1 =  Dropzone.options.dokumenUploadKTP = {
            autoProcessQueue: true,
            url: '{{route('dokumen.uploadktp')}}',
            addRemoveLinks: true,
            uploadMultiple: false,
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



@endsection
