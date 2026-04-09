<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Balita;
use App\Models\User;
use App\Models\Penimbangan;
use Illuminate\Support\Facades\Hash;
use App\Models\StandarWhoTbu;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;



class BalitaController extends Controller
{

    // =========================
    // INDEX
    // =========================
    public function index(Request $request)
    {
        $search = $request->search;

        $balitas = Balita::with('penimbangans')   // ← BARIS INI YANG BARU
            ->when($search, function ($query) use ($search) {
                $query->where('nama', 'like', "%$search%")
                    ->orWhere('nama_ibu', 'like', "%$search%");
            })
            ->orderBy('nama','asc')
            ->get();

        return view('kader.balita.index', compact('balitas'));
    }


    // DASHBOARD ORANG TUA
    public function dashboard()
    {
    $balita = Balita::where('user_id', Auth::id())->first();

    return view('orangtua.dashboard', compact('balita'));
    }

    // =========================
    // CREATE
    // =========================
    public function create()
    {
        return view('kader.balita.create');
    }

    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        $balita = Balita::findOrFail($id);

        // ambil penimbangan terakhir
        $penimbangan = $balita->penimbangans()->latest()->first();

        return view('kader.balita.edit', compact('balita', 'penimbangan'));
    }

    // =========================
    // UPDATE (SUDAH DISESUAIKAN - VERSI BARU)
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'          => 'required',
            'nik'           => 'required',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'nama_ibu'      => 'required',
            'berat_badan'   => 'required|numeric',
            'tinggi_badan'  => 'required|numeric',
            'lila'          => 'required|numeric',
            'lika'          => 'required|numeric',
        ]);

        $balita = Balita::findOrFail($id);

        // UPDATE BIODATA SAJA
        $balita->update([
            'nama'          => $request->nama,
            'nik'           => $request->nik,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nama_ibu'      => $request->nama_ibu,
            // 'kondisi' DIHAPUS → sekarang pakai accessor di Model
        ]);

        // SIMPAN PENIMBANGAN BARU (bisa pakai tanggal yang diinput user)
        Penimbangan::create([
            'balita_id'          => $balita->id,
            'tanggal_penimbangan' => $request->tanggal_penimbangan ?? now(),
            'berat_badan'        => $request->berat_badan,
            'tinggi_badan'       => $request->tinggi_badan,
            'lila'               => $request->lila,
            'lika'               => $request->lika,
            'pesan'              => $request->pesan ?? null,
        ]);

        return redirect()->route('balita.show', $balita->id)
                         ->with('success', 'Data berhasil diperbarui');
    }
    // =========================
    // STORE (BARU - SUDAH DISESUAIKAN)
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required',
            'nik'           => 'required|unique:balitas,nik',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required|date',
            'nama_ibu'      => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'berat_badan'   => 'required|numeric',
            'tinggi_badan'  => 'required|numeric',
            'lila'          => 'required|numeric',
            'lika'          => 'required|numeric',
        ]);

        // Buat akun orang tua
        $user = User::create([
            'name'     => $request->nama_ibu,
            'email'    => $request->nik . '@ortu.posyandu',
            'password' => Hash::make($request->nama_ibu),
            'role'     => 'orang_tua'
        ]);

        // Simpan balita (TIDAK SIMPAN KONDISI lagi)
        $balita = Balita::create([
            'user_id'       => $user->id,
            'nama'          => $request->nama,
            'nik'           => $request->nik,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nama_ibu'      => $request->nama_ibu,
            // 'kondisi' dihapus → sekarang pakai accessor di Model
        ]);

        // Penimbangan pertama → pakai tanggal lahir (INI FIX UTAMA)
        Penimbangan::create([
            'balita_id'          => $balita->id,
            'tanggal_penimbangan' => $request->tanggal_lahir,   // ← paksa tanggal lahir
            'berat_badan'        => $request->berat_badan,
            'tinggi_badan'       => $request->tinggi_badan,
            'lila'               => $request->lila,
            'lika'               => $request->lika,
            'pesan'              => $request->pesan ?? null,
        ]);

        return redirect()->route('balita.index')
                         ->with('success', 'Data balita berhasil ditambahkan');
    }

// =========================
// SHOW
// =========================
public function show($id)
{
    $balita = Balita::with([
        'user',
        'penimbangans' => function($q){
            $q->orderBy('tanggal_penimbangan','asc');
        }
    ])->findOrFail($id);

    // 🔥 SAMAKAN NAMA DENGAN BLADE
    $whoData = StandarWhoTbu::orderBy('umur_bulan')->get();

    return view('kader.balita.show', compact('balita', 'whoData'));
}
    // =========================
    // DELETE
    // =========================
    public function destroy($id)
    {
        $balita = Balita::findOrFail($id);

        if($balita->user_id){
            User::where('id',$balita->user_id)->delete();
        }

        $balita->delete();

        return redirect()->route('balita.index')
                         ->with('success','Data balita dihapus');
    }

}