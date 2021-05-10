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
