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

// Route::get('/', function () {
//     return view('welcome');
// });

//all
Route::get('/', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@login')->name('login_procces');

//Admin
Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
Route::get('/data_siswa', 'DashboardController@datasiswa')->name('data_siswa');
Route::get('/data_guru', 'DashboardController@dataguru')->name('data_guru');
Route::get('/data_kelas', 'DashboardController@datakelas')->name('data_kelas');

//API GURU
Route::post('/apiLoginGuru', 'GuruController@apiLogin');

//API SISWA
Route::post('/apiLoginSiswa', 'SiswaController@apiLogin');
