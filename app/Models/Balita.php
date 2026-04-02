<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\StandarWhoTbu;

class Balita extends Model
{
    protected $fillable = [
        'nama', 'nik', 'tempat_lahir', 'tanggal_lahir', 
        'nama_ibu', 'jenis_kelamin', 'user_id'
    ];

    // ← INI YANG PENTING (supaya accessor kondisi aktif)
    protected $appends = ['kondisi', 'umur_bulan'];

    // Relasi
    public function penimbangans()
    {
        return $this->hasMany(Penimbangan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ================== KONDISI OTOMATIS ==================
    public function getKondisiAttribute()
    {
        $penimbanganTerbaru = $this->penimbangans()->latest()->first();

        if (!$penimbanganTerbaru || $this->umur_bulan < 3) {
            return 'Belum dihitung';
        }

        $tinggi = $penimbanganTerbaru->tinggi_badan;
        $umur   = floor($this->umur_bulan);
        $jk     = $this->jenis_kelamin;

        $standar = StandarWhoTbu::where('jenis_kelamin', $jk)
                    ->where('umur_bulan', '<=', $umur)
                    ->orderBy('umur_bulan', 'desc')
                    ->first();

        if (!$standar) {
            $standar = StandarWhoTbu::where('jenis_kelamin', $jk)
                        ->orderBy('umur_bulan', 'asc')
                        ->first();
        }

        if (!$standar) {
            return 'Belum dihitung';
        }

        if ($tinggi < $standar->minus_3sd) return 'Stunting Berat';
        if ($tinggi < $standar->minus_2sd) return 'Stunting';
        if ($tinggi > $standar->plus_2sd) return 'Tinggi';
        return 'Normal';
    }

    public function getUmurBulanAttribute()
    {
        $lahir = Carbon::parse($this->tanggal_lahir);
        $umurHari = $lahir->diffInDays(Carbon::now());
        return round($umurHari / 30.4375 * 2) / 2;
    }
}