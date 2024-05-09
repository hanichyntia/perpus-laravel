<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function getKelas()
    {
        $dt_angkatan = Kelas::get();
        return response()->json($dt_angkatan);
    }

    public function addKelas(Request $req){
        $validator = Validator::make($req->all(),[
            'nama_kelas'=>'required',
            'kelompok'=>'required'
        ]);

        if ($validator->fails()) {
            return Response()->json($validator->errors()->toJson());
        }
        $save = Kelas::create([
            'nama_kelas' => $req -> get('nama_kelas'),
            'kelompok'=> $req->get('kelompok')
        ]);
        if ($save) {
            return Response()->json(['status' => true, 'messege' => 'Sukses menambahkan kelas']);
        }else{
            return Response()->json(['status' => false, 'messege' => 'Gagal menambahkan kelas']);
        }
    }
    public function updateAngkatan(Request $req, $id_kelas){
        $validator = Validator::make($req->all(),[
            'nama_kelas'=>'required',
        ]);

        if ($validator->fails()) {
            return Response()->json($validator->errors()->toJson());
        }
        $ubah=Kelas::where('id_kelas', $id_kelas)->update([
            'nama_kelas' => $req -> get('nama_kelas'),
        ]);
        if ($ubah) {
            return Response()->json(['status'=>true, 'messege'=>'sukses mengubah data kelas']);
        }else{
            return Response()->json(['status'=>false, 'messege'=>'gagal mengubah data kelas']);
        }
    }
    public function deleteKelas($id_kelas){
        $hapus=Kelas::where('id_kelas', $id_kelas)->delete();
        if ($hapus) {
            return Response()->json(['status'=>true, 'messege' => 'Berhasil menghapus kelas']);
        }else {
            return Response()->json(['status'=>false, 'messege' => 'Gagal menghapus kelas']);
        }
    }
    public function getKelasid($id_kelas){
        $dt_kelas=Kelas::where('id_kelas', $id_kelas)->first();
        return Response()->json($dt_kelas);
    }
}
