<?php

namespace App\Exports;

use App\Models\Bagian; 
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class BagianExport implements FromView, ShouldAutoSize, WithEvents
{
    public function View(): View
    {
        return view('exports.bagian', [
            'bagian' => Bagian::all()
        ]);
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
