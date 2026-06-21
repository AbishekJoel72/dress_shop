<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ContactExport implements FromView, WithEvents
{
    protected $contacts;

    public function __construct($contacts)
    {
        $this->contacts = $contacts;
    }

        public function view(): View
    {
        return view('Export.excel.contact_excel',['contacts' => $this->contacts]);
    }

       public function registerEvents(): array
    {
        return [
            AfterSheet::class => function ($event) {
                $startRow = 2;
                $lastRow = count($this->contacts) + $startRow;
                $event->sheet
                    ->getStyle('A2:F'.$lastRow)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(
                        Border::BORDER_THIN
                    );
                $event->sheet
                    ->getStyle('A2:F2')
                    ->getFont()
                    ->setBold(true);
                foreach (range('A', 'F') as $column) {
                    $event->sheet
                        ->getDelegate()
                        ->getColumnDimension($column)
                        ->setAutoSize(true);
                }
            },
        ];
    }
}
