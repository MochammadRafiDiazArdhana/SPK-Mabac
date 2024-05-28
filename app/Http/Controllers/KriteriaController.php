<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    function index(){
        $kriteria = Kriteria::all();
        return view('kriteria.index', compact('kriteria'));
    }
    public function store(Request $request){
        $request -> validate([
            'name_kriteria' => 'required|string',
            'attribute'     => 'required|string',
            'bobot'         => 'required|numeric|min:0|max:100',
        ]);

        Kriteria::create([
            'name_kriteria'=> $request->get('name_kriteria'),
            'attribute'=> $request->get('attribute'),
            'bobot'=> $request->get('bobot'),
        ]);

        return redirect()->route('kriteria.index')->with('success','Kriteria berhasil ditambahkan');
    }

    public function edit(string $id){
        $kriteria = Kriteria::find($id);
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, string $id){
        $kriteria = Kriteria::find($id);

        $request -> validate([
            'name_kriteria' => 'required|string',
            'attribute'     => 'required|string',
            'bobot'         => 'required|numeric|min:0|max:100',
        ]);

        $kriteria->update($request->all());
        return redirect()->route('kriteria.index')
        ->with('success', 'Kriteria berhasil diupdate');
    }

    public function destroy(string $id){
        Kriteria::find($id)->delete();
        return redirect()->route('kriteria.index')->with('success','Kriteria berhasil dihapus');
    }   
}
