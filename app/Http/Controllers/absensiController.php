<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\absensi_detail;
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
}
