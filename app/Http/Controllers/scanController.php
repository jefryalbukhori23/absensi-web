<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class scanController extends Controller
{
    //

    public function scan()
    {
        return view('cameraScan.index');
    }
}
