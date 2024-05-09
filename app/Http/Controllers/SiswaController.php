<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function getSiswa(){
      $dt_siswa=Siswa::get();
      return Response()->json($dt_siswa);
    }

    public function addSiswa(Request $req){
      $valid=Validator::make($req->all(),[
        'nama_siswa'=>'required',
        'tanggal_lahir'=>'required',
        'gender'=>'required',
        'alamat'=>'required',
        'username'=>'required',
        'password'=>'required',
        'id_kelas'=>'required'
      ]);
      if ($valid->fails()) {
        return Response()->json($valid->errors()->toJson());
      }
      $save=Siswa::create([
        'nama_siswa'=>$req->get('nama_siswa'),
        'tanggal_lahir'=>$req->get('tanggal_lahir'),
        'gender'=>$req->get('gender'),
        'alamat'=>$req->get('alamat'),
        'username'=>$req->get('username'),
        'password'=>$req->get('password'),
        'id_kelas'=>$req->get('id_kelas')
      ]);
      if ($save) {
        return Response()->json(['status'=>true, 'messege'=>'Sukses menambahkan data siswa']);
      }else {
        return Response()->json(['status'=>false, 'messege'=>'Gagal mnambahkan data siswa']);
      }
    }

    public function updateSiswa(Request $req, $id_siswa){
      $valid=Validator::make($req->all(),[
        'nama_siswa'=>'required',
        'tanggal_lahir'=>'required',
        'gender'=>'required',
        'alamat'=>'required',
        'username'=>'required',
        'password'=>'required',
        'id_kelas'=>'required'
      ]);
      if ($valid->fails()) {
        return Response()->json($valid->errors()->toJson());
      }
      $ubah=Siswa::where('id_siswa', $id_siswa)->update([
        'nama_siswa'=>$req->get('nama_siswa'),
        'tanggal_lahir'=>$req->get('tanggal_lahir'),
        'gender'=>$req->get('gender'),
        'alamat'=>$req->get('alamat'),
        'username'=>$req->get('username'),
        'password'=>$req->get('password'),
        'id_kelas'=>$req->get('id_kelas')
      ]);
      if ($ubah) {
        return Response()->json(['status'=>true, 'messege'=>'Sukses mengubah data Siswa']);
      }else{
        return Response()->json(['status'=>false, 'messege'=>'Gagal mengubah data Siswa']);
      }
    }

    public function deleteSisaw($id_siswa){
      $hapus=Siswa::where('id_siswa', $id_siswa)->delete();
      if($hapus){
        return Response()->json(['status'=>true, 'messege'=>'Sukses menghapus data Siswa']);
      }else {
        return Response()->json(['status'=>false, 'messege'=>'Gagal menghapus data Siswa']);
      }
    }
    
    public function getSiswaId($id_siswa){
      $dt_siswa=Siswa::where('id_siswa', $id_siswa)->first();
      return Response()->json($dt_siswa);
    }
}
