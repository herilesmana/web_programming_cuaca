<?php

namespace App\Http\Controllers;

use App\Models\MateriEdukasi;
use Illuminate\Http\Request;

class MateriEdukasiController extends Controller
{
    public function index()
    {
        $listEdukasi = MateriEdukasi::orderBy('created_at', 'desc')
        ->paginate(10);

        return view('materi-edukasi', compact('listEdukasi'));
    }

    private function createSlug($judul)
    {
        $slug = strtolower($judul);
        $slug = str_replace(' ', '-', $slug);
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
        
        // Check if the slug already exists
        $count = MateriEdukasi::where('url', $slug)->count();

        if ($count > 0) {
            $slug = $slug . '-' . $count;
        }

        return $slug;
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required'
        ]);

        $url = $this->createSlug($request->judul);

        $edukasi = new MateriEdukasi();
        $edukasi->judul = $request->judul;
        $edukasi->konten = $request->deskripsi;
        $edukasi->url = $url;
        $edukasi->save();

        return back()
            ->with('success', 'Materi edukasi berhasil diunggah.');
    }

    public function show($url)
    {
        $edukasi = MateriEdukasi::where('url', $url)->first();

        return view('materi-edukasi-show', compact('edukasi'));
    }
}
