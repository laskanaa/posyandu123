<?php


namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('kader.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('kader.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg'
        ]);

        $gambar = $request->file('gambar');
        $nama_gambar = time().'.'.$gambar->getClientOriginalExtension();
        $gambar->move(public_path('slider'), $nama_gambar);

        Slider::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $nama_gambar
        ]);

        return redirect()->route('kader.slider.index')->with('success','Slider berhasil ditambahkan');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('kader.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        if($request->hasFile('gambar')){
            $gambar = $request->file('gambar');
            $nama_gambar = time().'.'.$gambar->getClientOriginalExtension();
            $gambar->move(public_path('slider'), $nama_gambar);

            $slider->gambar = $nama_gambar;
        }

        $slider->judul = $request->judul;
        $slider->deskripsi = $request->deskripsi;
        $slider->save();

        return redirect()->route('kader.slider.index');
    }

    public function destroy($id)
    {
        Slider::destroy($id);
        return back();
    }
}