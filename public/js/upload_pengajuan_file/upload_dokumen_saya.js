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
                    $('#ktp_validation').val(value.path);

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
                    $('#pas_foto_validation').val(value.path);
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
                    $('#npwp_validation').val(value.path);
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


        $.ajax({
            url:  '/user/pengajuan/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "kartu_keluarga"},
            dataType: 'json',
            success: function(response){
                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    $('#kartu_keluarga_validation').val(value.path);
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


        $.ajax({
            url:  '/user/pengajuan/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "ktp_pasangan"},
            dataType: 'json',
            success: function(response){
                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    $('#foto_ktp_pasangan').val(value.path);
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


        $.ajax({
            url:  '/user/pengajuan/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "pas_foto_pasangan"},
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
            data: {data: "buku_nikah"},
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
            data: {data: "buku_tabungan"},
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


        $.ajax({
            url:  '/user/pengajuan/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "jaminan_shm"},
            dataType: 'json',
            success: function(response){
                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    $('#jaminanSHM_validation').val(value.path);
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
    parallelUploads : 3,
    init: function () {

        var myDropzone = this;


        $.ajax({
            url:  '/user/pengajuan/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "dokumen_spt"},
            dataType: 'json',
            success: function(response){
                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    $('#SPT_validation').val(value.path);
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


