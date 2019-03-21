<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NilaiController extends Controller
{
   public function index(){
		if(\Session::get('logged_in')){}else
		{
			return redirect('/')->with(['alert' => 'Akses ditolak']);
		}
		$data['active'] = 'nilai_siswa';
		$data['judul'] = 'Nilai Siswa | M - STASYS';
		return view('admin.dashboard', $data);
	}
}
