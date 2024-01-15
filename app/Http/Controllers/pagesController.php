<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\absensi_setting;
use App\Models\qrQode;
use App\Models\schools;
use Illuminate\Http\Request;

class pagesController extends Controller
{
    //
    public function dashboard()
    {
        return view('admins.dashboard');
    }
    
    public function siswa()
    {
        $data = schools::all();
        return view('admins.students.siswa')->with([
            'schools' => $data
        ]);
    }
    
    public function sekolah()
    {
        $data = schools::all();
        return view('admins.school.sekolah')->with([
            'schools' => $data
        ]);
    }
    public function perSiswa()
    {
        return view('admins.perSiswa');
    }
    
    public function perSekolah()
    {
        return view('admins.perSekolah');
    }
    
    public function settingJam()
    {
        return view('admins.setting_absensi.settingJam');
    }
    
    public function qrCode()
    {
        $qr = qrQode::find(1);
        $qr->qrQode = uniqid();
        $qr->save();
        return view('admins.qrCode')->with([
            'qr' => $qr
        ]);
    }
}
