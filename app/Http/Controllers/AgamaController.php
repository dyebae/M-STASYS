<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Agama;
use \Illuminate\Database\QueryException;
class AgamaController extends Controller
{
    public function index()
    {
		$data['agama'] = Agama::all();
		$data['active'] = 'agama';
		$data['judul'] = 'Agama';
		return view('admin.agama', $data);
    }
    public function store(Request $req)
    {
        Agama::create(['agama' => $req->agama]);
		return back()->with(['info'=>'Agama Berhasil ditambahkan']);
    }

    public function destroy(Request $req)
    {
        $agama = Agama::findOrfail($req->id_agama);
		try{
			$agama->delete();
			return back()->with(['info'=>'Agama Berhasil dihapus']);
		}catch(QueryException $e){
			return back()->with(['alert'=>'Agama Tidak dapat dihapus']);
		}
    }
}
