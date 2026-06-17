<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class CategoryExport implements FromView, WithEvents
{
    protected $categories;

    public function __construct($categories)
    {
        $this->categories = $categories;
    }

    public function view(): View
    {
        return view('Export.excel.category_excel', ['categories' => $this->categories]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function ($event) {
                $startRow = 2;
                $lastRow = count($this->categories) + $startRow;
                $event->sheet
                    ->getStyle('A2:C'.$lastRow)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(
                        Border::BORDER_THIN
                    );

                $event->sheet
                    ->getStyle('A2:C2')
                    ->getFont()
                    ->setBold(true);


                foreach (range('A', 'C') as $column) {
                    $event->sheet
                        ->getDelegate()
                        ->getColumnDimension($column)
                        ->setAutoSize(true);
                }
            },
        ];
    }
}
