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

    // accessor otomatis
    protected $appends = ['kondisi', 'umur_bulan'];

    // ================= RELASI =================
    public function penimbangans()
    {
        return $this->hasMany(Penimbangan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ================= UMUR (BULAN) =================
    public function getUmurBulanAttribute()
    {
        $lahir = Carbon::parse($this->tanggal_lahir);

        // 🔥 umur dalam bulan (standar WHO)
        return $lahir->diffInMonths(Carbon::now());
    }

    // ================= KONDISI OTOMATIS =================
    public function getKondisiAttribute()
    {
        $penimbangan = $this->penimbangans()->latest()->first();

        // kalau belum ada data
        if (!$penimbangan) {
            return 'Belum dihitung';
        }

        // 🔥 pakai BERAT BADAN (sesuai grafik kamu)
        $nilai = $penimbangan->berat_badan;

        // 🔥 ambil umur (dibulatkan & dibatasi)
        $umur = round($this->umur_bulan);
        $umur = min($umur, 60);

        $jk = $this->jenis_kelamin;

        // 🔥 ambil standar WHO sesuai umur & gender
        $standar = StandarWhoTbu::where('jenis_kelamin', $jk)
            ->where('umur_bulan', $umur)
            ->first();

        if (!$standar) {
            return 'Belum dihitung';
        }

        // ================= LOGIKA WHO =================

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