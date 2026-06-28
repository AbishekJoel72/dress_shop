<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;


class PaymentRefundExport implements FromView, WithEvents
{
    protected $refunds;

    public function __construct($refunds)
    {
        $this->refunds = $refunds;
    }

    public function view(): View
    {
        return view('Export.excel.payment_refund_excel', ['refunds' => $this->refunds]);
    }

        public function registerEvents(): array
    {
        return [
            AfterSheet::class => function ($event) {
                $startRow = 2;
                $lastRow = count($this->refunds) + $startRow;
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
