<?php

namespace App\Http\Controllers;

use App\Models\LaporanBanjir;
use Illuminate\Http\Request;

class LaporanBanjirController extends Controller
{
    public function index()
    {
        $listLaporan = LaporanBanjir::orderBy('created_at', 'desc')
        ->paginate(10);

        return view('laporan-banjir', compact('listLaporan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lokasi' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->foto->extension();
        $request->foto->move(public_path('images'), $imageName);

        $laporan = new LaporanBanjir();
        $laporan->user_id = auth()->id();
        $laporan->tanggal_laporan = now();
        $laporan->lokasi = $request->lokasi;
        $laporan->deskripsi = $request->deskripsi;
        $laporan->foto_url = $imageName;
        $laporan->status = 'waiting';
        $laporan->save();

        return back()
            ->with('success', 'Laporan banjir berhasil dikirim.');
    }

    public function followUp(Request $request)
    {
        // Save image
        $imageName = time().'.'.$request->foto->extension();
        $request->foto->move(public_path('follow_up_images'), $imageName);

        $laporan = LaporanBanjir::find($request->id_laporan);
        $laporan->status = 'solved';
        $laporan->deskripsi_follow_up = $request->deskripsi;
        $laporan->follow_up_user_id = auth()->id();
        $laporan->follow_up_at = now();
        $laporan->follow_up_foto_url = $imageName;
        $laporan->save();

        return back()
            ->with('success', 'Status laporan berhasil diubah.');
    }
}
