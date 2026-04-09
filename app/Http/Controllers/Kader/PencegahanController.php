<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\Pencegahan;
use Illuminate\Http\Request;

class PencegahanController extends Controller
{

    public function index()
    {
        $pencegahans = Pencegahan::all();
        return view('kader.pencegahan.index', compact('pencegahans'));
    }

    public function create()
    {
        return view('kader.pencegahan.create');
    }

public function store(Request $request)
{
    Pencegahan::create([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi ?? '', // kasih default kosong
    ]);

    return redirect()->route('kader.pencegahan.index')
        ->with('success','Data berhasil ditambah');
}

    public function edit($id)
    {
        $pencegahan = Pencegahan::findOrFail($id);
        return view('kader.pencegahan.edit', compact('pencegahan'));
    }

    public function update(Request $request, $id)
    {
        $pencegahan = Pencegahan::findOrFail($id);

        $pencegahan->update($request->all());

        return redirect()->route('kader.pencegahan.index')
            ->with('success','Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Pencegahan::findOrFail($id)->delete();

        return redirect()->route('kader.pencegahan.index')
            ->with('success','Data berhasil dihapus');
    }

}