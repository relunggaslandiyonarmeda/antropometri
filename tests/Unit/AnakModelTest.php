<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Anak;

class AnakModelTest extends TestCase
{
    public function test_compute_gizi_returns_expected_keys()
    {
        $data = [
            'tanggal_lahir' => now()->subMonths(1)->toDateString(),
            'tanggal_pengukuran' => now()->toDateString(),
            'berat_badan' => 4.5,
            'tinggi_badan' => 54.0,
            'jenis_kelamin' => 'Laki - Laki',
        ];

        $res = Anak::computeGizi($data);

        $this->assertIsArray($res);
        $this->assertArrayHasKey('umur_bulan', $res);
        $this->assertArrayHasKey('imt', $res);
        $this->assertArrayHasKey('zscore_bbu', $res);
        $this->assertArrayHasKey('status_bbu', $res);
    }
}
