<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

// use Maatwebsite\Excel\Concerns\FromCollection;

class SizeTypeExport implements FromView,WithEvents
{

    protected $size_types;

    public function __construct($size_types)
    {
        $this->size_types = $size_types;
    }
    public function view(): View
    {
        return view('Export.excel.size_type_excel', ['size_types' => $this->size_types]);
    }

        public function registerEvents(): array
    {
        return [
            AfterSheet::class => function ($event) {
                $startRow = 2;
                $lastRow = count($this->size_types) + $startRow;
                $event->sheet
                    ->getStyle('A2:B'.$lastRow)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(
                        Border::BORDER_THIN
                    );

                $event->sheet
                    ->getStyle('A2:B2')
                    ->getFont()
                    ->setBold(true);


                foreach (range('A', 'B') as $column) {
                    $event->sheet
                        ->getDelegate()
                        ->getColumnDimension($column)
                        ->setAutoSize(true);
                }
            },
        ];
    }
}
