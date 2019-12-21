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
    return view('welcome');
});


Route::get('/firebase','FirebaseController@index')->name('firebase_index');
Route::get('/firebase','FirebaseController@setNodes')->name('firebase_set_nodes');
Route::get('/firebase','FirebaseController@pushNode')->name('firebase_push_node');
Route::get('/firebase','FirebaseController@updateNodeValue')->name('firebase_update_node_value');
Route::get('/firebase','FirebaseController@removeNode')->name('firebase_remove_node');