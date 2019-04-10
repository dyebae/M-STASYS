<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Guru;
use App\Kelas;
class GuruController extends Controller
{
	public function index(){
		if(!\Session::get('logged_in'))
			return redirect('/')->with(['alert' => 'Akses ditolak']);
		$data['kelas'] = Kelas::all();
		$data['guru'] = Guru::all();
		$data['active'] = 'data_guru';
		$data['judul'] = 'Data Guru';
		return view('admin.dataguru', $data);
	}
	public function destroy(Request $req){
		$del = Guru::findOrFail($req->nip);
		$del->delete();
		if($del){
			return redirect('/data_guru')->with(['info' => 'Data Guru Berhasil dihapus']);
		}
		return redirect('/data_guru')->with(['alert' => 'Terjadi kesalahan saat menghapus data guru']);
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

					$nama = DB::table('tb_guru')->where('nip', $request->nip)->value('nama');
          if( $validator->fails() ){
              return response()->json([
                'error'   => 2,
                'message' => $validator->messages()->all(),
              ], 200);
          }else{
              if( $auth->attempt($credentials) ){
                  return response()->json([
                      'error'   => 0,
                      'message' => ['Selamat Datang '.$nama.''],
                  ], 200);
              }else{
                  return response()->json([
                      'error'   => 1,
                      'message' => ['NIP atau Password Salah'],
                  ], 200);
              }
          }
    }

    public function apiAllData($nip){
        $data = DB::table('tb_guru')->where('nip', $nip)->first();

        return json_encode($data);
    }

}
