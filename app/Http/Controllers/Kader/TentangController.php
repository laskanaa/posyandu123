<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TentangPosyandu;

class TentangController extends Controller
{
    // Tampilkan semua data (cuma 1 deskripsi)
    public function index()
    {
        $tentang = TentangPosyandu::first(); // ambil 1 data
        return view('kader.tentang.index', compact('tentang'));
    }

    // Form tambah data
    public function create()
    {
        return view('kader.tentang.create');
    }

    // Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi1' => 'required',
        ]);

        TentangPosyandu::create([
            'deskripsi1' => $request->deskripsi1,
        ]);

        return redirect()->route('kader.tentang.index')
                         ->with('success', 'Data berhasil disimpan!');
    }

    // Form edit
    public function edit($id)
    {
        $tentang = TentangPosyandu::findOrFail($id);
        return view('kader.tentang.edit', compact('tentang'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'deskripsi1' => 'required',
        ]);

        $tentang = TentangPosyandu::findOrFail($id);
        $tentang->update([
            'deskripsi1' => $request->deskripsi1,
        ]);

        return redirect()->route('kader.tentang.index')
                         ->with('success', 'Data berhasil diperbarui!');
    }

    // Hapus data
    public function destroy($id)
    {
        $tentang = TentangPosyandu::findOrFail($id);
        $tentang->delete();

        return redirect()->route('kader.tentang.index')
                         ->with('success', 'Data berhasil dihapus!');
    }
}