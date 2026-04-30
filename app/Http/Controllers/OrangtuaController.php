<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Balita;
use Illuminate\Support\Facades\DB;

class OrangtuaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $balita = Balita::with([
            'user',
            'penimbangans' => function($q){
                $q->orderBy('tanggal_penimbangan','asc');
            }
        ])->where('user_id', $user->id)->first();

        $whoBBU = DB::table('standar_who_bbu')->orderBy('umur_bulan')->get();
        $whoTBU = DB::table('standar_who_tbu')->orderBy('umur_bulan')->get();

        $penimbanganTerakhir = $balita?->penimbangans->last();

        return view('orangtua.dashboard', compact(
            'balita',
            'whoBBU',
            'whoTBU',
            'penimbanganTerakhir'
        ));
    }
}