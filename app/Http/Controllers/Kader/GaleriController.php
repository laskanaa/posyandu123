<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::latest()->get();
        return view('kader.galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('kader.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $path = $request->file('gambar')->store('galeri', 'public');

        Galeri::create([
            'gambar' => $path
        ]);

        return redirect()->route('kader.galeri.index')
            ->with('success', 'Berhasil tambah');
    }

    public function destroy($id)
    {
        $data = Galeri::findOrFail($id);

        // 🔥 hapus file juga (biar rapi)
        if (file_exists(storage_path('app/public/' . $data->gambar))) {
            unlink(storage_path('app/public/' . $data->gambar));
        }

        $data->delete();

        return back()->with('success', 'Berhasil hapus');
    }
}