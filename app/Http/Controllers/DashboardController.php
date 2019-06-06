<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function index(){
		$data['sumSiswa'] = \App\Siswa::count();
		$data['sumGuru'] = \App\Guru::count();
		$data['sumKelas'] = \App\Kelas::count();
		$data['sumMapel'] = \App\Mapel::count();
		$data['active'] = '';
		$data['judul'] = 'Dashboard';
		return view('admin.dashboard', $data);
    }
}
