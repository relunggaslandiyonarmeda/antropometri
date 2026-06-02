<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Anak extends Model
{
    protected $table = 'anak';

    protected $fillable = [
        'alamat', 'tanggal_pengukuran', 'nama_orang_tua', 'nik_anak',
        'nama_anak', 'tanggal_lahir', 'umur_bulan', 'jenis_kelamin',
        'berat_badan', 'tinggi_badan', 'imt',
        'zscore_bbu', 'status_bbu',
        'zscore_tbu', 'status_tbu',
        'zscore_bbtb', 'status_bbtb',
        'zscore_imtu', 'status_imtu',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_pengukuran' => 'date',
        'tanggal_lahir'      => 'date',
    ];

    /**
     * Hitung umur dalam bulan dari tanggal lahir ke tanggal pengukuran
     */
    public function getUmurTahunBulanAttribute(): string
    {
        $lahir = Carbon::parse($this->tanggal_lahir);
        $ukur  = Carbon::parse($this->tanggal_pengukuran);
        $thn   = $lahir->diffInYears($ukur);
        $bln   = $lahir->copy()->addYears($thn)->diffInMonths($ukur);
        return "{$thn} Tahun {$bln} Bulan";
    }

    /**
     * Hitung IMT = BB / (TB/100)^2
     */
    public static function hitungIMT(float $bb, float $tb): float
    {
        if ($tb <= 0) return 0;
        return round($bb / pow($tb / 100, 2), 2);
    }

    /**
     * Hitung umur dalam bulan
     */
    public static function hitungUmurBulan(string $tanggalLahir, string $tanggalPengukuran): int
    {
        $lahir = Carbon::parse($tanggalLahir);
        $ukur  = Carbon::parse($tanggalPengukuran);
        return (int) $lahir->diffInMonths($ukur);
    }
}
