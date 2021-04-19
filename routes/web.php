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





Route::middleware([ 'auth'])->group(function () {

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

});


Route::get('/user/pengajuan', function () {
    return view('user.pengajuan');
});





Route::get('/user/tentang_kami', function () {
    return view('user.tentang_kami');
});

Route::get('/user/daftar_pengajuan', function () {
    return view('user.daftar_pengajuan');
});








Route::get('/user', 'UserController@index');
Route::get('/user/edit/{id}', 'UserController@edit');
Route::post('/user/update/{id}', 'UserController@update');
Route::get('/user/delete/{id}', 'UserController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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