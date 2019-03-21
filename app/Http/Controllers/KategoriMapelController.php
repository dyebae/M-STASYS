<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriMapelController extends Controller
{
	public function index(){
		if(\Session::get('logged_in')){}else
			{
				return redirect('/')->with(['alert' => 'Akses ditolak']);
			}
		$data['active'] = 'kategori_mapel';
		$data['judul'] = 'Kategori Mata Pelajaran | M - STASYS';
		return view('admin.dashboard', $data);
	}
}
