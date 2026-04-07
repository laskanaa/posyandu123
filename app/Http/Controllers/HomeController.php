<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\TentangPosyandu;
use App\Models\Layanan;
use App\Models\Pencegahan;;
use App\Models\Informasi;
use App\Models\Galeri;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'sliders' => Slider::all(),
            'tentang' => TentangPosyandu::first(),
            'layanan' => Layanan::all(),
            'pencegahans' => Pencegahan::all(),
            'informasi' => Informasi::all(),
            'galeri' => Galeri::latest()->take(3)->get(),
        ]);
    }
}