@extends('layouts.admin')

@section('title', 'Produk dan Akad Kredit')

@section('css')
    <style>
        .orange-outline{
            border-color:#E46931;
            color: #E46931;
        }
    </style>


@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <h1 class="m-0 text-dark ml-4 mt-4 mb-3">Pengelolaan Produk dan Akad Kredit</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <h3 >Total : {{$jumlah_produk}} Produk</h3>
                            </div>
                            <div class="col-3 offset-6 text-right">
                                <button class="btn orange-outline" data-toggle="modal" data-target="#tambahProdukModal">Tambah</button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="list-produk" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Penjelasan</th>
                                <th>Bunga</th>
                                <th>Dokumen Formulir / Blangko</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($produk as $data)
                                <tr>
                                    <td>{{$data->nama}}</td>
                                    <td>{{$data->deskripsi}}</span></td>
                                    <td>{!! $data->bunga !!}</td>
                                    <td>{{substr(strstr(json_decode($data->path_file)->blangko, "/"),1)}}</td>
                                    <td>  <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Atur
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editProdukModal" data-produk_id="{{$data->id}}" ><i class="fa fa-pencil-alt"></i> Edit</a>
                                            <a class="dropdown-item" onclick="hapusProduk({{$data->id}})"><i class="fa fa-trash-alt"></i> Hapus</a>
                                        </div></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('adminpusat.modal.tambah_produk_kredit')
    @include('adminpusat.modal.edit_produk_kredit')
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script>
        $('#list-produk').DataTable();
    </script>

    <script>
        function hapusProduk(id){
            var agree=confirm("Apakah anda yakin ingin menghapus produk ini?");
            if (agree) {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    },
                    url: "{{route('admin.pusat.delete_produk')}}",
                    dataType: "JSON",
                    data : {id : id},
                    success: function (response) {
                        if (response == true){
                            location.reload();
                        }else{
                            toastr.error('Gagal Menghapus Nasabah');
                        }

                    }
                });

            }else {
                return false;
            }
        }

        $('#tambahProdukModal').on('show.bs.modal', function (event) {

            var jenis = $('#suku_bunga_tambah').val();
            if (jenis == "berjangka"){
                $('#suku_bunga_berjangka').show();
                $('#suku_bunga_flat').hide();
                $('.berjangka').attr('required');
                $('#bunga_flat').removeAttr('required');
            }else{
                $('#suku_bunga_flat').show();
                $('#suku_bunga_berjangka').hide();
                $('#bunga_flat').attr('required');
                $('.berjangka').removeAttr('required');
            }



        });


        $('#editProdukModal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('produk_id');
            $('#produk_id_edit').val(id);

            $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    },
                    url: "{{route('admin.pusat.detail.produk_kredit')}}",
                    dataType: "JSON",
                    data : {id : id},
                    success: function (response) {
                        $('#nama_produk_edit').val(response[0]['nama'])
                        $('#penjelasan_edit').html(response[0]['deskripsi'])
                        $('#suku_bunga_edit').val(response[0]['jenis_suku_bunga']);
                        $('#fileTemplate').attr("href","/"+JSON.parse(response[0]['path_file']).blangko_pdf);
                        $('#fileDokumen').attr("href","/"+JSON.parse(response[0]['path_file']).blangko);
                        $('#statusFileDokumen').val(JSON.parse(response[0]['path_file']).blangko);
                        $('#statusFileTemplate').val(JSON.parse(response[0]['path_file']).blangko_pdf);



                        if (response[0]['jenis_suku_bunga'] == "berjangka"){
                            $('#suku_bunga_berjangka_edit').show();
                            $('#suku_bunga_flat_edit').hide();
                            $('.berjangka').attr('required', true);
                            $('#bunga_flat_edit').removeAttr('required');
                            setupBungaBerjangkaEdit(response[1])
                        }else{
                            $('#suku_bunga_flat_edit').show();
                            $('#suku_bunga_berjangka_edit').hide();
                            $('#bunga_flat_edit').val(response[1]['bunga']);
                            $('#bunga_flat_edit').attr('required', true);
                            $('.berjangka').removeAttr('required');
                        }








                    }
                });


        });




        $('#suku_bunga_edit').on('change', function () {
            var jenis = $(this).val();

            if (jenis == "berjangka"){
                $('#suku_bunga_berjangka_edit').show();
                $('#suku_bunga_flat_edit').hide();
                $('.berjangka').attr('required', true);
                $('#bunga_flat_edit').removeAttr('required');
            }else{
                $('#suku_bunga_flat_edit').show();
                $('#suku_bunga_berjangka_edit').hide();
                $('#bunga_flat_edit').attr('required', true);
                $('.berjangka').removeAttr('required');

            }

        });


        $('#suku_bunga_tambah').on('change', function () {
            var jenis = $(this).val();

            if (jenis == "berjangka"){
                $('#suku_bunga_berjangka').show();
                $('#suku_bunga_flat').hide();
                $('.berjangka').attr('required', true);
                $('#bunga_flat').removeAttr('required');
            }else{
                $('#suku_bunga_flat').show();
                $('#suku_bunga_berjangka').hide();
                $('#bunga_flat').attr('required', true);
                $('.berjangka').removeAttr('required');

            }

        });

        var counterBunga = 1;
        var counterBungaEdit = 1;



        function tambahJangkaWaktu(){


            var template =  '<div class="row" id="jangkaWaktu'+counterBunga+'">'+
                '<div class="col-3">'+
                    '<div class="form-group">'+
                        '<div class="input-group">'+
                            '<input type="number" class="form-control berjangka" name="tahun_awal[]" required placeholder="Awal">'+
                             '   <div class="input-group-prepend">'+
                                 ' <span class="input-group-text" id="basic-addon1">Tahun</span>'+
                                '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
               ' <div class="col-3">'+
                    '<div class="form-group">'+
                        '<div class="input-group">'+
                            '<input type="number" class="form-control berjangka" required name="tahun_akhir[]" placeholder="Akhir" >'+
                                '<div class="input-group-prepend">'+
                                    '<span class="input-group-text" id="basic-addon1">Tahun</span>'+
                                '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="col-4">'+
                    '<div class="form-group">'+
                        '<div class="input-group">'+
                            '<input type="number" step="0.01" class="form-control berjangka" name="bunga_berjangka[]" required>'+
                                '<div class="input-group-prepend">'+
                                    '<span class="input-group-text" id="basic-addon1">%</span>'+
                                '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="col-2">'+
                    '<button class="btn btn-outline-danger" type="button" onclick="deleteJangkaWaktu('+counterBunga+')"> - Jangka Waktu</button>'+
                '</div>'+
            '</div>'

            $('#suku_bunga_berjangka').append(template);
            counterBunga = counterBunga + 1;
        }


        function tambahJangkaWaktuEdit(){


            var template =  '<div class="row" id="jangkaWaktuEdit'+counterBungaEdit+'">'+
                '<div class="col-3">'+
                '<div class="form-group">'+
                '<div class="input-group">'+
                '<input type="number" class="form-control berjangka" name="tahun_awal[]" required placeholder="Awal">'+
                '   <div class="input-group-prepend">'+
                ' <span class="input-group-text" id="basic-addon1">Tahun</span>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</div>'+
                ' <div class="col-3">'+
                '<div class="form-group">'+
                '<div class="input-group">'+
                '<input type="number" class="form-control berjangka" required name="tahun_akhir[]" placeholder="Akhir" >'+
                '<div class="input-group-prepend">'+
                '<span class="input-group-text" id="basic-addon1">Tahun</span>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="col-4">'+
                '<div class="form-group">'+
                '<div class="input-group">'+
                '<input type="number" step="0.01" class="form-control berjangka" name="bunga_berjangka[]" required>'+
                '<div class="input-group-prepend">'+
                '<span class="input-group-text" id="basic-addon1">%</span>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="col-2">'+
                '<button class="btn btn-outline-danger" type="button" onclick="deleteJangkaWaktuEdit('+counterBungaEdit+')"> - Jangka Waktu</button>'+
                '</div>'+
                '</div>'

            $('#suku_bunga_berjangka_edit').append(template);
            counterBungaEdit = counterBungaEdit + 1;
        }


        function setupBungaBerjangkaEdit(bunga){

            $('#tahun_awal_edit').val(bunga[0]['dari_bulan'] / 12);
            $('#tahun_akhir_edit').val(bunga[0]['sampai_bulan'] / 12);
            $('#bunga_berjangka_edit').val(bunga[0]['bunga']);

            for (var i = 1 ; i < bunga.length ; i++){

                var template =  '<div class="row" id="jangkaWaktuEdit'+counterBungaEdit+'">'+
                    '<div class="col-3">'+
                    '<div class="form-group">'+
                    '<div class="input-group">'+
                    '<input type="number" class="form-control berjangka" name="tahun_awal[]" required placeholder="Awal" value="'+(bunga[i]['dari_bulan'] - 1)/12+'">'+
                    '   <div class="input-group-prepend">'+
                    ' <span class="input-group-text" id="basic-addon1">Tahun</span>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    ' <div class="col-3">'+
                    '<div class="form-group">'+
                    '<div class="input-group">'+
                    '<input type="number" class="form-control berjangka" required name="tahun_akhir[]" placeholder="Akhir" value="'+bunga[i]['sampai_bulan']/12+'" >'+
                    '<div class="input-group-prepend">'+
                    '<span class="input-group-text" id="basic-addon1">Tahun</span>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="col-4">'+
                    '<div class="form-group">'+
                    '<div class="input-group">'+
                    '<input type="number" step="0.01" class="form-control berjangka" name="bunga_berjangka[]" required value="'+bunga[i]['bunga']+'">'+
                    '<div class="input-group-prepend">'+
                    '<span class="input-group-text" id="basic-addon1">%</span>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="col-2">'+
                    '<button class="btn btn-outline-danger" type="button" onclick="deleteJangkaWaktuEdit('+counterBungaEdit+')"> - Jangka Waktu</button>'+
                    '</div>'+
                    '</div>'

                $('#suku_bunga_berjangka_edit').append(template);


            }



            // console.log(bunga[0]['dari_bulan'])

        }


        function deleteJangkaWaktu(id){

            var id = "#jangkaWaktu"+id;

            $(id).remove();

        }

        function deleteJangkaWaktuEdit(id){
            var id = "#jangkaWaktuEdit"+id;

            $(id).remove();
        }


    </script>


    <script>
        Dropzone.options.dokumenBlangko = {
            autoProcessQueue: true,
            url:  '{{route('admin.pusat.upload.blangko', 'dokumen')}}',
            addRemoveLinks: true,
            uploadMultiple: false,
            autoDiscover : false,
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            maxFilesize: 5,
            acceptedFiles: '.docx',
            maxFiles: 1,
            parallelUploads : 3,
            init: function () {

                var myDropzone = this;

                myDropzone.on("removedfile", function (file) {
                    $('#dokumen_blangko_tambah').val('');
                });


                this.on('sending', function(file, xhr, formData) {
                    // Append all form inputs to the formData Dropzone will POST
                    var data = $('#frmTarget').serializeArray();
                    $.each(data, function(key, el) {
                        formData.append(el.name, el.value);
                    });
                });

                this.on("success", function() {
                    $('#dokumen_blangko_tambah').val('success');
                    toastr.success('Berhasil Upload File');
                });
            }
        }


        Dropzone.options.dokumenTemplateBlangko = {
            autoProcessQueue: true,
            url:  '{{route('admin.pusat.upload.blangko', 'template')}}',
            addRemoveLinks: true,
            uploadMultiple: false,
            autoDiscover : false,
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            maxFilesize: 5,
            acceptedFiles: '.pdf',
            maxFiles: 1,
            parallelUploads : 3,
            init: function () {

                var myDropzone = this;

                myDropzone.on("removedfile", function (file) {
                    $('#template_blangko_tambah').val('');
                });

                this.on('sending', function(file, xhr, formData) {
                    // Append all form inputs to the formData Dropzone will POST
                    var data = $('#frmTarget').serializeArray();
                    $.each(data, function(key, el) {
                        formData.append(el.name, el.value);
                    });
                });

                this.on("success", function() {
                    $('#template_blangko_tambah').val('success');
                    toastr.success('Berhasil Upload File');
                });
            }
        }


        Dropzone.options.dokumenBlangkoEdit = {
            autoProcessQueue: true,
            url:  '{{route('admin.pusat.upload.blangko', 'dokumen')}}',
            addRemoveLinks: true,
            uploadMultiple: false,
            autoDiscover : false,
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            maxFilesize: 5,
            acceptedFiles: '.docx',
            maxFiles: 1,
            parallelUploads : 3,
            init: function () {

                var myDropzone = this;

                myDropzone.on("removedfile", function (file) {
                    $('#dokumen_blangko_edit').val('');
                });



                this.on('sending', function(file, xhr, formData) {
                    // Append all form inputs to the formData Dropzone will POST
                    var data = $('#frmTarget').serializeArray();
                    $.each(data, function(key, el) {
                        formData.append(el.name, el.value);
                    });
                });

                this.on("success", function() {
                    $('#dokumen_blangko_edit').val('success');
                    $('#statusFileDokumen').val('');
                    toastr.success('Berhasil Upload File');
                });
            }
        }


        Dropzone.options.dokumenTemplateBlangkoEdit = {
            autoProcessQueue: true,
            url:  '{{route('admin.pusat.upload.blangko', 'template')}}',
            addRemoveLinks: true,
            uploadMultiple: false,
            autoDiscover : false,
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            maxFilesize: 5,
            acceptedFiles: '.pdf',
            maxFiles: 1,
            parallelUploads : 3,
            init: function () {

                var myDropzone = this;

                myDropzone.on("removedfile", function (file) {
                    $('#template_blangko_edit').val('');
                });


                this.on('sending', function(file, xhr, formData) {
                    // Append all form inputs to the formData Dropzone will POST
                    var data = $('#frmTarget').serializeArray();
                    $.each(data, function(key, el) {
                        formData.append(el.name, el.value);
                    });
                });

                this.on("success", function() {
                    $('#template_blangko_edit').val('success');
                    $('#statusFileTemplate').val('');
                    toastr.success('Berhasil Upload File');
                });
            }
        }


    </script>

    <script>
        function confirmSubmit(){

            $("#validasiBlangkoTambah").validate({
                ignore: "",
                errorPlacement: function (error, element) {
                    return true;
                }
            });

            if ($("#validasiBlangkoTambah").valid()) {

                var agree=confirm("Apakah anda yakin ingin menambah produk ini?");
                if (agree) {
                    return true;
                }else {
                    return false;
                }


            }else{
                toastr.error('Upload Dokumen Yang Dibutuhkan')
                return false;
            }

        }

        function confirmSubmitEdit(){


                var agree=confirm("Apakah anda yakin ingin mengedit produk ini?");
                if (agree) {
                    return true;
                }else {
                    return false;
                }

        }
    </script>
@endsection
