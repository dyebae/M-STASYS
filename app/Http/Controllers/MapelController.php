<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapelController extends Controller
{
	public function index(){
    if(\Session::get('logged_in')){}else
		{
			return redirect('/')->with(['alert' => 'Akses ditolak']);
		}
		$data['active'] = 'mapel';
		$data['judul'] = 'Mata Pelajaran | M - STASYS';
		return view('admin.dashboard', $data);
	}
}
