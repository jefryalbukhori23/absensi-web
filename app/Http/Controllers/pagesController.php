<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        return view('admins.siswa');
    }
    
    public function sekolah()
    {
        return view('admins.sekolah');
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
        return view('admins.settingJam');
    }
    
    public function qrCode()
    {
        return view('admins.qrCode');
    }
}
