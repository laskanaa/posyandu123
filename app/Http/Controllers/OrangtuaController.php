<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Balita;

class OrangtuaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // ambil data balita berdasarkan email orang tua
        $balita = Balita::where('email_ortu', $user->email)->first();

        return view('orangtua.dashboard', compact('balita'));
    }
}