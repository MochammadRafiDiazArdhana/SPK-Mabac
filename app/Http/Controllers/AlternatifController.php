<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    function index(){
        $alternatif = Alternatif::all();
        return view('alternatif.index', compact("alternatif"));
    }
    public function store(Request $request){
        $request->validate([
            "name_alternatif"=> "required|string",
        ]);
        $alternatif = Alternatif::create($request->all());

        return redirect()->route("alternatif.index")
            ->with("success","Alternatif berhasil diperbaharui");
    }

    public function edit(Alternatif $alternatif){
        $alternatif = Alternatif::find($alternatif->id);
        return view("alternatif.edit", compact("alternatif"));
    }

    public function update(Request $request, string $id){
        $alternatif = Alternatif::find($id);
        $alternatif->update($request->all());
        return redirect()->route("alternatif.index");
    }

    public function destroy(Alternatif $alternatif){
        $alternatif->penilaian()->delete();
        $alternatif->delete();
        return redirect()->route("alternatif.index")->with("success","Alternatif berhasil dihapus");
    }
}
