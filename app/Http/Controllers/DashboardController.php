<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $id_lokasi = $request->user()->id_lokasi;

        $cuaca = [];

        if($id_lokasi != null) {
            $cuaca = json_decode(file_get_contents('https://ibnux.github.io/BMKG-importer/cuaca/' . $id_lokasi . '.json'), true);

            $cuaca = collect($cuaca)->map(function($item) {
                $item['cuaca'] = $item['cuaca'] == '' ? 'Cerah' : $item['cuaca'];
    
                return $item;
            });
        }

        $cuaca_terkini = [];
        
        // Cuaca terkini berdasarkan data jamCuaca palning dekat dengan sekarang
        $closest = null;
        $now = time();
        foreach($cuaca as $data) {
            $jamCuaca = strtotime($data['jamCuaca']);
            if($closest === null || abs($now - $jamCuaca) < abs($now - $closest)) {
                $closest = $jamCuaca;
                $cuaca_terkini = $data;
            }
        }

        return view('dashboard', [
            'id_lokasi' => $id_lokasi,
            'cuaca' => $cuaca,
            'cuaca_terkini' => $cuaca_terkini
        ]);
    }
}
