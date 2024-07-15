<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MateriEdukasiController extends Controller
{
    public function index()
    {
        return view('materi-edukasi');
    }
}
