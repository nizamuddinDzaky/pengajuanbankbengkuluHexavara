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




$('#template_blangko_tab').on('click', function(){
    $('#template_blangko_link').addClass('tab-bar-konfirmasi-active')
    $('#template_blangko_link').removeClass('tab-bar-konfirmasi-inactive');
    $('#blangko_nasabah_link').addClass('tab-bar-konfirmasi-inactive')
    $('#blangko_nasabah_link').removeClass('tab-bar-konfirmasi-active');
    $('#buttonCetakBlangko').show();

});


$('#blangko_nasabah_tab').on('click', function(){
    $('#template_blangko_link').addClass('tab-bar-konfirmasi-inactive')
    $('#template_blangko_link').removeClass('tab-bar-konfirmasi-active');
    $('#blangko_nasabah_link').addClass('tab-bar-konfirmasi-active')
    $('#blangko_nasabah_link').removeClass('tab-bar-konfirmasi-inactive');
    $('#buttonCetakBlangko').hide();
});
