<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\peminjamanBukuModel;
use App\Models\detailPeminjamanBukuModel;
use App\Models\pengembalianBukuModel;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Validator;

class transaksiController extends Controller
{
    public function getPinjam(){
        $dt_pinjam=peminjamanBukuModel::get();
        return response()->json($dt_pinjam);
    }
    // pinjam
   public function pinjamBuku(Request $request){
    $validator = Validator::make($request->all(), [
        "id_siswa"=> "required",
        "tanggal_pinjam"=> "required",
        "tanggal_kembali"=> "required",
    ]);
    if ($validator->fails()){
        return Response()->json($validator->errors());
    }
    $save=peminjamanBukuModel::create([
        'id_siswa'=>$request->get('id_siswa'),
        'tanggal_pinjam'=>$request->get('tanggal_pinjam'),
        'tanggal_kembali'=>$request->get('tanggal_kembali'),
    ]);
    if($save){
        return Response()->json(['status'=>1]);
    }else {
        return Response()->json(['status'=>0]);
    }
   }

   //Tambah Item
   public function tambahItem(Request $request, $id){
    $validator = Validator::make($request->all(), [
        'id_buku'=> 'required',
        'qty'=> 'required',
    ]);
    if ($validator->fails()){
        return response()->json($validator->errors());
    }
    $save=detailPeminjamanBukuModel::create([
        'id_peminjaman_buku'=>$id,
        'id_buku'=>$request->get('id_buku'),
        'qty'=>$request->get('qty'),
    ]);
    if($save){
        return Response()->json(['status'=> 1]);
    }else {
        return Response()->json(['status'=> 0]);
    }
   }
   public function pengembalian(Request $request){
    $validator = Validator::make($request->all(), [
        'id_peminjaman_buku'=> 'required'
    ]);
    if ($validator->fails()){
        return response()->json($validator->errors());
    }

    $cek_kembali=pengembalianBukuModel::where('id_peminjaman_buku',$request->id_peminjaman_buku);
    if($cek_kembali->count() == 0){
        $dt_kembali=peminjamanBukuModel::where('id_peminjaman_buku',$request->id_peminjaman_buku)->first();
        $tanggal_sekarang=Carbon::now()->format('Y-m-d');
        $tanggal_kembali=new Carbon($dt_kembali->tanggal_kembali);
        $dendaperhari=1500;
        
        if (strtotime($tanggal_sekarang) > strtotime($tanggal_kembali)) {
            $jumlah_hari=$tanggal_kembali->diff($tanggal_sekarang)->days;
            $denda=$jumlah_hari*$dendaperhari;
        }else {
            $denda=0;
        }
        $save=pengembalianBukuModel::create([
            'id_peminjaman_buku'=> $request->id_peminjaman_buku,
            'tanggal_pengembalian'=> $tanggal_sekarang,
            'denda'=> $denda
        ]);
        if($save){
            $data['status']=1;
            $data['messege']= 'Berhasil dikembalikan';
        }else {
            $data['status']= 0;
            $data['messege']= 'Pengembalian gagal';
        }
    }else {
        $data=['status'=> 0, 'messege'=>'Sudah pernah dikembalikan'];
    }
    return response()->json($data);
   }
   public function getPinjamId($id_peminjaman_buku){
    $dt=peminjamanBukuModel::where('id', $id_peminjaman_buku)->first();
    return response()->json([
        Response()->json($dt)
    ]);
    
}
   
}
