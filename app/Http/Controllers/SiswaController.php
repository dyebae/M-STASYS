<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(){
		if(\Session::get('logged_in')){}else
		{
			return redirect('/')->with(['alert' => 'Akses ditolak']);
		}
		$data['active'] = 'data_siswa';
		$data['siswa'] = \App\Siswa::all();
		$data['judul'] = 'Data Siswa | M - STASYS';
		$data['no'] = 0;
		//dd($data);
		return view('admin.datasiswa', $data);
	}
}
