<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Services\ZScoreService;

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

    /**
     * Gender options used across app (keep consistent with validations/views)
     */
    public const GENDERS = [
        'Laki - Laki',
        'Perempuan',
    ];

    /**
     * Compute derived antropometri fields (umur_bulan, imt, z-scores, statuses)
     * Accepts an array with keys: tanggal_lahir, tanggal_pengukuran, berat_badan, tinggi_badan, jenis_kelamin
     * Returns associative array of computed fields to merge into model create/update.
     */
    public static function computeGizi(array $data): array
    {
        $umurBulan = self::hitungUmurBulan($data['tanggal_lahir'], $data['tanggal_pengukuran']);
        $imt       = self::hitungIMT((float) $data['berat_badan'], (float) $data['tinggi_badan']);
        $jk        = $data['jenis_kelamin'];
        $bb        = (float) $data['berat_badan'];
        $tb        = (float) $data['tinggi_badan'];

        $sdBBU  = ZScoreService::getSDtabelBBU($umurBulan, $jk);
        $zBBU   = $sdBBU ? ZScoreService::hitungZScore($bb, $sdBBU) : null;

        $sdTBU  = ZScoreService::getSDtabelTBU($umurBulan, $jk);
        $zTBU   = $sdTBU ? ZScoreService::hitungZScore($tb, $sdTBU) : null;

        $sdBBTB = ZScoreService::getSDtabelBBTB($tb, $jk);
        $zBBTB  = $sdBBTB ? ZScoreService::hitungZScore($bb, $sdBBTB) : null;

        $sdIMTU = ZScoreService::getSDtabelIMTU($umurBulan, $jk);
        $zIMTU  = $sdIMTU ? ZScoreService::hitungZScore($imt, $sdIMTU) : null;

        return [
            'umur_bulan'  => $umurBulan,
            'imt'         => $imt,
            'zscore_bbu'  => $zBBU,
            'status_bbu'  => $zBBU !== null ? ZScoreService::statusBBU($zBBU) : null,
            'zscore_tbu'  => $zTBU,
            'status_tbu'  => $zTBU !== null ? ZScoreService::statusTBU($zTBU) : null,
            'zscore_bbtb' => $zBBTB,
            'status_bbtb' => $zBBTB !== null ? ZScoreService::statusBBTB($zBBTB) : null,
            'zscore_imtu' => $zIMTU,
            'status_imtu' => $zIMTU !== null ? ZScoreService::statusIMTU($zIMTU) : null,
        ];
    }
}
