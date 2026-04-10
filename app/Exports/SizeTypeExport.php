<?php

namespace App\Exports;

use App\Models\Sizetype;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

// use Maatwebsite\Excel\Concerns\FromCollection;

class SizeTypeExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('size.size_type_excel', [
            'size_types' => Sizetype::all()
        ]);
    }
}
