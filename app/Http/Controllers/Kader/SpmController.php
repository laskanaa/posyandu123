<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\Spm;
use Illuminate\Http\Request;

class SpmController extends Controller
{

    public function index()
    {
        $spms = Spm::all();
        return view('kader.spm.index', compact('spms'));
    }

    public function create()
    {
        return view('kader.spm.create');
    }

    public function store(Request $request)
    {
        Spm::create($request->all());
        return redirect()->route('kader.spm.index')
            ->with('success','Data berhasil ditambah');
    }

    public function edit($id)
    {
        $spm = Spm::findOrFail($id);
        return view('kader.spm.edit', compact('spm'));
    }

    public function update(Request $request, $id)
    {
        $spm = Spm::findOrFail($id);

        $spm->update($request->all());

        return redirect()->route('kader.spm.index')
            ->with('success','Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Spm::findOrFail($id)->delete();

        return redirect()->route('kader.spm.index')
            ->with('success','Data berhasil dihapus');
    }

}