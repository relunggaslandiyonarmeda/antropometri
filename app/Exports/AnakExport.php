<?php

namespace App\Exports;

use App\Models\Anak;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class AnakExport implements FromView, WithHeadings, WithStyles, ShouldAutoSize, WithTitle, WithEvents
{
    public function __construct(private ?string $search = null, private ?string $statusGizi = null) {}

    public function view(): View
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

        return view('exports.anak', [
            'data' => $query->orderBy('id')->get(),
        ]);
    }

    public function headings(): array
    {
        return [
            'No',
            'Alamat/Posyandu',
            'Tgl Pengukuran',
            'Nama Orang Tua',
            'NIK Anak',
            'Nama Anak',
            'Tanggal Lahir',
            'Umur (Bln)',
            'JK',
            'BB (kg)',
            'TB/PB (cm)',
            'IMT',
            'Z-Score BB/U',
            'Status BB/U',
            'Z-Score TB/U',
            'Status TB/U',
            'Z-Score BB/TB',
            'Status BB/TB',
            'Z-Score IMT/U',
            'Status IMT/U',
            'Keterangan',
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 9],
                'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '0F3D5C']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '1F3B5A']]],
            ],
        ];
    }

    public function title(): string
    {
        return 'Data Antropometri';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                $lastRow = $sheet->getHighestRow();

                // Apply styling to data rows
                for ($row = 2; $row <= $lastRow; $row++) {
                    $isOdd = ($row % 2 == 0);
                    $bgColor = $isOdd ? 'EAF2FB' : 'FFFFFF';

                    // Format numeric columns: 2 dec BB/TB/IMT, 2 dec age
                    $bbCell  = 'J' . $row;
                    $tbCell  = 'K' . $row;
                    $imtCell = 'L' . $row;

                    $sheet->getDelegate()->getStyle($bbCell)->getNumberFormat()->setFormatCode('0.00');
                    $sheet->getDelegate()->getStyle($tbCell)->getNumberFormat()->setFormatCode('0.00');
                    $sheet->getDelegate()->getStyle($imtCell)->getNumberFormat()->setFormatCode('0.00');

                    // Z-score columns: 2 dec
                    foreach (['M', 'O', 'Q', 'S'] as $col) {
                        $sheet->getDelegate()->getStyle($col . $row)->getNumberFormat()->setFormatCode('0.00');
                    }

                    // Status column background and font color
                    $statusMap = [
                        'N' => 'Berat Badan Sangat Kurang',
                        'P' => 'Berat Badan Kurang',
                        'Q' => 'Berat Badan Normal',
                        'R' => 'Risiko Berat Badan Lebih',
                        'S' => 'Berat Badan Lebih',
                    ];

                    foreach ($statusMap as $col => $value) {
                        $cellValue = $sheet->getDelegate()->getCell($col . $row)->getValue();
                        $style = [
                            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CBD5E1']]],
                            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                            'font' => ['bold' => true, 'size' => 7],
                        ];

                        if (strcasecmp((string) $cellValue, (string) $value) === 0) {
                            $colorMap = [
                                'Berat Badan Sangat Kurang' => 'FF6B6B',
                                'Berat Badan Kurang'        => 'FFA07A',
                                'Berat Badan Normal'        => '90EE90',
                                'Risiko Berat Badan Lebih'  => '87CEEB',
                                'Berat Badan Lebih'         => 'DDA0DD',
                            ];
                            $bg = $colorMap[$value] ?? 'FFFFFF';
                            $style['fill'] = ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $bg]];
                            $textColorMap = [
                                'Berat Badan Sangat Kurang' => '7B0000',
                                'Berat Badan Kurang'        => '7B3600',
                                'Berat Badan Normal'        => '004D00',
                                'Risiko Berat Badan Lebih'  => '003366',
                                'Berat Badan Lebih'         => '4B0066',
                            ];
                            $style['font']['color'] = ['rgb' => $textColorMap[$value] ?? '000000'];
                        } else {
                            $style['fill'] = ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $bgColor]];
                        }

                        $sheet->getDelegate()->getStyle($col . $row)->applyFromArray($style);
                    }

                    // Apply alternating background to remaining cells
                    $remainingCols = ['A','B','C','D','E','F','G','H','I','J','K','L','M','T','U'];
                    foreach ($remainingCols as $col) {
                        $sheet->getDelegate()->getStyle($col . $row)->applyFromArray([
                            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $bgColor]],
                            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CBD5E1']]],
                            'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
                        ]);
                    }
                }

                // Auto filter for header row
                $sheet->getDelegate()->setAutoFilter('A1:' . $sheet->getHighestColumn() . '1');

                // Freeze top row
                $sheet->getDelegate()->freezePane('A2');

                // Set default row height
                for ($row = 2; $row <= $lastRow; $row++) {
                    $sheet->getDelegate()->getRowDimension($row)->setRowHeight(14);
                }
            },
        ];
    }
}
