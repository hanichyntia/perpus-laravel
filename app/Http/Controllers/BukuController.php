<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
class BukuController extends Controller
{
    public function getBuku(){
        $dt_buku=Buku::get();
        return response()->json($dt_buku);
    } 
 
    
    public function addBuku(Request $req){
        $valid=Validator::make($req->all(),[
            'nama_buku'=>'required',
            'pengarang'=>'required',
            'deskripsi'=>'required',
            'foto'=>'required',
        ]);
        if ($valid->fails()) {
            return Response()->json($valid->errors()->toJson());
        }
        $save = Buku::create([
            'nama_buku'=>$req->get('nama_buku'),
            'pengarang'=>$req->get('pengarang'),
            'deskripsi'=>$req->get('deskripsi'),
            'foto'=>$req->get('foto')
        ]);
        if ($save) {
            return Response()->json(['status'=>true, 'messege'=>'Sukses menambahkan buku']);
        }else {
            return Response()->json(['status'=>false, 'messege'=>'Gagal menambahkan buku']);
        }
    }
    public function updateBuku(Request $req, $id){
        $valid = Validator::make($req->all(),[
            'nama_Buku'=>'required',
            'pengarang'=>'required',
            'deskripsi' => 'required',
            'foto'=>'required'
        ]);

        if ($valid->fails()) {
            return Response()->json($valid->errors()->toJson());
        }
        $ubah=Buku::where('id', $id)->update([
            'nama_Buku'=>$req->get('nama_buku'), 
            'pengarang'=>$req->get('pengarang'),
            'deskripsi' => $req-> get('deskripsi'),
            'foto'=>$req->get('foto')
        ]);
        if ($ubah) {
            return Response()->json(['status'=>true, 'messege'=>'sukses mengubah Buku']);
        }else{
            return Response()->json(['status'=>false, 'messege'=>'gagal mengubah Buku']);
        }
    }
    public function deleteBuku($id_buku){
        $hapus=Buku::where('id', $id_buku)->delete();
        if ($hapus) {
            return Response()->json(['status'=>true, 'messege' => 'Berhasil menghapus Buku']);
        }else {
            return Response()->json(['status'=>false, 'messege' => 'Gagal menghapus Buku']);
        }
    }
    public function getBukuId($id_buku){
        $dt=Buku::where('id', $id_buku)->first();
        return response()->json([
            Response()->json($dt)
        ]);
        
    }
}
