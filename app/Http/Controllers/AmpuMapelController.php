<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AmpuMapelController extends Controller
{
    public function index(){
		if(\Session::get('logged_in')){}else
		{
			return redirect('/')->with(['alert' => 'Akses ditolak']);
		}
		$data['active'] = 'ampu_mapel';
		$data['judul'] = 'Ampu Mapel | M - STASYS';
		//return view('admin.dashboard', $data);
		print_r($data);
    }
}
