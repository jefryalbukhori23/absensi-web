<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\qrQode;
use App\Models\scaninfo;
use App\Models\students;
use Illuminate\Http\Request;

class scanController extends Controller
{
    //

    public function scan()
    {
        return view('cameraScan.index');
    }

    public function addscan($kode)
    {
        $now_code = qrQode::find(1);
        if($now_code->qrQode == $kode)
        {
            $student = students::where('id_user',auth()->user()->id)->first();
            $scan = new scaninfo();
            $scan->id_students = $student->id;
            $scan->status = 'C';
            $scan->save();
            return response()->json([
                'msg' => 'Berhasil',
                'text' => 'Lakukan Presensi Sekarang !'
            ], 200);
        }else{
            return response()->json([
                'msg' => 'Gagal',
                'text' => 'Qr COde Salah, Coba Lagi !'
            ], 200);
        }
    }

    public function cekscan()
    {
        $cek = scaninfo::where('status','C')->latest()->first();
        if($cek){
            $data = students::find($cek->id_students);
            $cek->status = 'P';
            $cek->save();
            return response()->json([
                'msg' => 'success',
                'data' => $data,
                'scan' => $cek
            ], 200);
        }else{
            return response()->json([
                'msg' => 'no'
            ], 200);
        }
    }
}
