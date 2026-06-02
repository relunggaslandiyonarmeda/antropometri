<?php

namespace App\Exports;

use App\Models\Anak;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class AnakExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithTitle
{
    public function __construct(private ?string $search = null, private ?string $statusGizi = null) {}

    public function collection()
    {
        $query = Anak::query();
        if ($this->search) {
            $query->where('nama_anak', 'like', '%' . $this->search . '%')
                  ->orWhere('nik_anak', 'like', '%' . $this->search . '%')
                  ->orWhere('alamat', 'like', '%' . $this->search . '%');
        }
        if ($this->statusGizi) {
            $query->where('status_bbu', $this->statusGizi);
        }

        return $query->orderBy('id')->get()->map(function ($a, $i) {
            return [
                'No'                   => $i + 1,
                'Alamat/Posyandu'      => $a->alamat ?? '-',
                'Tgl Pengukuran'       => $a->tanggal_pengukuran->format('d/m/Y'),
                'Nama Orang Tua'       => $a->nama_orang_tua ?? '-',
                'NIK Anak'             => $a->nik_anak ?? '-',
                'Nama Anak'            => $a->nama_anak,
                'Tanggal Lahir'        => $a->tanggal_lahir->format('d/m/Y'),
                'Umur (Bln)'           => $a->umur_bulan,
                'Jenis Kelamin'        => $a->jenis_kelamin,
                'BB (kg)'              => $a->berat_badan,
                'TB/PB (cm)'           => $a->tinggi_badan,
                'IMT'                  => $a->imt,
                'Z-Score BB/U'         => $a->zscore_bbu,
                'Status BB/U'          => $a->status_bbu ?? '-',
                'Z-Score TB/U'         => $a->zscore_tbu,
                'Status TB/U'          => $a->status_tbu ?? '-',
                'Z-Score BB/TB'        => $a->zscore_bbtb,
                'Status BB/TB'         => $a->status_bbtb ?? '-',
                'Z-Score IMT/U'        => $a->zscore_imtu,
                'Status IMT/U'         => $a->status_imtu ?? '-',
                'Keterangan'           => $a->keterangan ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No', 'Alamat/Posyandu', 'Tgl Pengukuran', 'Nama Orang Tua',
            'NIK Anak', 'Nama Anak', 'Tanggal Lahir', 'Umur (Bln)',
            'Jenis Kelamin', 'BB (kg)', 'TB/PB (cm)', 'IMT',
            'Z-Score BB/U', 'Status BB/U',
            'Z-Score TB/U', 'Status TB/U',
            'Z-Score BB/TB', 'Status BB/TB',
            'Z-Score IMT/U', 'Status IMT/U',
            'Keterangan',
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1a6fa8']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
        ];
    }

    public function title(): string
    {
        return 'Data Antropometri';
    }
}
