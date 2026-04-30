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
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class BalitaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $balitas = Balita::with(['penimbangans' => function($q){
    $q->orderBy('tanggal_penimbangan','asc');
}])
            ->when($search, function ($query) use ($search) {
                $query->where('nama', 'like', "%$search%")
                    ->orWhere('nama_ibu', 'like', "%$search%");
            })
            ->orderBy('nama','asc')
            ->get();

        return view('kader.balita.index', compact('balitas'));
    }

    public function dashboard()
    {
        $balita = Balita::where('user_id', Auth::id())->first();
        return view('orangtua.dashboard', compact('balita'));
    }

    public function create()
    {
        return view('kader.balita.create');
    }

    public function edit($id)
    {
        $balita = Balita::findOrFail($id);
        $penimbangan = $balita->penimbangans()->latest()->first();

        return view('kader.balita.edit', compact('balita', 'penimbangan'));
    }

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

        $balita->update([
            'nama'          => $request->nama,
            'nik'           => $request->nik,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nama_ibu'      => $request->nama_ibu,
        ]);

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

        $user = User::create([
            'name'     => $request->nama_ibu,
            'email'    => $request->nik . '@ortu.posyandu',
            'password' => Hash::make($request->nama_ibu),
            'role'     => 'orang_tua'
        ]);

        $balita = Balita::create([
            'user_id'       => $user->id,
            'nama'          => $request->nama,
            'nik'           => $request->nik,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nama_ibu'      => $request->nama_ibu,
        ]);

        Penimbangan::create([
            'balita_id'          => $balita->id,
            'tanggal_penimbangan' => $request->tanggal_lahir,
            'berat_badan'        => $request->berat_badan,
            'tinggi_badan'       => $request->tinggi_badan,
            'lila'               => $request->lila,
            'lika'               => $request->lika,
            'pesan'              => $request->pesan ?? null,
        ]);

        return redirect()->route('balita.index')
                         ->with('success', 'Data balita berhasil ditambahkan');
    }
    public function show($id)
{
    $balita = Balita::with([
        'user',
        'penimbangans' => function($q){
            $q->orderBy('tanggal_penimbangan','asc');
        }
    ])->findOrFail($id);

    $whoBBU = DB::table('standar_who_bbu')->orderBy('umur_bulan')->get();
    $whoTBU = DB::table('standar_who_tbu')->orderBy('umur_bulan')->get();

    $penimbanganTerakhir = $balita->penimbangans->last();

    return view('kader.balita.show', compact(
        'balita',
        'whoBBU',
        'whoTBU',
        'penimbanganTerakhir'
    ));
}
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
    public function download($id)
    {
        $balita = Balita::with([
            'user',
            'penimbangans' => function ($q) {
                $q->orderBy('tanggal_penimbangan', 'asc');
            }
        ])->findOrFail($id);

        $pdf = Pdf::loadView('kader.balita.pdf', compact('balita'));

        return $pdf->download('data-balita-' . $balita->nama . '.pdf');
    }

}