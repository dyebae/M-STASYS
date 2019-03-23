<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index(){
		if(\Session::get('logged_in')){}else
		{
			return redirect('/')->with(['alert' => 'Akses ditolak']);
		}
		$data['semester'] = \App\Semester::all();
		$data['active'] = 'semester';
		$data['judul'] = 'Data Semester';
		return view('admin.semester', $data);
	}
}
