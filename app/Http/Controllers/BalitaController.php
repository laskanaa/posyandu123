<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Balita;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\StandarWhoTbu;
use Carbon\Carbon;

class BalitaController extends Controller
{
    // Tampilkan daftar balita
    public function index()
    {
        $balitas = Balita::all();
        return view('kader.balita.index', compact('balitas'));
    }

    // Form tambah balita
    public function create()
    {
        return view('kader.balita.create');
    }

    // Edit penimbangan
    public function edit($id)
    {
        $balita = Balita::findOrFail($id);
        return view('kader.balita.edit', compact('balita'));
    }

    // Update penimbangan
    public function update(Request $request, $id)
    {
        $balita = Balita::findOrFail($id);

        $balita->update([
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'lila' => $request->lila,
            'lika' => $request->lika
        ]);

        return redirect()->route('balita.index')
            ->with('success','Data penimbangan berhasil diperbarui');
    }

    // Simpan balita
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|unique:balitas,nik',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'nama_ibu' => 'required',
            'jenis_kelamin' => 'required',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'lila' => 'required|numeric',
            'lika' => 'required|numeric',
        ]);

        // Hitung umur bulan
        $tanggalLahir = Carbon::parse($request->tanggal_lahir);
        $umurBulan = $tanggalLahir->diffInMonths(Carbon::now());

        // Ambil standar WHO
        $standar = StandarWhoTbu::where('jenis_kelamin', $request->jenis_kelamin)
                    ->where('umur_bulan', $umurBulan)
                    ->first();

        $tb = $request->tinggi_badan;

        // Tentukan kondisi
        if ($standar) {

            if ($tb < $standar->minus_3sd) {
                $kondisi = 'Stunting Berat';
            } elseif ($tb < $standar->minus_2sd) {
                $kondisi = 'Stunting';
            } elseif ($tb <= $standar->plus_2sd) {
                $kondisi = 'Normal';
            } else {
                $kondisi = 'Tinggi';
            }

        } else {
            $kondisi = 'Belum dihitung';
        }

        // Buat akun orang tua
        $user = User::create([
            'name' => $request->nama_ibu,
            'email' => $request->nik . '@ortu.posyandu',
            'password' => Hash::make($request->nama_ibu),
            'role' => 'orang_tua'
        ]);

        // Simpan balita + penimbangan pertama
        Balita::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nama_ibu' => $request->nama_ibu,
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'lila' => $request->lila,
            'lika' => $request->lika,
            'status_stunting' => $kondisi
        ]);

        return redirect()->route('balita.index')
            ->with('success','Data balita berhasil ditambahkan');
    }

    // Detail balita
    public function show($id)
    {
        $balita = Balita::with('penimbangans','user')->findOrFail($id);

        return view('kader.balita.show', compact('balita'));
    }

    // Hapus balita
    public function destroy($id)
    {
        $balita = Balita::findOrFail($id);

        if ($balita->user_id) {
            User::where('id', $balita->user_id)->delete();
        }

        $balita->delete();

        return redirect()->route('balita.index')
            ->with('success', 'Data balita berhasil dihapus');
    }
}