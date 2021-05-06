var dokumenScanGajiLegalisir =  Dropzone.options.dokumenScanGajiLegalisir = {
    autoProcessQueue: true,
    url:  '/user/pengajuan/upload_dokumen_kredit/gaji_terakhir',
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
            $('.gaji_terakhir').val('');
        });


        $.ajax({
            url:  '/user/pengajuan/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "gaji_terakhir", tipe: "dokumen_kredit"},
            dataType: 'json',
            success: function(response){
                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    $('.gaji_terakhir').val(value.path);
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
            location.reload();
        });
    }
}


var dokumenScanStrukGaji =  Dropzone.options.dokumenScanStrukGaji = {
    autoProcessQueue: true,
    url:  '/user/pengajuan/upload_dokumen_kredit/struk_gaji_bulan_terakhir',
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
            $('.struk_gaji_bulan_terakhir').val('');
        });


        $.ajax({
            url:  '/user/pengajuan/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "struk_gaji_bulan_terakhir", tipe: "dokumen_kredit"},
            dataType: 'json',
            success: function(response){
                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    $('.struk_gaji_bulan_terakhir').val(value.path);
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
            location.reload();
        });
    }
}


var dokumenSKCAPEG =  Dropzone.options.dokumenSKCAPEG = {
    autoProcessQueue: true,
    url:  '/user/pengajuan/upload_dokumen_kredit/SK_CAPEG',
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
            $('.SK_CAPEG').val('');
        });


        $.ajax({
            url:  '/user/pengajuan/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "SK_CAPEG", tipe: "dokumen_kredit"},
            dataType: 'json',
            success: function(response){
                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    $('.SK_CAPEG').val(value.path);
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
            location.reload();
        });
    }
}

var dokumenSKPegawaiTetap =  Dropzone.options.dokumenSKPegawaiTetap = {
    autoProcessQueue: true,
    url:  '/user/pengajuan/upload_dokumen_kredit/SK_pegawai_tetap',
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
            $('.SK_pegawai_tetap').val('');
        });


        $.ajax({
            url:  '/user/pengajuan/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "SK_pegawai_tetap", tipe: "dokumen_kredit"},
            dataType: 'json',
            success: function(response){
                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    $('.SK_pegawai_tetap').val(value.path);
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
            location.reload();
        });
    }
}

var dokumenSKPangkatTerakhir =  Dropzone.options.dokumenSKPangkatTerakhir = {
    autoProcessQueue: true,
    url:  '/user/pengajuan/upload_dokumen_kredit/SK_pangkat_terakhir',
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
            $('.SK_pangkat_terakhir').val('');
        });


        $.ajax({
            url:  '/user/pengajuan/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "SK_pangkat_terakhir", tipe: "dokumen_kredit"},
            dataType: 'json',
            success: function(response){
                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    $('.SK_pangkat_terakhir').val(value.path);
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
            location.reload();
        });
    }
}

var dokumenSKBerkalaTerakhir =  Dropzone.options.dokumenSKBerkalaTerakhir = {
    autoProcessQueue: true,
    url:  '/user/pengajuan/upload_dokumen_kredit/SK_berkala_terakhir',
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
            $('.SK_berkala_terakhir').val('');
        });


        $.ajax({
            url:  '/user/pengajuan/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "SK_berkala_terakhir", tipe: "dokumen_kredit"},
            dataType: 'json',
            success: function(response){
                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    $('.SK_berkala_terakhir').val(value.path);
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
            location.reload();
        });
    }
}

var dokumenKartuPegawai =  Dropzone.options.dokumenKartuPegawai = {
    autoProcessQueue: true,
    url:  '/user/pengajuan/upload_dokumen_kredit/kartu_pegawai',
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
            $('.kartu_pegawai').val('');
        });


        $.ajax({
            url:  '/user/pengajuan/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "kartu_pegawai", tipe: "dokumen_kredit"},
            dataType: 'json',
            success: function(response){
                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    $('.kartu_pegawai').val(value.path);
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
            location.reload();
        });
    }
}


var dokumenKartuTASPEN =  Dropzone.options.dokumenKartuTASPEN = {
    autoProcessQueue: true,
    url:  '/user/pengajuan/upload_dokumen_kredit/kartu_taspen',
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
            $('.kartu_taspen').val('');
        });


        $.ajax({
            url:  '/user/pengajuan/getthumbnail',
            type: 'post',
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            data: {data: "kartu_taspen", tipe: "dokumen_kredit"},
            dataType: 'json',
            success: function(response){
                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    $('.kartu_taspen').val(value.path);
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
            location.reload();
        });
    }
}











