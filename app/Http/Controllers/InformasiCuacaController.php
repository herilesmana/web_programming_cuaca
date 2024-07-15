<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformasiCuacaController extends Controller
{
    public function index()
    {
        return view('informasi-cuaca');
    }
}
