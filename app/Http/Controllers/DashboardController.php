<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalAnak      = Anak::count();
        $totalLaki      = Anak::where('jenis_kelamin', 'Laki - Laki')->count();
        $totalPerempuan = Anak::where('jenis_kelamin', 'Perempuan')->count();
        $pengukuranBulanIni = Anak::whereMonth('tanggal_pengukuran', now()->month)
                                   ->whereYear('tanggal_pengukuran', now()->year)
                                   ->count();

        // Data grafik BB/U (Status Berat Badan per Umur)
        $statusBBU = Anak::select('status_bbu', DB::raw('count(*) as total'))
            ->whereNotNull('status_bbu')
            ->groupBy('status_bbu')
            ->pluck('total', 'status_bbu')
            ->toArray();

        // Data grafik TB/U (Status Tinggi Badan per Umur)
        $statusTBU = Anak::select('status_tbu', DB::raw('count(*) as total'))
            ->whereNotNull('status_tbu')
            ->groupBy('status_tbu')
            ->pluck('total', 'status_tbu')
            ->toArray();

        // Data grafik BB/TB (Status Gizi)
        $statusBBTB = Anak::select('status_bbtb', DB::raw('count(*) as total'))
            ->whereNotNull('status_bbtb')
            ->groupBy('status_bbtb')
            ->pluck('total', 'status_bbtb')
            ->toArray();

        // Tren pengukuran 6 bulan terakhir
        $trenBulan = [];
        for ($i = 5; $i >= 0; $i--) {
            $bulan = now()->subMonths($i);
            $trenBulan[] = [
                'label' => $bulan->translatedFormat('M Y'),
                'count' => Anak::whereMonth('tanggal_pengukuran', $bulan->month)
                               ->whereYear('tanggal_pengukuran', $bulan->year)
                               ->count(),
            ];
        }

        // Distribusi umur
        $distribusiUmur = [
            '0-6 bln'   => Anak::whereBetween('umur_bulan', [0, 6])->count(),
            '7-12 bln'  => Anak::whereBetween('umur_bulan', [7, 12])->count(),
            '13-24 bln' => Anak::whereBetween('umur_bulan', [13, 24])->count(),
            '25-36 bln' => Anak::whereBetween('umur_bulan', [25, 36])->count(),
            '37-48 bln' => Anak::whereBetween('umur_bulan', [37, 48])->count(),
            '49-60 bln' => Anak::whereBetween('umur_bulan', [49, 60])->count(),
            '> 60 bln'  => Anak::where('umur_bulan', '>', 60)->count(),
        ];

        // 5 data terbaru
        $dataRecent = Anak::latest('tanggal_pengukuran')->limit(5)->get();

        return view('dashboard', compact(
            'totalAnak', 'totalLaki', 'totalPerempuan', 'pengukuranBulanIni',
            'statusBBU', 'statusTBU', 'statusBBTB',
            'trenBulan', 'distribusiUmur', 'dataRecent'
        ));
    }
}
