<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi;
use App\Models\Balita;
use App\Models\User;

class InformasiController extends Controller
{
    public function index()
    {
        $data = Informasi::latest()->get();
        return view('kader.informasi.index', compact('data'));
    }

    public function create()
    {
        return view('kader.informasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|in:Jumlah Balita,Balita Stunting,Jumlah Posyandu,Jumlah Kader'
        ]);

        $angka = 0;

        if ($request->judul === 'Jumlah Posyandu') {
            // Untuk Jumlah Posyandu → ambil dari input manual
            $request->validate(['angka' => 'required|numeric']);
            $angka = $request->angka;
        } 
        else {
            // Untuk yang lain → hitung otomatis
            switch ($request->judul) {
                case 'Jumlah Balita':
                    $angka = Balita::count();
                    break;

                case 'Balita Stunting':
                    $angka = Balita::get()->filter(fn($b) => $b->kondisi === 'Stunting')->count();
                    break;

                case 'Jumlah Kader':
                    $angka = User::where('role', 'kader')->count();
                    break;
            }
        }

        Informasi::create([
            'judul' => $request->judul,
            'angka' => $angka,
        ]);

        return redirect()->route('kader.informasi.index')
                        ->with('success', 'Informasi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $informasi = Informasi::findOrFail($id);
        return view('kader.informasi.edit', compact('informasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'angka' => 'required|numeric'
        ]);

        $informasi = Informasi::findOrFail($id);
        $informasi->update([
            'angka' => $request->angka
        ]);

        return redirect()->route('kader.informasi.index')
                         ->with('success', 'Data informasi berhasil diupdate');
    }

    public function destroy($id)
    {
        Informasi::findOrFail($id)->delete();

        return redirect()->route('kader.informasi.index')
                         ->with('success', 'Informasi berhasil dihapus');
    }
}