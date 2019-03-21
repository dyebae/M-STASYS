<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class LoginController extends Controller
{
    public function index(){
      return view('login');
    }

  	public function login(Request $request){
      if($request->level == 'admin'){
          $auth = auth()->guard('admin');

          $credentials = [
              'username' => $request->id,
              'password' => $request->password,
          ];

          $validator = Validator::make($request->all(), [
              'id' => 'required|string|alpha_dash',
              'password' => 'required|string|min:6|max:20|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
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
                      'message' => 'Wrong username or Password'
                  ], 200);
              }
          }
      }
  	}
}
