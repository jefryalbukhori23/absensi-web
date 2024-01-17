<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        return view('admins.profil.index');
    }
    public function pengguna()
    {
        return view('admins.users.index');
    }
}
