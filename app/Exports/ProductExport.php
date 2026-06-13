<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\View\View;
// use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */


    public function view(): View
    {
        return view('product.product_excel', [
            'product' => Product::with('get_category')->get()
        ]);
    }
}
