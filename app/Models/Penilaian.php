<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $table = 'penilaian';
    protected $fillable = [
        'id_kriteria',
        'id_alternatif',
        'value',
    ] ;

    public function kriteria(){
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }

    public function alternatif(){
        return $this->belongsTo(Alternatif::class,'id_alternatif');
    }
}
