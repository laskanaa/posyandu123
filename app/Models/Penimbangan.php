<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penimbangan extends Model
{

protected $fillable = [
    'balita_id',
    'tanggal_penimbangan',
    'berat_badan',
    'tinggi_badan',
    'lila',
    'lika',
    'pesan'
];

protected $casts = [
    'tanggal_penimbangan' => 'date'
];

public function balita()
{
    return $this->belongsTo(Balita::class);
}

}