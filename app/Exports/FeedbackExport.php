<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class FeedbackExport implements FromView, WithEvents
{
    protected $feedbacks;

    public function __construct($feedbacks)
    {
        $this->feedbacks = $feedbacks;
    }

    public function view(): View
    {
        return view('Export.excel.feedback_excel', ['feedbacks' => $this->feedbacks]);
    }

        public function registerEvents(): array
    {
        return [
            AfterSheet::class => function ($event) {
                $startRow = 2;
                $lastRow = count($this->feedbacks) + $startRow;
                $event->sheet
                    ->getStyle('A2:H'.$lastRow)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(
                        Border::BORDER_THIN
                    );
                $event->sheet
                    ->getStyle('A2:H2')
                    ->getFont()
                    ->setBold(true);
                foreach (range('A', 'H') as $column) {
                    $event->sheet
                        ->getDelegate()
                        ->getColumnDimension($column)
                        ->setAutoSize(true);
                }
            },
        ];
    }
}
