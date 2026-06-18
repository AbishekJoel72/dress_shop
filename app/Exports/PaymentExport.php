<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PaymentExport implements FromView, WithEvents
{
    protected $payments;

    public function __construct($payments)
    {
        $this->payments = $payments;
    }

    public function view(): View
    {
        return view('Export.excel.payment_excel', ['payments' => $this->payments]);
    }

        public function registerEvents(): array
    {
        return [
            AfterSheet::class => function ($event) {
                $startRow = 2;
                $lastRow = count($this->payments) + $startRow;
                $event->sheet
                    ->getStyle('A2:G'.$lastRow)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(
                        Border::BORDER_THIN
                    );
                $event->sheet
                    ->getStyle('A2:G2')
                    ->getFont()
                    ->setBold(true);
                foreach (range('A', 'G') as $column) {
                    $event->sheet
                        ->getDelegate()
                        ->getColumnDimension($column)
                        ->setAutoSize(true);
                }
            },
        ];
    }
}
