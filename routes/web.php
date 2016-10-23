<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/how-it-works', function () {
    return view('howitworks');
})->name('how_it_works');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('performer/{uuid}', 'PerformerController@show')->name('performer_profile_get');

Route::post('performer',
    ['as' => 'pay_performer', 'uses' => 'PerformerController@pay']);

Route::get('/qrcode', 'PerformerQrCodeController@index');