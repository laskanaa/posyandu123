<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::all();
        return view('kader.layanan.index', compact('layanans'));
    }

    public function create()
    {
        return view('kader.layanan.create');
    }

    public function store(Request $request)
    {
        Layanan::create($request->all());
        return redirect()->route('kader.layanan.index')->with('success','Data berhasil ditambah');
    }

    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('kader.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->update($request->all());
        return redirect()->route('kader.layanan.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Layanan::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}