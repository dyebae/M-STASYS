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
		$data['mapel'] = \App\Mapel::all();
		$data['active'] = 'mapel';
		$data['judul'] = 'Mata Pelajaran | M - STASYS';
		return view('admin.datamapel', $data);
	}
}
