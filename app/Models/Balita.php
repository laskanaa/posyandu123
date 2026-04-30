<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\StandarWhoTbu;

class Balita extends Model
{
    protected $fillable = [
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'nama_ibu',
        'jenis_kelamin',
        'user_id'
    ];

    protected $appends = ['kondisi', 'umur_bulan'];

    public function penimbangans()
    {
        return $this->hasMany(Penimbangan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUmurBulanAttribute()
    {
        $lahir = Carbon::parse($this->tanggal_lahir);

        return $lahir->diffInMonths(Carbon::now());
    }

    public function getKondisiAttribute()
    {
        $penimbangan = $this->penimbangans()->latest()->first();
        if (!$penimbangan) {
            return 'Belum dihitung';
        }

        $nilai = $penimbangan->berat_badan;

        $umur = round($this->umur_bulan);
        $umur = min($umur, 60);

        $jk = $this->jenis_kelamin;

        $standar = StandarWhoTbu::where('jenis_kelamin', $jk)
            ->where('umur_bulan', $umur)
            ->first();

        if (!$standar) {
            return 'Belum dihitung';
        }

        if ($nilai < $standar->minus_3sd) {
            return 'Stunting Berat';
        }

        if ($nilai < $standar->minus_2sd) {
            return 'Stunting';
        }

        if ($nilai > $standar->plus_2sd) {
            return 'Tinggi';
        }

        return 'Normal';
    }
}