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

Route::get('/', function () {
    return view('dashboard');
});





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
