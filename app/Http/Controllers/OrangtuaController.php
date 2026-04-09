<?php

namespace App\Http\Controllers;
use App\Models\StandarWhoTbu;

use Illuminate\Support\Facades\Auth;
use App\Models\Balita;

class OrangtuaController extends Controller
{
public function dashboard()
{
    $user = Auth::user();

    $balita = Balita::with(['penimbangans' => function($q){
        $q->orderBy('tanggal_penimbangan','asc');
    }])->where('user_id', $user->id)->first();

    // 🔥 TAMBAH INI
    $whoData = StandarWhoTbu::orderBy('umur_bulan')->get();

    // 🔥 KIRIM KE VIEW
    return view('orangtua.dashboard', compact('balita', 'whoData'));
}
}