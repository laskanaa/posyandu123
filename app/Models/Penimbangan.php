<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

    private function hitungZ($nilai, $l, $m, $s)
    {
        if ($l == 0) {
            return log($nilai / $m) / $s;
        }

        return (pow($nilai / $m, $l) - 1) / ($l * $s);
    }

    public function getHasilAttribute()
    {
        $balita = $this->balita;
        if (!$balita) return null;

        $umur = Carbon::parse($balita->tanggal_lahir)
            ->diffInMonths($this->tanggal_penimbangan);

        $umur = max(0, min(60, $umur)); 

        $jk = $balita->jenis_kelamin;

        $who_bb = DB::table('standar_who_bbu')
            ->where('jenis_kelamin', $jk)
            ->where('umur_bulan', '<=', $umur)
            ->orderBy('umur_bulan', 'desc')
            ->first();

        $who_tb = DB::table('standar_who_tbu')
            ->where('jenis_kelamin', $jk)
            ->where('umur_bulan', '<=', $umur)
            ->orderBy('umur_bulan', 'desc')
            ->first();

        if (!$who_bb || !$who_tb) {
            return [
                'z_bb_u' => '-',
                'status_bb' => '-',
                'z_tb_u' => '-',
                'status_tb' => '-',
                'kesimpulan' => '-'
            ];
        }

        $z_bb = $this->hitungZ(
            $this->berat_badan,
            $who_bb->l,
            $who_bb->m,
            $who_bb->s
        );

        $z_tb = $this->hitungZ(
            $this->tinggi_badan,
            $who_tb->l,
            $who_tb->m,
            $who_tb->s
        );

        if ($z_bb < -3) {
            $status_bb = 'Sangat Kurang';
        } elseif ($z_bb < -2) {
            $status_bb = 'Kurang';
        } elseif ($z_bb <= 2) {
            $status_bb = 'Normal';
        } else {
            $status_bb = 'Lebih';
        }

        if ($z_tb < -3) {
            $status_tb = 'Stunting Berat';
        } elseif ($z_tb < -2) {
            $status_tb = 'Stunting';
        } elseif ($z_tb <= 2) {
            $status_tb = 'Normal';
        } else {
            $status_tb = 'Tinggi';
        }

        return [
            'z_bb_u' => round($z_bb, 2),
            'status_bb' => $status_bb,

            'z_tb_u' => round($z_tb, 2),
            'status_tb' => $status_tb,

            'kesimpulan' => $status_tb . ' (' . $status_bb . ')'
        ];
    }
}