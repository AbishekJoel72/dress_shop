<?php

namespace App\Exports;

use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class UserExport implements FromView, WithEvents
{
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

     public function view(): View
    {
        return view('Export.excel.customer_excel',['users' => $this->users]);
    }

            public function registerEvents(): array
    {
        return [
            AfterSheet::class => function ($event) {
                $startRow = 2;
                $lastRow = count($this->users) + $startRow;
                $event->sheet
                    ->getStyle('A2:E'.$lastRow)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(
                        Border::BORDER_THIN
                    );
                $event->sheet
                    ->getStyle('A2:E2')
                    ->getFont()
                    ->setBold(true);
                foreach (range('A', 'E') as $column) {
                    $event->sheet
                        ->getDelegate()
                        ->getColumnDimension($column)
                        ->setAutoSize(true);
                }
            },
        ];
    }
}
