<?php

use Illuminate\Support\Facades\Route;

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

Route::controller(DasboardController::class)->group(function(){
    Route::get('/','index')->name('dasboard');
});

Route::controller(ManualController::class)->group(function(){
    Route::get('/manual','index')->name('manual');
});

Route::controller(ProfileController::class)->group(function(){
    Route::get('/profile/edit/{id}','edit')->name('profile_edit');
    Route::post('/profile/update','update')->name('profile_update');
});

Route::controller(TrackingController::class)->group(function(){
    Route::get('/tracking','index')->name('tracking');
});

Route::controller(LayananController::class)->group(function(){
    Route::get('/layanan','index')->name('layanan');
    Route::get('/layanan/form1','form_nama_sistem')->name('form_nama_sistem');
    Route::get('/layanan/form_permohonan/{id}','form_permohonan')->name('form_permohonan');
    Route::get('/layanan/form3/{id}','status_permohonan')->name('status_permohonan');
    Route::post('/layanan/makedraft','makedraft')->name('makedraft');
    Route::post('/layanan/simpanrekomendasi','simpan_rekomendasi')->name('simpan_rekomendasi');
    Route::post('/layanan/simpanattachment','simpan_attachment')->name('simpan_attachment');
    Route::get('/layanan/download{filename}','download')->name('downloadfile');
    Route::post('/layanan/deletefile','deletefile')->name('deletefile');
    Route::get('/layanan/print{id}','print')->name('print');

    Route::post('/layanan/simpanStatus','simpan_status')->name('simpan_status');
    Route::post('/layanan/simpanPoinRekomendasi','simpan_poin_rekomendasi')->name('simpan_poin_rekomendasi');
    Route::post('/layanan/deletepoin','deletepoin')->name('deletepoin');

    
});

Route::controller(UserController::class)->group(function(){
    Route::get('/user','index')->name('user');
    Route::get('/user/create','create')->name('user_create');
    Route::post('/user/store','store')->name('user_store');
    Route::get('/user/edit/{id}','edit')->name('user_edit');
    Route::get('/user/destroy/{id}','destroy')->name('user_destroy');
    Route::post('/user/update','update')->name('user_update');
});

