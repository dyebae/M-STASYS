<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function index(){
		switch(\Session::get('logged_in')[0]){
			case 'kepsek':
			case 'admin': return redirect('dashboard');break;
			case 'guru': return redirect('dashboard_guru');break;
			case 'siswa': return redirect('dashboard_siswa');break;
			default : return view('login');break;
		}
    }

	public function process(Request $req){
		$credentials = [
					'nip' => $req->username,
					'password' => $req->password,
				];
		if($req->level == 'admin')
			$credentials = [
						'username' => $req->username,
						'password' => $req->password,
					];
		elseif($req->level == 'siswa')
			$credentials = [
						'nis' => $req->username,
						'password' => $req->password,
					];
		
		$auth = auth()->guard($req->level);
		
		if($auth->attempt($credentials)){
			$req->session()->put('logged_in', [$req->level, $req->username]);
			$red ='';
			switch(\Session::get('logged_in')[0]){
				case 'admin':
				case 'kepsek': $red = '/dashboard';break;
				case 'guru' : $red = '/dashboard_guru';break;
				case 'siswa' : $red = '/dashboard_siswa';break;
			}
			return redirect($red)->with(['info' => 'Selamat Datang '.ucwords($req->level)]);
		}
		return redirect('/')->with(['alert' => 'Username atau Password Salah']);
	}
	public function unlock(Request $req){
		$credentials = [
					'nip' => $req->username,
					'password' => $req->password,
				];
		if($req->level == 'admin')
			$credentials = [
						'username' => $req->username,
						'password' => $req->password,
					];
		elseif($req->level == 'siswa')
			$credentials = [
						'nis' => $req->username,
						'password' => $req->password,
					];
		
		$auth = auth()->guard($req->level);
		
		if($auth->attempt($credentials)){
			$req->session()->put('logged_in', [$req->level, $req->username]);
			return json_encode(['stat' => 1, 'msg' => 'Layar Terbuka']);
		}
		return json_encode(['stat' => 0, 'msg' => 'Username atau Password Salah']);
	}

	public function logout(){
			\Session::forget('logged_in');
			return redirect('/')->with(['info' => 'Logout Berhasil']);
	}
	public function restricted(){
		\Session::forget('logged_in');
			return redirect('/')->with(['alert' => 'Akses Ditolak']);
	}
	public function profile(){
		if(!\Session::get('logged_in'))
			return redirect('restricted');
		switch(\Session::get('logged_in')[0]){
			case 'admin' : 
							$view = 'admin.profile';
							$d = \App\AdminOP::findOrfail(\Session::get('logged_in')[1]);
							break;
			case 'kepsek' : 
							$view = 'admin.profile_kepsek';
							$d = \App\Kepsek::findOrfail(\Session::get('logged_in')[1]);
							break;
			case 'guru' : 
							$view = 'guru.profile';
							$d = \App\Guru::findOrfail(\Session::get('logged_in')[1]);
							break;
			case 'siswa' :
							$data['url'] = 'update';
							$data['siswa']  = \App\Siswa::findOrfail(\Session::get('logged_in')[1]);
							$view = 'siswa.profile';
							$d = '';//\App\Siswa::findOrfail(\Session::get('logged_in')[1]);
							break;
		}
		
		$data['kelas'] = \App\Kelas::all();
		$data['agama'] = \App\Agama::all();
		$data['d'] = $d;
		$data['active'] = 'profile';
		$data['judul'] = 'Profil';
		return view($view, $data);
		//print_r($data);
    }

  	// public function login(Request $request){
    //   if($request->level == 'admin'){
    //       $auth = auth()->guard('admin');
		//
    //       $credentials = [
    //           'username' => $request->id,
    //           'password' => $request->password,
    //       ];
		//
    //       $validator = Validator::make($request->all(), [
    //           'id' => 'required|string|alpha_dash',
    //           'password' => 'required|string|min:6|max:20|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
    //       ]);
		//
    //       if( $validator->fails() ){
    //           return response()->json([
    //             'error'   => 2,
    //             'message' => $validator->messages(),
    //           ], 200);
    //       }else{
    //           if( $auth->attempt($credentials) ){
    //               return response()->json([
    //                   'error'   => 0,
    //                   'message' => 'Login Success'
    //               ], 200);
    //           }else{
    //               return response()->json([
    //                   'error'   => 1,
    //                   'message' => 'Wrong username or Password'
    //               ], 200);
    //           }
    //       }
    //   }
  	// }

}
