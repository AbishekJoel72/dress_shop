<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PaymentController extends Controller
{
    public function PaymentList(Request $request)
    {
        if ($request->ajax()) {


            $data = Payment::with('get_order', 'get_order.get_product')
                ->where('payment_status','!=', '0')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('payment.payment_list');
    }
}
