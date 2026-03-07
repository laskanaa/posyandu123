<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Balita;
use App\Models\User;
use App\Models\Penimbangan;
use Illuminate\Support\Facades\Hash;
use App\Models\StandarWhoTbu;
use Carbon\Carbon;

class BalitaController extends Controller
{

// =========================
// INDEX
// =========================
public function index()
{
    $balitas = Balita::orderBy('nama','asc')->get();
    return view('kader.balita.index', compact('balitas'));

    $search = $request->search;

    $balitas = Balita::when($search, function ($query) use ($search) {
        $query->where('nama','like',"%$search%")
              ->orWhere('nama_ibu','like',"%$search%");
    })
    ->orderBy('nama','asc')
    ->get();

    return view('kader.balita.index', compact('balitas'));
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
    return view('kader.balita.edit', compact('balita'));
}


// =========================
// UPDATE
// =========================
public function update(Request $request, $id)
{

$request->validate([
'nama'=>'required',
'nik'=>'required',
'tempat_lahir'=>'required',
'tanggal_lahir'=>'required',
'jenis_kelamin'=>'required',
'nama_ibu'=>'required',
'berat_badan'=>'required',
'tinggi_badan'=>'required',
'lila'=>'required',
'lika'=>'required',
]);

$balita = Balita::findOrFail($id);


// update biodata
$balita->update([
'nama'=>$request->nama,
'nik'=>$request->nik,
'tempat_lahir'=>$request->tempat_lahir,
'tanggal_lahir'=>$request->tanggal_lahir,
'jenis_kelamin'=>$request->jenis_kelamin,
'nama_ibu'=>$request->nama_ibu,
]);


// =========================
// HITUNG UMUR
// =========================
$tanggalLahir = Carbon::parse($request->tanggal_lahir);
$umurBulan = $tanggalLahir->diffInMonths(Carbon::now());


// =========================
// AMBIL STANDAR WHO
// =========================
$standar = StandarWhoTbu::where('jenis_kelamin', $request->jenis_kelamin)
            ->where('umur_bulan','<=',$umurBulan)
            ->orderBy('umur_bulan','desc')
            ->first();

$tb = $request->tinggi_badan;

if($standar){

    if($tb < $standar->minus_3sd){
        $kondisi='Stunting Berat';
    }
    elseif($tb < $standar->minus_2sd){
        $kondisi='Stunting';
    }
    elseif($tb <= $standar->plus_2sd){
        $kondisi='Normal';
    }
    else{
        $kondisi='Tinggi';
    }

}else{

$kondisi='Belum dihitung';

}


// update kondisi
$balita->update([
'kondisi'=>$kondisi
]);


// =========================
// SIMPAN PENIMBANGAN BARU
// =========================
Penimbangan::create([
'balita_id'=>$balita->id,
'tanggal_penimbangan'=>now(),
'berat_badan'=>$request->berat_badan,
'tinggi_badan'=>$request->tinggi_badan,
'lila'=>$request->lila,
'lika'=>$request->lika
]);

return redirect()->route('balita.show',$balita->id)
->with('success','Data berhasil diperbarui');

}



// =========================
// STORE
// =========================
public function store(Request $request)
{

$request->validate([
'nama'=>'required',
'nik'=>'required|unique:balitas,nik',
'tempat_lahir'=>'required',
'tanggal_lahir'=>'required',
'nama_ibu'=>'required',
'jenis_kelamin'=>'required',
'berat_badan'=>'required',
'tinggi_badan'=>'required',
'lila'=>'required',
'lika'=>'required',
]);


// =========================
// HITUNG UMUR
// =========================
$tanggalLahir = Carbon::parse($request->tanggal_lahir);
$umurBulan = $tanggalLahir->diffInMonths(Carbon::now());


// =========================
// AMBIL STANDAR WHO
// =========================
$standar = StandarWhoTbu::where('jenis_kelamin',$request->jenis_kelamin)
            ->where('umur_bulan','<=',$umurBulan)
            ->orderBy('umur_bulan','desc')
            ->first();

$tb = $request->tinggi_badan;

if($standar){

if($tb < $standar->minus_3sd){
$kondisi='Stunting Berat';
}
elseif($tb < $standar->minus_2sd){
$kondisi='Stunting';
}
elseif($tb <= $standar->plus_2sd){
$kondisi='Normal';
}
else{
$kondisi='Tinggi';
}

}else{

$kondisi='Belum dihitung';

}


// =========================
// BUAT AKUN ORANG TUA
// =========================
$user = User::create([
'name'=>$request->nama_ibu,
'email'=>$request->nik.'@ortu.posyandu',
'password'=>Hash::make($request->nama_ibu),
'role'=>'orang_tua'
]);


// =========================
// SIMPAN BALITA
// =========================
$balita = Balita::create([
'user_id'=>$user->id,
'nama'=>$request->nama,
'nik'=>$request->nik,
'tempat_lahir'=>$request->tempat_lahir,
'tanggal_lahir'=>$request->tanggal_lahir,
'jenis_kelamin'=>$request->jenis_kelamin,
'nama_ibu'=>$request->nama_ibu,
'kondisi'=>$kondisi
]);


// =========================
// PENIMBANGAN PERTAMA
// =========================
Penimbangan::create([
'balita_id'=>$balita->id,
'tanggal_penimbangan'=>now(),
'berat_badan'=>$request->berat_badan,
'tinggi_badan'=>$request->tinggi_badan,
'lila'=>$request->lila,
'lika'=>$request->lika
]);

return redirect()->route('balita.index')
->with('success','Data balita berhasil ditambahkan');

}



// =========================
// SHOW
// =========================
public function show($id)
{

$balita = Balita::with([
'user',
'penimbangans'=>function($q){
$q->orderBy('tanggal_penimbangan','asc');
}
])->findOrFail($id);

return view('kader.balita.show',compact('balita'));

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