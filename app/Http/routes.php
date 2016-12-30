<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/test', function () {
    $governorate=\App\Governorate::find(1);
    $file=$governorate->photos()->first()->path;
    $exists = Storage::disk('local')->has($file);
    dd($exists);
});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::resource('governorates','GovernoratesController');
    Route::resource('cities','CitiesController');
    Route::resource('divisions','DivisionsController');
    Route::resource('units','UnitsController');
    Route::resource('photos','PhotosController',['except'=>['edit','show']]);
    Route::resource('centers','CentersController');
    Route::resource('services','ServicesController');
    Route::resource('places','PlacesController');
    Route::resource('persons','PersonsController');
    Route::resource('articles','ArticlesController');
    Route::get('ajaxcities','CitiesController@ajaxcities');
    Route::get('ajaxdivisions','DivisionsController@ajaxdivisions');
    Route::match(['post','get'],'ajax_upload','PhotosController@ajax_upload');
    Route::get('ajax_index','PhotosController@ajax_index');
    Route::post('ajax_delete','PhotosController@ajax_delete');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'MapController@index');
});
