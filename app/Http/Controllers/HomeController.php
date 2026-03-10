<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\TentangPosyandu;
use App\Models\Spm;
use App\Models\Layanan;

class HomeController extends Controller
{
// HomeController.php
public function index()
{
    $tentang = TentangPosyandu::first(); // ambil 1 data saja
    $sliders = Slider::all();
    $spm = Spm::all();
    $layanan = Layanan::all();

    return view('pages.home', compact('tentang', 'sliders', 'spm', 'layanan'));
}
}