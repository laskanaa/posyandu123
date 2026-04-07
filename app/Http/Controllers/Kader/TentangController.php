<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TentangPosyandu;

class TentangController extends Controller
{
    public function index()
    {
        $tentang = TentangPosyandu::first();
        return view('kader.tentang.index', compact('tentang'));
    }

    public function create()
    {
        return view('kader.tentang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'deskripsi1' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = [
            'deskripsi1' => $request->deskripsi1
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('tentang', 'public');
        }

        TentangPosyandu::create($data);

        return redirect()->route('kader.tentang.index')
            ->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $tentang = TentangPosyandu::findOrFail($id);
        return view('kader.tentang.edit', compact('tentang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'deskripsi1' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $tentang = TentangPosyandu::findOrFail($id);

        $data = [
            'deskripsi1' => $request->deskripsi1
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('tentang', 'public');
        }

        $tentang->update($data);

        return redirect()->route('kader.tentang.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $tentang = TentangPosyandu::findOrFail($id);
        $tentang->delete();

        return redirect()->route('kader.tentang.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}