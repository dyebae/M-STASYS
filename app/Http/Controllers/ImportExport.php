<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GuruImport;
use App\Imports\SiswaImport;

class ImportExport extends Controller
{
    public function import_siswa(Request $req){
		if($req->hasFile('excel')){
			$this->validate($req, [
			   'excel'  => 'required|mimes:xls,xlsx|max:2048'
			]);
			
			$path = $req->file('excel')->getRealPath();
			//dd($data);
			Excel::import(new SiswaImport, $path);
			return redirect('data_siswa')->with(['info'=>'Data Berhasil di Upload']);
		}
	}
	public function import_guru(Request $req){
		if($req->hasFile('excel')){
			$this->validate($req, [
			   'excel'  => 'required|mimes:xls,xlsx|max:2048'
			]);
			
			$path = $req->file('excel')->getRealPath();
			//dd($data);
			Excel::import(new GuruImport, $path);
			return redirect('data_guru')->with(['info'=>'Data Berhasil di Upload']);
		}
	}
}
