<?php

namespace App\Http\Controllers;

use App\Exports\AnakExport;
use App\Models\Anak;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    private function getQuery(Request $request)
    {
        $query = Anak::query();
        if ($request->filled('search')) {
            $query->where('nama_anak', 'like', '%' . $request->search . '%')
                  ->orWhere('nik_anak', 'like', '%' . $request->search . '%')
                  ->orWhere('alamat', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status_gizi')) {
            $query->where('status_bbu', $request->status_gizi);
        }
        return $query->orderBy('id');
    }

    public function pdf(Request $request)
    {
        $data = $this->getQuery($request)->get();
        $pdf  = Pdf::loadView('laporan.pdf', compact('data'))
                   ->setPaper('a4', 'landscape')
                   ->setOption(['defaultFont' => 'DejaVu Sans', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => false]);
        return $pdf->download('laporan-antropometri-' . now()->format('Ymd') . '.pdf');
    }

    public function excel(Request $request)
    {
        $filename = 'laporan-antropometri-' . now()->format('Ymd') . '.xlsx';
        return Excel::download(
            new AnakExport($request->search, $request->status_gizi),
            $filename
        );
    }

    public function csv(Request $request)
    {
        $filename = 'laporan-antropometri-' . now()->format('Ymd') . '.csv';
        return Excel::download(
            new AnakExport($request->search, $request->status_gizi),
            $filename,
            \Maatwebsite\Excel\Excel::CSV,
            ['Content-Type' => 'text/csv']
        );
    }
}
