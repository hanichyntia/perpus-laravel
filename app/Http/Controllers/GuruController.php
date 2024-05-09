<?php

namespace App\Http\Controllers;

use App\Models\GuruModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class GuruController extends Controller
{
    public function addGuru(Request $request){
        $validator = Validator::make($request->all(),[
            "nama_guru"=> "required",
            "mapel"=> "required",
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors()->toJson());
        }
        $save = GuruModel::create([
            'nama_guru'=> $request->get('nama_guru'),
            'mapel'=> $request->get('mapel'),
        ]);
        if($save){
            return response()->json(['status'=>true,'message'=> 'Berhasil menambahkan data']);
        }else {
            return response()->json(['status'=>false,'message'=> 'Gagal menambahkan data']);
        }
    }
}
