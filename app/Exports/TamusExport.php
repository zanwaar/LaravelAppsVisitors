<?php

namespace App\Exports;

use App\Models\Logtamu;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class TamusExport implements FromQuery, WithMapping, WithHeadings,ShouldAutoSize
{
    use Exportable;

    protected $selectedRows;

    public function __construct($selectedRows)
    {
        $this->selectedRows = $selectedRows;
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->tamu->nama,
            $row->tamu->instansi,
            $row->bagian->namaTenant,
            $row->keperluan,
            $row->checkin,
            $row->checkout,
            $row->foto_url,
        ];
    }

    public function headings(): array
    {
        return [
            '#ID',
            'Nama',
            'Instansi',
            'Tujuan',
            'Keperluan',
            'Tanggal Checkin',
            'Tanggal Checkout',
            'Foto Url',
        ];
    }

    public function query()
    {
        return Logtamu::with(['tamu', 'bagian'])->whereIn('id', $this->selectedRows);
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:F1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
    }
}
