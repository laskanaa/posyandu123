<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\File;

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

$file = $request->file('gambar');
$namaFile = time() . '_' . $file->getClientOriginalName();

$file->move(public_path('upload-galeri'), $namaFile);

Galeri::create([
    'gambar' => $namaFile
]);

        return redirect()->route('kader.galeri.index')
            ->with('success', 'Gambar berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $data = Galeri::findOrFail($id);

        // Hapus file fisik dari folder public/galeri
        $filePath = public_path('upload-galeri/' . $data->gambar);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $data->delete();

        return back()->with('success', 'Gambar berhasil dihapus');
    }
}