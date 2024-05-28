<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RankingController extends Controller
{
    public function assessmentsFilled()
    {
        // Check if assessments are filled (adjust this based on your data structure)
        $assessments = Penilaian::all(); // Replace it with your actual assessment model
        // if ($assessments->count() < 2) {
        //     return false;
        // }

        return $assessments->isNotEmpty();
    }
    public function index(){

        if (!$this->assessmentsFilled()) {

            // Redirect back or to a specific page with a message
            return redirect()->route('penilaian.index')->with('error', 'Please fill out the assessments before viewing the ranking.');
        }

        $kriteria = Kriteria::all();
        $alternatif = Alternatif::all();
        $penilaian = Penilaian::with(['alternatif', 'kriteria'])->get();

        $desiredDecimalPlaces = 2; // Ganti jumlah desimal

        // Inisialisasi variabel

        foreach ($kriteria as $k => $v) {
            foreach ($penilaian as $p => $val) {
                if ($v->id == $val->id_kriteria) {
                    $minMax[$v->id][] = $val->value;
                    // $w[$v->id] = $v->bobot;
                }
            }

            // Check if there are values for the current $kriteriaId
            if (!empty($minMax[$v->id])) {
                $values = $minMax[$v->id];
                $maxXi[$v->id] = max($values);
                $minXi[$v->id] = min($values);

                // Initialize $tij and $V for the current $kriteriaId
                $tij[$v->id] = [];
                $V[$v->id] = [];
                $G[$v->id] = 1;
                $Q[$v->id] = [];

                // Normalisasi
                foreach ($values as $value) {
                    if ($v->attribute == "benefit") {
                        $normalizedValue = ($maxXi[$v->id] - $minXi[$v->id]) != 0 ? ($value - $minXi[$v->id]) / ($maxXi[$v->id] - $minXi[$v->id]) : 0;
                    } elseif ($v->attribute == "cost") {
                        $normalizedValue = ($maxXi[$v->id] - $minXi[$v->id]) != 0 ? ($maxXi[$v->id] - $value) / ($maxXi[$v->id] - $minXi[$v->id]) : 0;
                    }

                    // Normalisasi
                    $tij[$v->id][] = number_format($normalizedValue, $desiredDecimalPlaces);

                    // Matriks tertimbang
                    $matriksW =($normalizedValue * $v->bobot) + $v->bobot;
                    $V[$v->id][] =  number_format($matriksW, $desiredDecimalPlaces);

                    $G[$v->id] *= $matriksW;

                }

                // Perhitungan Perkiraan Batas
                $G[$v->id] = number_format(pow($G[$v->id], 1 / count($alternatif)), $desiredDecimalPlaces);

                // Perhitungan elemen matriks jarak alternatif dari daerah perkiraan perbatasan (Q)
                foreach ($V[$v->id] as $value) {
                    $Q[$v->id][] = number_format($value - $G[$v->id], $desiredDecimalPlaces);
                }
            }
        }

        // Perankingan
        foreach($alternatif as $alt){
            $total = 0;
            foreach($kriteria as $kri){
                $key = $alt->id - 1;
                // Check if the key exists in the $Q array
                if (isset($Q[$kri->id][$key])) {
                    $total += $Q[$kri->id][$key];
                } else {
                    // Provide a default value if the key is not set
                    // You can adjust this default value based on your logic
                    $total += 0;
                }
            }

            $rank[$alt->id] = number_format($total, $desiredDecimalPlaces);
        }
        arsort($rank);

        // dd($V, $G,$Q, $rank);

        // Kirim data ke view
        return view('ranking.index', [
            'normalisasi' => $tij,
            'kriteria' => $kriteria,
            'alternatif' => $alternatif,
            'penilaian' => $penilaian,
            'pembobotan' => $V,
            'perkiraanBatas' => $G,
            'jarakAlternatif' => $Q,
            'ranking' => $rank,
        ]);
    }
}
