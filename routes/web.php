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
use App\Http\Controllers\WhmController;
Route::get('/', function () {
    return view('welcome');
});
Route::resource('whmcs','App\Http\Controllers\WhmController::class');
Route::get('agreement/{id}','App\Http\Controllers\HomeController@getAgreement');
Route::get('client-register/{id}','App\Http\Controllers\HomeController@clientRegister');

Route::get('email',function(){
    $data = \Whmcs::GetInvoice([
        'invoiceid' => '1303'
    ]);
    return $data;
});
Route::get('invoices',[WhmController::class,'getInvoices']);
Auth::routes();
Route::get('client-register',function(){
    return view('register');
});
Route::post('clients','App\Http\Controllers\HomeController@storeSkp');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/paper',function(){
    return view('pdfaja');
});
Route::get('/cari', 'App\Http\Controllers\HomeController@loadData');
Route::post('store','App\Http\Controllers\HomeController@readWord');
Route::get('create',function(){
    return view('create');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
