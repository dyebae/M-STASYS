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
Route::Resource('data-kelas', 'KelasController');
Route::Resource('data-siswa', 'SiswaController');
//Admin
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/data_siswa', 'SiswaController@index')->name('data_siswa');
Route::get('/data_siswa/add', 'SiswaController@add')->name('add_data_siswa');
Route::get('/data_siswa/update/{nis}', 'SiswaController@update_view')->name('update_data_siswa');
Route::get('/data_siswa/view/{nis}', 'SiswaController@view')->name('view_data_siswa');
Route::get('/data_guru', 'GuruController@index')->name('data_guru');
Route::get('/data_kelas', 'KelasController@index')->name('data_kelas');
Route::get('/ampu_mapel', 'AmpuMapelController@index')->name('ampu_mapel');
Route::get('/mapel', 'MapelController@index')->name('mapel');
Route::get('/kategori_mapel', 'KategoriMapelController@index')->name('kategori_mapel');
Route::get('/nilai_siswa', 'NilaiController@index')->name('nilai_siswa');
Route::get('/semester', 'SemesterController@index')->name('semester');

Route::get('/', 'LoginController@index')->name('login');
Route::get('/profile', 'LoginController@profile')->name('profile');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::post('/login_procces', 'LoginController@process')->name('login_procces');


//API GURU
Route::post('/apiLoginGuru', 'GuruController@apiLogin');
Route::get('/apiDataGuru/{nip}', 'GuruController@apiAllData');

//API SISWA
Route::post('/apiLoginSiswa', 'SiswaController@apiLogin');
