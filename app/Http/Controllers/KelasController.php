<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index(){
		if(\Session::get('logged_in')){}else
		{
			return redirect('/')->with(['alert' => 'Akses ditolak']);
		}
		$data['active'] = 'data_kelas';
		$data['kelas'] = \App\Kelas::all();
		$data['judul'] = 'Data Kelas | M - STASYS';
		return view('admin.datakelas', $data);
	}
}
