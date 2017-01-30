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


Route::get('/',[
    'uses' => 'BarangController@getListBarang',
    'as' => 'barang'
]);

Route::group(['prefix' => 'barang'], function (){
    Route::post('/add',[
        'uses' => 'BarangController@addBarang',
        'as' => 'tambah_barang'
    ]);
    Route::post('/edit/{id}',[
        'uses' => 'BarangController@editBarang',
        'as' => 'edit_barang'
    ]);
    Route::get('/delete/{id}',[
        'uses' => 'BarangController@deleteBarang',
        'as' => 'delete_barang'
    ]);
});
Route::group(['prefix' => 'gudang'], function (){
    Route::get('/',[
        'uses' => 'GudangController@getListGudang',
        'as' => 'gudang'
    ]);
    Route::post('/add',[
        'uses' => 'GudangController@addGudang',
        'as' => 'tambah_gudang'
    ]);
    Route::post('/edit/{id}',[
        'uses' => 'GudangController@editGudang',
        'as' => 'edit_barang'
    ]);
    Route::get('/delete/{id}',[
        'uses' => 'GudangController@deleteGudang',
        'as' => 'delete_barang'
    ]);
});
Route::group(['prefix' => 'transaksi'], function (){
    Route::get('/',[
        'uses' => 'TransaksiController@fetchGudangAndBarang',
        'as' => 'transaksi'
    ]);
    Route::get('/unit/{id}',[
        'uses' => 'TransaksiController@getUnit',
        'as' => 'unit'
    ]);
    Route::post('/temp',[
        'uses' => 'TransaksiController@insertTemp',
        'as' => 'temp'
    ]);
    Route::post('/save',[
        'uses' => 'TransaksiController@saveTransaksi',
        'as' => 'save'
    ]);
    Route::get('/delete/{id}',[
        'uses' => 'BarangController@deleteBarang',
        'as' => 'delete_barang'
    ]);
});