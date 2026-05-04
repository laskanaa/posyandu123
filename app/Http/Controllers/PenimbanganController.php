<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penimbangan;
use App\Models\Balita;

class PenimbanganController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'balita_id'           => 'required|exists:balitas,id',
            'tanggal_penimbangan' => 'nullable|date',
            'berat_badan'         => 'required|numeric|min:0',
            'tinggi_badan'        => 'required|numeric|min:0',
            'lila'                => 'nullable|numeric|min:0',
            'lika'                => 'nullable|numeric|min:0',
            'pesan'               => 'nullable|string', 
        ]);

        $balita = Balita::findOrFail($request->balita_id);

        if ($balita->penimbangans()->count() === 0) {
            $tanggal = $balita->tanggal_lahir;
        } else {
            $tanggal = $request->tanggal_penimbangan ?? now();
        }

        Penimbangan::create([
            'balita_id'           => $balita->id,
            'tanggal_penimbangan' => $tanggal,
            'berat_badan'         => $request->berat_badan,
            'tinggi_badan'        => $request->tinggi_badan,
            'lila'                => $request->lila,
            'lika'                => $request->lika,
            'pesan'               => $request->pesan, 
        ]);

        return redirect()->back()->with('success', 'Penimbangan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penimbangan = Penimbangan::with('balita')->findOrFail($id);

        return view('kader.balita.editPenimbangan', compact('penimbangan'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_penimbangan' => 'nullable|date',
            'berat_badan'         => 'required|numeric|min:0',
            'tinggi_badan'        => 'required|numeric|min:0',
            'lila'                => 'nullable|numeric|min:0',
            'lika'                => 'nullable|numeric|min:0',
            'pesan'               => 'nullable|string',
        ]);

        $data = Penimbangan::findOrFail($id);

        $data->update([
            'tanggal_penimbangan' => $request->tanggal_penimbangan ?? $data->tanggal_penimbangan,
            'berat_badan'         => $request->berat_badan,
            'tinggi_badan'        => $request->tinggi_badan,
            'lila'                => $request->lila,
            'lika'                => $request->lika,
            'pesan'               => $request->pesan, 
        ]);

        return redirect()
    ->route('balita.show', $data->balita_id)
    ->with('success', 'Data penimbangan berhasil diupdate');
    }

    public function destroy($id)
    {
        Penimbangan::destroy($id);
        return back()->with('success', 'Data berhasil dihapus');
    }
}