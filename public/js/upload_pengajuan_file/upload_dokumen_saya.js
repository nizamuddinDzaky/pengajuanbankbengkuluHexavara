var dropzoneKTP =  Dropzone.options.dokumenUploadKTP = {
    autoProcessQueue: true,
    url: '/user/dokumen/uploadktp',
    addRemoveLinks: true,
    uploadMultiple: false,
    headers: {
        'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
    },
    autoDiscover : false,
    maxFilesize: 5,
    acceptedFiles: '.jpg, .jpeg, .png',
    maxFiles: 1,
    parallelUploads : 3,
    init: function () {

        var myDropzone = this;

        myDropzone.on("removedfile", function (file) {
            $('.ktp_validation').val('');
        });

        $.ajax({
            url: '/user/dokumen/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            },
            data: {data: "ktp"},
            dataType: 'json',
            success: function(response){

                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    $('.ktp_validation').val(value.path);

                    myDropzone.emit("addedfile", mockFile);
                    myDropzone.emit("thumbnail", mockFile, value.path);
                    myDropzone.emit("complete", mockFile);

                });

            }
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
            $('.ktp_validation').val("success");
        });
    }
}

var dropzonePasFoto =  Dropzone.options.dokumenUploadPasfoto = {
    autoProcessQueue: true,
    url:  '/user/dokumen/uploadpasfoto',
    addRemoveLinks: true,
    uploadMultiple: false,
    autoDiscover : false,
    headers: {
        'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
    },
    maxFilesize: 5,
    acceptedFiles: '.jpg, .jpeg, .png',
    maxFiles: 1,
    parallelUploads : 3,
    init: function () {

        var myDropzone = this;

        myDropzone.on("removedfile", function (file) {
            $('.pas_foto_validation').val('');
        });


        $.ajax({
            url:  '/user/dokumen/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "pas_foto"},
            dataType: 'json',
            success: function(response){

                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    $('.pas_foto_validation').val(value.path);
                    myDropzone.emit("addedfile", mockFile);
                    myDropzone.emit("thumbnail", mockFile, value.path);
                    myDropzone.emit("complete", mockFile);

                });

            }
        });


        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $('#frmTarget').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
        });

        this.on("success", function() {
            toastr.success('Berhasil Upload File');
            $('.pas_foto_validation').val("success");
        });
    }
}

var dropzoneNPWP =  Dropzone.options.dokumenUploadNPWP = {
    autoProcessQueue: true,
    url:  '/user/dokumen/uploadnpwp',
    addRemoveLinks: true,
    uploadMultiple: false,
    autoDiscover : false,
    headers: {
        'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
    },
    maxFilesize: 5,
    acceptedFiles: '.jpg, .jpeg, .png',
    maxFiles: 1,
    parallelUploads : 3,
    init: function () {

        var myDropzone = this;

        myDropzone.on("removedfile", function (file) {
            $('.npwp_validation').val('');
        });


        $.ajax({
            url:  '/user/dokumen/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "npwp"},
            dataType: 'json',
            success: function(response){

                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    $('.npwp_validation').val(value.path);
                    myDropzone.emit("addedfile", mockFile);
                    myDropzone.emit("thumbnail", mockFile, value.path);
                    myDropzone.emit("complete", mockFile);

                });

            }
        });


        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $('#frmTarget').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
        });

        this.on("success", function() {
            $('.npwp_validation').val('success');
            toastr.success('Berhasil Upload File');
        });
    }
}


var dropzoneKartuKeluarga =  Dropzone.options.dokumenKartuKeluarga = {
    autoProcessQueue: true,
    url:  '/user/pengajuan/upload_dokumen_saya/kartu_keluarga',
    addRemoveLinks: true,
    uploadMultiple: false,
    autoDiscover : false,
    headers: {
        'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
    },
    maxFilesize: 5,
    acceptedFiles: '.jpg, .jpeg, .png',
    maxFiles: 1,
    parallelUploads : 3,
    init: function () {

        var myDropzone = this;

        myDropzone.on("removedfile", function (file) {
            $('.kartu_keluarga_validation').val('');
        });


        $.ajax({
            url:  '/user/pengajuan/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "kartu_keluarga", tipe : "dokumen_saya"},
            dataType: 'json',
            success: function(response){
                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    $('.kartu_keluarga_validation').val(value.path);
                    myDropzone.emit("addedfile", mockFile);
                    myDropzone.emit("thumbnail", mockFile, value.path);
                    myDropzone.emit("complete", mockFile);

                });

            }
        });


        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $('#frmTarget').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
        });

        this.on("success", function() {
            toastr.success('Berhasil Upload File');
            $('.kartu_keluarga_validation').val("success");
        });
    }
}


var dokumenFotoKTPPasangan =  Dropzone.options.dokumenFotoKTPPasangan = {
    autoProcessQueue: true,
    url:  '/user/pengajuan/upload_dokumen_saya/ktp_pasangan',
    addRemoveLinks: true,
    uploadMultiple: false,
    autoDiscover : false,
    headers: {
        'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
    },
    maxFilesize: 5,
    acceptedFiles: '.jpg, .jpeg, .png',
    maxFiles: 1,
    parallelUploads : 3,
    init: function () {

        var myDropzone = this;

        myDropzone.on("removedfile", function (file) {
            $('.foto_ktp_pasangan').val('');
        });


        $.ajax({
            url:  '/user/pengajuan/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "ktp_pasangan", tipe : "dokumen_saya"},
            dataType: 'json',
            success: function(response){
                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    $('.foto_ktp_pasangan').val(value.path);
                    myDropzone.emit("addedfile", mockFile);
                    myDropzone.emit("thumbnail", mockFile, value.path);
                    myDropzone.emit("complete", mockFile);

                });

            }
        });


        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $('#frmTarget').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
        });

        this.on("success", function() {
            $('.foto_ktp_pasangan').val("success");
            toastr.success('Berhasil Upload File');
        });
    }
}

var dokumenPasFotoPasangan =  Dropzone.options.dokumenPasFotoPasangan = {
    autoProcessQueue: true,
    url:  '/user/pengajuan/upload_dokumen_saya/pas_foto_pasangan',
    addRemoveLinks: true,
    uploadMultiple: false,
    autoDiscover : false,
    headers: {
        'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
    },
    maxFilesize: 5,
    acceptedFiles: '.jpg, .jpeg, .png',
    maxFiles: 1,
    parallelUploads : 3,
    init: function () {

        var myDropzone = this;

        myDropzone.on("removedfile", function (file) {
            $('#pas_foto_pasangan').val('');
        });


        $.ajax({
            url:  '/user/pengajuan/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "pas_foto_pasangan", tipe : "dokumen_saya"},
            dataType: 'json',
            success: function(response){
                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    $('#pas_foto_pasangan').val(value.path);

                    myDropzone.emit("addedfile", mockFile);
                    myDropzone.emit("thumbnail", mockFile, value.path);
                    myDropzone.emit("complete", mockFile);

                });

            }
        });


        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $('#frmTarget').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
        });

        this.on("success", function() {
            console.log('hello');
            $('#pas_foto_pasangan').val('success');
            toastr.success('Berhasil Upload File');
        });
    }
}


var dokumenFotoBukuNikah =  Dropzone.options.dokumenFotoBukuNikah = {
    autoProcessQueue: true,
    url:  '/user/pengajuan/upload_dokumen_saya/buku_nikah',
    addRemoveLinks: true,
    uploadMultiple: false,
    autoDiscover : false,
    headers: {
        'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
    },
    maxFilesize: 5,
    acceptedFiles: '.jpg, .jpeg, .png',
    maxFiles: 1,
    parallelUploads : 3,
    init: function () {

        var myDropzone = this;


        $.ajax({
            url:  '/user/pengajuan/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "buku_nikah", tipe : "dokumen_saya"},
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


        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $('#frmTarget').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
        });

        this.on("success", function() {
            toastr.success('Berhasil Upload File');
        });
    }
}


var dokumenFotoBukuTabungan =  Dropzone.options.dokumenFotoBukuTabungan = {
    autoProcessQueue: true,
    url:  '/user/pengajuan/upload_dokumen_saya/buku_tabungan',
    addRemoveLinks: true,
    uploadMultiple: false,
    autoDiscover : false,
    headers: {
        'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
    },
    maxFilesize: 5,
    acceptedFiles: '.jpg, .jpeg, .png',
    maxFiles: 1,
    parallelUploads : 3,
    init: function () {

        var myDropzone = this;


        $.ajax({
            url:  '/user/pengajuan/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "buku_tabungan", tipe : "dokumen_saya"},
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

        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $('#frmTarget').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
        });

        this.on("success", function() {
            toastr.success('Berhasil Upload File');
        });
    }
}

var dokumenJaminanSHM =  Dropzone.options.dokumenJaminanSHM = {
    autoProcessQueue: true,
    url:  '/user/pengajuan/upload_dokumen_saya/jaminan_shm',
    addRemoveLinks: true,
    uploadMultiple: false,
    autoDiscover : false,
    headers: {
        'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
    },
    maxFilesize: 5,
    acceptedFiles: '.jpg, .jpeg, .png',
    maxFiles: 1,
    parallelUploads : 3,
    init: function () {

        var myDropzone = this;
        myDropzone.on("removedfile", function (file) {
            $('.jaminanSHM_validation').val('');
        });


        $.ajax({
            url:  '/user/pengajuan/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "jaminan_shm", tipe : "dokumen_saya"},
            dataType: 'json',
            success: function(response){
                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    $('.jaminanSHM_validation').val(value.path);
                    myDropzone.emit("addedfile", mockFile);
                    myDropzone.emit("thumbnail", mockFile, value.path);
                    myDropzone.emit("complete", mockFile);

                });

            }
        });



        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $('#frmTarget').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
        });

        this.on("success", function() {
            toastr.success('Berhasil Upload File');
            $('.jaminanSHM_validation').val('success');
        });
    }
}

var dokumenSPT =  Dropzone.options.dokumenSPT = {
    autoProcessQueue: true,
    url:  '/user/pengajuan/upload_dokumen_saya/dokumen_spt',
    addRemoveLinks: true,
    uploadMultiple: false,
    autoDiscover : false,
    headers: {
        'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
    },
    maxFilesize: 5,
    acceptedFiles: '.jpg, .jpeg, .png',
    maxFiles: 1,
    parallelUploads : 1,
    init: function () {

        var myDropzone = this;

        myDropzone.on("removedfile", function (file) {
            $('.SPT_validation').val('');
        });


        $.ajax({
            url:  '/user/pengajuan/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "dokumen_spt", tipe : "dokumen_saya"},
            dataType: 'json',
            success: function(response){
                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    $('.SPT_validation').val(value.path);
                    myDropzone.emit("addedfile", mockFile);
                    myDropzone.emit("thumbnail", mockFile, value.path);
                    myDropzone.emit("complete", mockFile);

                });

            }
        });

        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $('#frmTarget').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
        });

        this.on("success", function() {
            $('.SPT_validation').val('success');
            toastr.success('Berhasil Upload File');

        });


    }
}


