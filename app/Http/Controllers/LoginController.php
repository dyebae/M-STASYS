<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
	
    public function index(){
		if(\Session::get('logged_in')){
			return redirect('/dashboard');
		}
		return view('login');
    }
	
	public function process(Request $req){
		$auth = auth()->guard($req->level);
		$credentials = [
					'username' => $req->username, 
					'password' => $req->password,
				];
				
		if($auth->attempt($credentials)){
			$req->session()->put('logged_in', $req->level);
			return redirect('/dashboard')->with(['info' => 'Selamat Datang']);
		}else{
			return redirect('/')->with(['alert' => 'Username atau Password Salah']);
		}
	}
	
	public function logout(){
		\Session::forget('logged_in');
		return redirect('/')->with(['info' => 'Logout Berhasil']);
	}
	public function profile(){
		if(\Session::get('logged_in')){}else
		{
			return redirect('/')->with(['alert' => 'Akses ditolak']);
		}
		$data['active'] = 'profile';
		$data['judul'] = 'Profil | M - STASYS';
		return view('admin.dashboard', $data);
    }
}
