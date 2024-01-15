<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\absensi_detail;
use App\Models\absensi_setting;
use Illuminate\Http\Request;

class absensiController extends Controller
{
    public function absen(Request $request)
    {
        $request->validate([
            'img' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $absensi = absensi::where('date',date('Y-m-d'))->first();
        if(!$absensi)
        {
            $new_absensi = new absensi();
            $new_absensi->date = date('Y-m-d');
            $new_absensi->total_students = 0;
            $new_absensi->save();
            $absensi = absensi::where('date',date('Y-m-d'))->first();
        }
        $data = new absensi_detail();
        $data->id_absensi = $absensi->id;
        $data->needs = $request->needs;
        $data->status = $request->status;
        $data->time = $request->time;
        $data->latitude = $request->latitude;
        $data->longitude = $request->longitude;
        $logoPath = $request->file('img')->store('absen_image', 'public');
        $data->photo = $logoPath;
        $data->save();

        return response()->json([
            'msg' => 'success'
        ], 200);
    }

    public function get_jml_siswa()
    {
        $sett = absensi_setting::find(1);
        $now = date('H:i:s');
        $absensi = absensi::where('date',date('Y-m-d'))->first();
        if(!$absensi)
        {
            $new_absensi = new absensi();
            $new_absensi->date = date('Y-m-d');
            $new_absensi->total_students = 0;
            $new_absensi->save();
            $absensi = absensi::where('date',date('Y-m-d'))->first();
        }
        if($now < $sett->home_entry){
            $data = absensi_detail::where('id_absensi',$absensi->id)->where('needs','D')->get();
            
        }else{
            $data = absensi_detail::where('id_absensi',$absensi->id)->where('needs','P')->get();
        }

        return response()->json($data->count());
    }
}
