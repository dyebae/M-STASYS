<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{

    // ------------ API GURU ----------------------- ///
    public function apiLogin(Request $request){
        $auth = auth()->guard('siswa');

        $credentials = [
            'nis'      => $request->nis,
            'password' => $request->password,
        ];

        $validator = Validator::make($request->all(), [
            'nis' => 'required|digits:5|numeric|not_in:0|regex:/^([1-9][0-9]+)/',
            'password' => 'required|string|min:6|max:20|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
        ]);

        if( $validator->fails() ){
            return response()->json([
              'error'   => 2,
              'message' => $validator->messages()->all(),
            ], 200);
        }else{
            if( $auth->attempt($credentials) ){
                return response()->json([
                    'error'   => 0,
                    'message' => ['Login Success'],
                ], 200);
            }else{
                return response()->json([
                    'error'   => 1,
                    'message' => ['Wrong nis or Password'],
                ], 200);
            }
        }

    }
}
