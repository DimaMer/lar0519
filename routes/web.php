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
Route::get('/', 'VacanciesController@index');
Route::resource('show', 'VacanciesController');



Route::get('api/search', [
    'uses' => 'Api\SearchController@search'
]);

//Route::resource('temp', 'temp');

