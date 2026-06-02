<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anak;
use App\Services\ZScoreService;

class AnakSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'alamat' => 'Posyandu 1', 'tanggal_pengukuran' => '2024-08-15',
                'nama_orang_tua' => 'apri', 'nik_anak' => '343',
                'nama_anak' => 'by apri', 'tanggal_lahir' => '2023-04-06',
                'jenis_kelamin' => 'Laki - Laki', 'berat_badan' => 12.2,
                'tinggi_badan' => 88.0, 'keterangan' => 'anak orang kaya',
            ],
            [
                'alamat' => 'Posyandu 2', 'tanggal_pengukuran' => '2024-08-12',
                'nama_orang_tua' => null, 'nik_anak' => null,
                'nama_anak' => 'al fatih', 'tanggal_lahir' => '2023-08-05',
                'jenis_kelamin' => 'Perempuan', 'berat_badan' => 7.0,
                'tinggi_badan' => 110.0, 'keterangan' => null,
            ],
            [
                'alamat' => 'Posyandu 3', 'tanggal_pengukuran' => '2024-08-15',
                'nama_orang_tua' => null, 'nik_anak' => null,
                'nama_anak' => 'by rian', 'tanggal_lahir' => '2024-04-11',
                'jenis_kelamin' => 'Perempuan', 'berat_badan' => 7.0,
                'tinggi_badan' => 59.0, 'keterangan' => null,
            ],
            [
                'alamat' => 'Posyandu 1', 'tanggal_pengukuran' => '2024-08-16',
                'nama_orang_tua' => null, 'nik_anak' => null,
                'nama_anak' => 'rte', 'tanggal_lahir' => '2024-06-03',
                'jenis_kelamin' => 'Laki - Laki', 'berat_badan' => 3.0,
                'tinggi_badan' => 46.0, 'keterangan' => null,
            ],
            [
                'alamat' => 'Posyandu 1', 'tanggal_pengukuran' => '2024-09-19',
                'nama_orang_tua' => null, 'nik_anak' => null,
                'nama_anak' => 'andri', 'tanggal_lahir' => '2024-02-09',
                'jenis_kelamin' => 'Perempuan', 'berat_badan' => 23.0,
                'tinggi_badan' => 47.0, 'keterangan' => null,
            ],
            [
                'alamat' => 'Kampung Rendang', 'tanggal_pengukuran' => '2024-09-19',
                'nama_orang_tua' => null, 'nik_anak' => null,
                'nama_anak' => 'by rike', 'tanggal_lahir' => '2024-08-01',
                'jenis_kelamin' => 'Perempuan', 'berat_badan' => 4.0,
                'tinggi_badan' => 50.0, 'keterangan' => null,
            ],
        ];

        foreach ($data as $row) {
            $umurBulan = Anak::hitungUmurBulan($row['tanggal_lahir'], $row['tanggal_pengukuran']);
            $imt       = Anak::hitungIMT($row['berat_badan'], $row['tinggi_badan']);
            $jk        = $row['jenis_kelamin'];
            $bb        = $row['berat_badan'];
            $tb        = $row['tinggi_badan'];

            $sdBBU  = ZScoreService::getSDtabelBBU($umurBulan, $jk);
            $zBBU   = $sdBBU  ? ZScoreService::hitungZScore($bb, $sdBBU)  : null;
            $sdTBU  = ZScoreService::getSDtabelTBU($umurBulan, $jk);
            $zTBU   = $sdTBU  ? ZScoreService::hitungZScore($tb, $sdTBU)  : null;
            $sdBBTB = ZScoreService::getSDtabelBBTB($tb, $jk);
            $zBBTB  = $sdBBTB ? ZScoreService::hitungZScore($bb, $sdBBTB) : null;
            $sdIMTU = ZScoreService::getSDtabelIMTU($umurBulan, $jk);
            $zIMTU  = $sdIMTU ? ZScoreService::hitungZScore($imt, $sdIMTU) : null;

            Anak::create(array_merge($row, [
                'umur_bulan'  => $umurBulan,
                'imt'         => $imt,
                'zscore_bbu'  => $zBBU,
                'status_bbu'  => $zBBU  !== null ? ZScoreService::statusBBU($zBBU)   : null,
                'zscore_tbu'  => $zTBU,
                'status_tbu'  => $zTBU  !== null ? ZScoreService::statusTBU($zTBU)   : null,
                'zscore_bbtb' => $zBBTB,
                'status_bbtb' => $zBBTB !== null ? ZScoreService::statusBBTB($zBBTB) : null,
                'zscore_imtu' => $zIMTU,
                'status_imtu' => $zIMTU !== null ? ZScoreService::statusIMTU($zIMTU) : null,
            ]));
        }
    }
}
