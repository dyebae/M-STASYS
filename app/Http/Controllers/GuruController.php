<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuruController extends Controller
{
	public function index(){
		if(\Session::get('logged_in')){}else
		{
			return redirect('/')->with(['alert' => 'Akses ditolak']);
		}
		$data['active'] = 'data_guru';
		$data['judul'] = 'Data Guru | M - STASYS';
		return view('admin.dataguru', $data);
	}

    // ------------ API GURU ----------------------- ///
    public function apiLogin(Request $request){
          $auth = auth()->guard('guru');

          $credentials = [
              'nip'      => $request->nip,
              'password' => $request->password,
          ];

          $validator = Validator::make($request->all(), [
              'nip'   => 'required|digits:18|numeric|not_in:0|regex:/^([1-9][0-9]+)/',
              'password'=> 'required|string|min:6|max:20|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
          ]);

          if( $validator->fails() ){
              return response()->json([
                'error'   => 2,
                'message' => $validator->messages(),
              ], 200);
          }else{
              if( $auth->attempt($credentials) ){
                  return response()->json([
                      'error'   => 0,
                      'message' => 'Login Success'
                  ], 200);
              }else{
                  return response()->json([
                      'error'   => 1,
                      'message' => 'Wrong nip or Password'
                  ], 200);
              }
          }
    }

}
