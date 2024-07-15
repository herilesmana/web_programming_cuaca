<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanBanjirController extends Controller
{
    public function index()
    {
        return view('laporan-banjir');
    }
}
