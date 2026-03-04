<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Balita;

class BalitaController extends Controller
{
    // Tampilkan daftar balita
    public function index()
    {
        $balitas = Balita::all(); // ambil semua data balita
        return view('kader.balita.index', compact('balitas'));
    }

    // Tampilkan form tambah balita
    public function create()
    {
        return view('balita.create');
    }

    // Simpan data balita baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer',
            'berat' => 'required|numeric',
            'tinggi' => 'required|numeric',
        ]);

        Balita::create([
            'nama' => $request->nama,
            'umur' => $request->umur,
            'berat' => $request->berat,
            'tinggi' => $request->tinggi,
        ]);

        return redirect()->route('balita.index')->with('success', 'Data balita berhasil ditambahkan!');
    }

    // Tampilkan detail balita
    public function show($id)
    {
        $balita = Balita::findOrFail($id);
        return view('balita.show', compact('balita'));
    }
}