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
            'balita_id' => 'required',
            'berat_badan' => 'required',
            'tinggi_badan' => 'required',
            'tanggal_penimbangan' => 'required'
        ]);

        $balita = Balita::findOrFail($request->balita_id);

        // hitung umur saat penimbangan
        $umur = Carbon::parse($balita->tanggal_lahir)
            ->diffInMonths($request->tanggal_penimbangan);

        // contoh logika status sederhana
        if ($request->berat_badan < 5) {
            $status = "Berat badan kurang";
        } elseif ($request->berat_badan >= 5 && $request->berat_badan <= 8) {
            $status = "Normal";
        } else {
            $status = "Berat badan lebih";
        }

        // simpan penimbangan
        Penimbangan::create([
            'balita_id' => $request->balita_id,
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'tanggal_penimbangan' => $request->tanggal_penimbangan,
            'umur' => $umur,
            'status' => $status
        ]);

        // update kondisi terakhir balita
        $balita->update([
            'kondisi' => $status
        ]);

        return back()->with('success','Data penimbangan ditambahkan');
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