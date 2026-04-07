<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi;

class InformasiController extends Controller
{
    public function index()
    {
        $data = Informasi::all();
        return view('kader.informasi.index', compact('data'));
    }

    public function create()
    {
        return view('kader.informasi.create');
        Informasi::create([
    'judul' => $request->judul,
    'angka' => $request->angka
]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'angka' => 'required|numeric'
        ]);

        Informasi::create($request->all());

        return redirect()->route('kader.informasi.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Informasi::findOrFail($id);
        return view('kader.informasi.edit', compact('data'));
    }

public function update(Request $request, $id)
{
    $request->validate([
        'angka' => 'required|numeric'
    ]);

    $data = Informasi::findOrFail($id);

    $data->update([
        'angka' => $request->angka
    ]);

    return redirect()->route('kader.informasi.index')
        ->with('success', 'Data berhasil diupdate');
}

    public function destroy($id)
    {
        $data = Informasi::findOrFail($id);
        $data->delete();

        return redirect()->route('kader.informasi.index')
            ->with('success', 'Data berhasil dihapus');
    }
}