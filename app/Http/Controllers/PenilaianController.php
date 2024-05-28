<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PenilaianRequest;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;

class PenilaianController extends Controller
{
    function index(){
        $kriteria = Kriteria::all();
        $alternatif = Alternatif::all();
        $penilaian = Penilaian::with(['alternatif', 'kriteria'])->get();
        return view("penilaian.index", compact('kriteria', 'penilaian', 'alternatif')); 
    }
    public function store(PenilaianRequest $request){
        $request->validate([
            'id_alternatif' => 'required|exists:alternatif,id',
            'nilai.*' => 'required|numeric|min:0|between:0,99.9',
        ]);

        $idAlt = $request->input('id_alternatif');
        $values = $request->input('nilai');

        foreach ($values as $criteriaId => $val) {
            // Check if $criteriaId is numeric, and get the correct criteria ID accordingly
            $criteriaId = is_numeric($criteriaId) ? $criteriaId : $val['id_kriteria'];

            Penilaian::updateOrCreate(
                ['id_alternatif' => $idAlt, 'id_kriteria' => $criteriaId],
                ['value' => $val],
            );
        }

        return redirect()->route('penilaian.index')->with('success','penilaian added sucessfully');
    }

    public function show($id){

    }

    public function edit($id){

    }

    public function update(PenilaianRequest $request, string $id){
        $penilaian = Penilaian::find($id);
        $request->validate([
            'id_alternatif' => 'required|exists:alternatif,id',
            'nilai.*' => 'required|numeric|min:0|between:0,99.9',
        ]);
        $penilaian->update($request->all());
        return redirect()->route('penilaian.index')->with('success','Matriks Penilaian berhasil diupdate');
    }
}
