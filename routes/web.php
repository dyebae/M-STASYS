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
Route::Resource('data-guru', 'GuruController');
Route::Resource('data-mapel', 'MapelController');
Route::Resource('data-ktmapel', 'KategoriMapelController');

//Admin
Route::get('/dashboard', ['middleware'=>'cek-sesi-admin', 'uses'=>'DashboardController@index'])->name('dashboard');

Route::get('/data_siswa', ['middleware'=>'cek-sesi-admin', 'uses'=>'SiswaController@index'])->name('data_siswa');
Route::get('/view_import_data_siswa', ['middleware'=>'cek-sesi-admin', 'uses'=>'SiswaController@view_import_data_siswa'])->name('view_import_data_siswa');
Route::get('/data_siswa/add', ['middleware'=>'cek-sesi-admin', 'uses'=>'SiswaController@add'])->name('add_data_siswa');
Route::get('/data_siswa/update/{nis}', ['middleware'=>'cek-sesi-admin', 'uses'=>'SiswaController@update_view'])->name('update_data_siswa');
Route::get('/data_siswa/view/{nis}', ['middleware'=>'cek-sesi-admin', 'uses'=>'SiswaController@view'])->name('view_data_siswa');
Route::get('/siswa_from_class', ['middleware'=>'cek-sesi-admin', 'uses'=>'SiswaController@siswa_from_class']);

Route::get('/data_guru', ['middleware'=>'cek-sesi-admin', 'uses'=>'GuruController@index'])->name('data_guru');
Route::post('/ajax-get', 'GuruController@ajax_get');
Route::get('/view_import_data_guru', ['middleware'=>'cek-sesi-admin', 'uses'=>'GuruController@view_import_data_guru'])->name('import-data-guru');

Route::get('/data_kelas', ['middleware'=>'cek-sesi-admin', 'uses'=>'KelasController@index'])->name('data_kelas');
Route::get('/ampu_mapel', ['middleware'=>'cek-sesi-admin', 'uses'=>'AmpuMapelController@index'])->name('ampu_mapel');
Route::get('/mapel', ['middleware'=>'cek-sesi-admin', 'uses'=>'MapelController@index'])->name('mapel');
Route::get('/kategori_mapel', ['middleware'=>'cek-sesi-admin', 'uses'=>'KategoriMapelController@index'])->name('kategori_mapel');
Route::get('/nilai_siswa', ['middleware'=>'cek-sesi-admin', 'uses'=>'NilaiController@index'])->name('nilai_siswa');
Route::get('/semester', ['middleware'=>'cek-sesi-admin', 'uses'=>'SemesterController@index'])->name('semester');

Route::get('/', 'LoginController@index')->name('login');
Route::get('/profile', 'LoginController@profile')->name('profile');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::post('/login_procces', 'LoginController@process')->name('login_procces');
Route::post('/unlock', 'LoginController@unlock');

//ImportExport
Route::post('/import-siswa', 'ImportExport@import_siswa');
Route::post('/import-guru', 'ImportExport@import_guru');

//API GURU
Route::post('/apiLoginGuru', 'GuruController@apiLogin');
Route::get('/apiDataGuru/{nip}', 'GuruController@apiAllData');
Route::post('/apiAmpuMapel', 'AmpuMapelController@apiAmpuMapel');

//API SISWA
Route::post('/apiLoginSiswa', 'SiswaController@apiLogin');
Route::get('/apiDataSiswa/{nis}', 'SiswaController@apiAllData');
Route::post('/apiGetSiswa', 'SiswaController@apiGetSiswa');

//API SEMESTER
// Route::get('/apiSemester', 'SemesterController@apiSemester');
Route::post('/apiSemesterGuru', 'SemesterController@apiSemesterGuru');
Route::post('/apiSemesterSiswa', 'SemesterController@apiSemesterSiswa');

//API KELAS
Route::post('/apiKelasGuru', 'KelasController@apiKelasGuru');

//API MAPEL
Route::post('/apiMapelGuru', 'MapelController@apiMapelGuru');
Route::post('/apiSiswaMapel', 'MapelController@apiSiswaMapel');
Route::post('/apiGetKategoriMapel', 'MapelController@apiGetKategoriMapel');

//API NILAI SISWA
Route::post('/apiNilaiSiswa', 'NilaiController@apiNilaiSiswa');
Route::post('/apiLihatNilai', 'NilaiController@apiLihatNilai');
Route::get('/apiJenisNilai', 'NilaiController@apiJenisNilai');
Route::post('/apiTambahNilai', 'NilaiController@apiTambahNilai');
Route::post('/apiUbahNilai', 'NilaiController@apiUbahNilai');
Route::post('/apiHapusNilai', 'NilaiController@apiHapusNilai');
// Route::post('/apiRanking', 'NilaiController@apiRanking');


//API SOAL GURU
Route::post('/apiSoal', 'SoalController@apiSoal');
Route::post('/apiGetSoal', 'SoalController@apiGetSoal');
Route::post('/apiHapusSoal', 'SoalController@apiHapusSoal');
Route::post('/apiLihatSoal', 'SoalController@apiLihatSoal');
Route::post('/apiSoalSiswa', 'SoalController@apiSoalSiswa');
Route::post('/apiAktifSoal', 'SoalController@apiAktifSoal');

//API SOAL SISWA
Route::post('/apiSiswaSoal', 'SoalController@apiSiswaSoal');
Route::post('/apiHasilSoal', 'SoalController@apiHasilSoal');
Route::post('/apiInsertHasil', 'SoalController@apiInsertHasil');
Route::post('/apiRanking', 'SoalController@apiRanking');
