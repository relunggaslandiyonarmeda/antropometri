<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\ZScoreService;

class ZScoreServiceTest extends TestCase
{
    public function test_hitung_zscore_is_zero_at_median()
    {
        $sd = ZScoreService::getSDtabelBBU(0, 'Laki - Laki');
        $this->assertIsArray($sd);
        $median = $sd[3];
        $this->assertEquals(0.0, ZScoreService::hitungZScore($median, $sd));
    }

    public function test_status_bbu_for_very_low_z()
    {
        $status = ZScoreService::statusBBU(-3.5);
        $this->assertEquals('Berat Badan Sangat Kurang', $status);
    }
}
