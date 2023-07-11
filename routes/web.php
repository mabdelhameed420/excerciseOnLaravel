<?php

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'Event'], function () {
    Route::get('video', 'EventController@getcount');
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::group(['prefix' => 'offer', 'namespace' => 'Offers'], function () {
        Route::post('create', 'OfferController@create')->name('offer.create');
        Route::get('all', 'OfferController@getall')->name('offer.all');
        Route::post('store', 'OfferController@store')->name('offer.store');
        Route::get('edit/{offer_id}', 'OfferController@edit')->name('offer.edit');
        Route::post('update/{offer_id}', 'OfferController@update')->name('offer.update');
        Route::get('delete/{offer_id}', 'OfferController@delete')->name('offer.delete');
    });
});

################ begin of ajax ###########################
Route::group(['prefix' => 'ajax/offer', 'namespace' => 'Offers'], function () {
    Route::match(['get', 'post'], 'create', 'OfferController@ajaxCreate')->name('ajax.create');
    Route::post('store', 'OfferController@ajaxStore')->name('ajax.store');
    Route::get('all', 'OfferController@all')->name('ajax.all');
    Route::post('delete', 'OfferController@ajaxDelete')->name('ajax.delete');
    Route::get('edit/{offer_id}', 'OfferController@edit')->name('ajax.edit');
    Route::post('update', 'OfferController@update')->name('ajax.update');
});
################ end of ajax ###########################

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
