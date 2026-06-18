<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class FavouriteExport implements FromView, WithEvents
{
    protected $favourites;

    public function __construct($favourites)
    {
        $this->favourites = $favourites;
    }

    public function view(): View
    {
        return view('Export.excel.favourites_excel',['favourites' => $this->favourites]);
    }

            public function registerEvents(): array
    {
        return [
            AfterSheet::class => function ($event) {
                $startRow = 2;
                $lastRow = count($this->favourites) + $startRow;
                $event->sheet
                    ->getStyle('A2:I'.$lastRow)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(
                        Border::BORDER_THIN
                    );
                $event->sheet
                    ->getStyle('A2:I2')
                    ->getFont()
                    ->setBold(true);
                foreach (range('A', 'I') as $column) {
                    $event->sheet
                        ->getDelegate()
                        ->getColumnDimension($column)
                        ->setAutoSize(true);
                }
            },
        ];
    }
}
