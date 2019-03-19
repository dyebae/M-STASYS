<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class LoginController extends Controller
{
    public function index(){
      return view('login');
    }
	
	public function process(Request $req){
		
	}
}
