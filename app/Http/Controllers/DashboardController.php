<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
      return view('admin.dashboard');
    }
    public function datasiswa(){
      return view('admin.datasiswa');
    }
    public function dataguru(){
      return view('admin.dataguru');
    }
    public function datakelas(){
      return view('admin.datakelas');
    }

}
