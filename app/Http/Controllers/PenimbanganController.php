<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penimbangan;
use App\Models\Balita;
use Carbon\Carbon;

class PenimbanganController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'balita_id'      => 'required|exists:balitas,id',
            'berat_badan'    => 'required|numeric|min:0',
            'tinggi_badan'   => 'required|numeric|min:0',
            'lingkar_kepala' => 'nullable|numeric|min:0',
            // tambahkan field lain kalau ada di form kamu
        ]);

        $balita = Balita::findOrFail($request->balita_id);

        $data = $request->all();

        // ================== FIX UTAMA ==================
        // Penimbangan PERTAMA otomatis pakai tanggal lahir
        if ($balita->penimbangans()->count() === 0) {
            $data['tanggal'] = $balita->tanggal_lahir;   // paksa tanggal lahir
        } 
        // Penimbangan berikutnya pakai tanggal yang diinput
        else {
            $data['tanggal'] = $request->tanggal ?? now()->format('Y-m-d');
        }

        Penimbangan::create($data);

        return redirect()->route('penimbangan.index')
                        ->with('success', 'Penimbangan berhasil ditambahkan! Tanggal pertama otomatis sesuai lahir.');
    }

    public function update(Request $request, $id)
    {
        $data = Penimbangan::findOrFail($id);
        $data->update($request->all());

        return back()->with('success','Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Penimbangan::destroy($id);

        return back()->with('success','Data berhasil dihapus');
    }
}