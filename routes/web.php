<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;

Route::get('/','HomeController@index');





Route::middleware(['auth'])->group(function () {

    //biodata
    Route::get('/user/biodata', 'BiodataController@biodata');
    Route::post('/user/biodata/update', 'BiodataController@updateBiodata');
    Route::post('/user/biodata/getkecamatan', 'BiodataController@getKecamatan');
    Route::post('/user/biodata/getkelurahan', 'BiodataController@getKelurahan');
    Route::post('/user/biodata/getkodepos', 'BiodataController@getKodePos');

    //dokumen_saya
    Route::get('/user/dokumen', 'BiodataController@dokumenSaya');
    Route::post('/user/dokumen/uploadnpwp', 'BiodataController@uploadNPWP')->name('dokumen.uploadnpwp');
    Route::post('/user/dokumen/uploadpasfoto', 'BiodataController@uploadPasFoto')->name('dokumen.uploadpasfoto');
    Route::post('/user/dokumen/uploadktp', 'BiodataController@uploadKTP')->name('dokumen.uploadktp');
    Route::post('/user/dokumen/getthumbnail', 'BiodataController@getThumbnail')->name('dokumen.getthumbnail');



    //ubah kata sandi
    Route::get('/user/ubah_katasandi', function () {
        return view('user.ubah_kata_sandi');
    });
    Route::post('/user/ubah_katasandi/update', 'BiodataController@updateKataSandi');


    //pengajuan pinjaman
    Route::get('/user/pengajuan', 'PengajuanController@index');
    Route::post('/user/pengajuan/insertformulir', 'PengajuanController@insertFormulirPengajuan');
    Route::post('/user/pengajuan/insertbiodatadiri', 'PengajuanController@insertBiodataDiri');
    Route::post('/user/pengajuan/insertnoshm', 'PengajuanController@insertNoSHM');
    Route::post('/user/pengajuan/insertnoSK', 'PengajuanController@insertNoSK');
    Route::post('/user/pengajuan/inserttahapakhir', 'PengajuanController@insertTahapAkhir');
    Route::post('/user/pengajuan/getsukubunga', 'PengajuanController@getSukuBunga')->name('user.getsukubunga');
    Route::post('/user/pengajuan/getjumlahangsuran', 'PengajuanController@getJumlahAngsuran')->name('user.getjumlahangsuran');
    Route::post('/user/pengajuan/getplafond', 'PengajuanController@getPlafond')->name('user.getplafond');
    Route::post('/user/pengajuan/getjenisproduk', 'PengajuanController@getJenisProduk')->name('user.getjenisproduk');
    Route::post('/user/pengajuan/getnamaproduk', 'PengajuanController@getNamaProduk')->name('user.getnamaproduk');
    Route::post('/user/pengajuan/getstatuskawin', 'PengajuanController@getStatusKawin')->name('user.getstatuskawin');
    Route::post('/user/pengajuan/getstatusjaminan', 'PengajuanController@getStatusJaminan')->name('user.getstatusjaminan');
    Route::post('/user/pengajuan/konfirmasipengajuan', 'PengajuanController@konfirmasiPengajuan')->name('user.konfirmasi_pengajuan');

    //pengajuan pinjaman tahap akhir
    Route::post('/user/pengajuan/getcustomerservice', 'PengajuanController@getCustomerService');
    Route::post('/user/pengajuan/getslotwaktu', 'PengajuanController@getSlotWaktu');


    //upload dokumen pengajuan
    Route::post('/user/pengajuan/upload_dokumen_saya/{jenis}', 'PengajuanController@uploadDokumenSaya');
    Route::post('/user/pengajuan/upload_dokumen_kredit/{jenis}', 'PengajuanController@uploadDokumenKredit');
    Route::post('/user/pengajuan/getthumbnail', 'PengajuanController@getThumbnail');


    //daftar pengajuan
    Route::get('/user/daftar_pengajuan', 'DaftarPengajuanController@index');
    Route::post('/user/daftar_pengajuan/jadwalkan_ulang_pengajuan', 'DaftarPengajuanController@jadwalkanUlang')->name('user.jadwalkan_ulang_pengajuan');
    Route::post('/user/daftar_pengajuan/batalkan_pengajuan', 'DaftarPengajuanController@batalkanPengajuan')->name('user.batalkan_pengajuan');
    Route::post('/user/daftar_pengajuan/get_detail_transaksi', 'DaftarPengajuanController@getDetailTransaksi')->name('user.get_detail_transaksi');

    // generate blangko
    Route::post('user/blangko/download_blangko', 'DokumenController@generateBlangko')->name('user.download_blangko');
    Route::post('user/blangko/unggah_blangko/{id}', 'DokumenController@unggahBlangko');
    Route::post('user/blangko/getthumbnail', 'DokumenController@getThumbnailBlangko');
    Route::post('user/blangko/getblangkostatus', 'DokumenController@getBlangkoStatus')->name('user.get_blangko_status');


});







Route::get('/user/tentang_kami', function () {
    return view('user.tentang_kami');
});









Route::get('/user', 'UserController@index');
Route::get('/user/edit/{id}', 'UserController@edit');
Route::post('/user/update/{id}', 'UserController@update');
Route::get('/user/delete/{id}', 'UserController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['role'])->group(function() {

    // group admin-pusat
    Route::group(['prefix' => 'admin-pusat'], function() {
        Route::middleware(['auth_admin_pusat', 'auth'])->group(function() {
            Route::get('/', 'AdminController@dashboard')->name('admin.pusat.index');
            Route::get('/list_cabang', 'AdminController@list_cabang')->name('admin.pusat.cabang');
            Route::get('/detail_kantor/{id_kantor}', 'AdminController@detail_kantor')->name('admin.pusat.detail.kantor');
            Route::get('/delete_kantor/{id_kantor}/{next_status}', 'AdminController@edit_status_kantor')->name('admin.pusat.delete.kantor');
            Route::get('/form_add_kantor/{id_parent}', 'AdminController@form_add_kantor')->name('admin.pusat.form.add.cabang');
            Route::post('/save_new_kantor', 'AdminController@add_cabang')->name('admin.pusat.add.cabang');
            Route::post('/save_edit_kantor', 'AdminController@edit_cabang')->name('admin.pusat.edit.cabang');
            Route::post('/save_account_kantor', 'AdminController@edit_account_cabang')->name('admin.pusat.edit.account.cabang');
            Route::post('/save_cs', 'AdminController@add_cs')->name('admin.pusat.add.teller');
            Route::get('/edit_status_cs/{id_cs}/{next_status}', 'AdminController@edit_status_cs')->name('admin.pusat.edit.status.cs');
            Route::get('/reset_password/{id_account}', 'AdminController@reset_password')->name('admin.pusat.edit.reset.password');
            Route::post('/save_edit_cs', 'AdminController@edit_cs')->name('admin.pusat.edit.cs');
            Route::get('/pengelolaan_nasabah','PengelolaanNasabahController@indexAdminPusat')->name('admin.pusat.pengelolaan_nasabah');
            Route::post('/pengelolaan_nasabah/delete','PengelolaanNasabahController@delete')->name('admin.pusat.delete_nasabah');
            Route::get('/report','ReportController@indexAdminPusat')->name('admin.pusat.report');
            Route::get('/produk_kredit','ProdukKreditController@index')->name('admin.pusat.produk_kredit');
            Route::post('/produk_kredit/store','ProdukKreditController@store')->name('admin.pusat.tambah.produk_kredit');
            Route::post('/produk_kredit/update','ProdukKreditController@update')->name('admin.pusat.edit.produk_kredit');
            Route::post('/produk_kredit/get_detail','ProdukKreditController@getDetail')->name('admin.pusat.detail.produk_kredit');
            Route::post('/produk_kredit/upload_blangko/{jenis}','ProdukKreditController@uploadBlangko')->name('admin.pusat.upload.blangko');
            Route::post('/produk_kredit/get_thumbnail','ProdukKreditController@getThumbnailBlangko')->name('admin.pusat.thumbnail.blangko');
        });
    });


// group admin cabang
    Route::group(['prefix' => 'admin-cabang'], function() {
        Route::middleware(['auth_admin_cabang', 'auth'])->group(function() {
            Route::get('/', 'AdminController@dashboard')->name('admin.cabang.index');
            Route::get('/list_cabang', 'AdminController@list_cabang')->name('admin.cabang.cabang');
            Route::get('/form_add_kantor/{id_parent}', 'AdminController@form_add_kantor')->name('admin.cabang.form.add.cabang');
            Route::get('/detail_kantor/{id_kantor}', 'AdminController@detail_kantor')->name('admin.cabang.detail.kantor');
            Route::post('/save_new_kantor', 'AdminController@add_cabang')->name('admin.cabang.add.cabang');
            Route::get('/delete_kantor/{id_kantor}/{next_status}', 'AdminController@edit_status_kantor')->name('admin.cabang.delete.kantor');
            Route::post('/save_edit_kantor', 'AdminController@edit_cabang')->name('admin.cabang.edit.cabang');
            Route::post('/save_account_kantor', 'AdminController@edit_account_cabang')->name('admin.cabang.edit.account.cabang');
            Route::post('/save_cs', 'AdminController@add_cs')->name('admin.cabang.add.teller');
            Route::get('/edit_status_cs/{id_cs}/{next_status}', 'AdminController@edit_status_cs')->name('admin.cabang.edit.status.cs');
            Route::get('/reset_password/{id_account}', 'AdminController@reset_password')->name('admin.cabang.edit.reset.password');
            Route::post('/save_edit_cs', 'AdminController@edit_cs')->name('admin.cabang.edit.cs');
            // Route::post('/save_new_kantor', 'AdminPusatController@add_kantor')->name('admin.pusat.add.kantor.post');
        });
    });

// customer service
    Route::group(['prefix' => 'customer-service'], function() {
        Route::middleware(['auth_customer_service', 'auth'])->group(function() {
            Route::get('/', 'CustomerServiceController@jadwal')->name('customer_service.jadwal');
            Route::get('/pelayanan_nasabah', 'CustomerServiceController@pelayanan_nasabah')->name('customer_service.pelayanan_nasabah');
            Route::post('/pelayanan_nasabah/selesai', 'CustomerServiceController@selesai_pelayanan')->name('customer_service.selesai_pelayanan');
            Route::post('/pelayanan_nasabah/mulai', 'CustomerServiceController@mulai_pelayanan')->name('customer_service.mulai_pelayanan');
            Route::post('/pelayanan_nasabah/getJenisDokumen', 'CustomerServiceController@get_jenis_dokumen')->name('customer_service.get_jenis_dokumen');

        });
    });

});








