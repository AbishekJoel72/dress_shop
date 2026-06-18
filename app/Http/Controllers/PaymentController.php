<?php

namespace App\Http\Controllers;

use App\Exports\PaymentExport;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PaymentController extends Controller
{
    public function PaymentList(Request $request)
    {
        if ($request->ajax()) {
            $query = Payment::with(['get_order', 'get_order.get_user']);
            if ($request->order_no) {
                $query->whereHas('get_order',
                    function ($q) use ($request) {
                        $q->where('order_no', 'LIKE', '%'.$request->order_no.'%');
                    }
                );
            }

            if ($request->customer_name) {
                $query->whereHas('get_order.get_user',
                    function ($q) use ($request) {
                        $q->where('first_name', 'LIKE', '%'.$request->customer_name.'%');
                    }
                );
            }

            if ($request->transaction_id) {
                $query->where('transaction_id', 'LIKE', '%'.$request->transaction_id.'%');
            }

            if ($request->payment_gateway) {
                $query->where('payment_gateway', $request->payment_gateway);
            }

            if ($request->payment_status) {
                $query->where('payment_status', $request->payment_status);
            }

            if ($request->from_date) {
                $from = Carbon::createFromFormat('d-m-Y', $request->from_date)->format('Y-m-d');
                $query->where('paid_at', '>=', $from);
            }

            if ($request->to_date) {
                $to = Carbon::createFromFormat('d-m-Y', $request->to_date)->format('Y-m-d');
                $query->whereDate('paid_at', '<=', $to);
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('customer_name', function ($row) {
                    return ($row->get_order->get_user->first_name ?? '').' '.($row->get_order->get_user->last_name ?? '');
                })
                ->make(true);
        }

        return view('payment.payment_list');
    }

    public function PaymentExport(Request $request)
    {
        $query = Payment::with(['get_order','get_order.get_user',]);

        if ($request->order_no) {
            $query->whereHas('get_order', function ($q) use ($request) {
                $q->where('order_no', 'LIKE', '%'.$request->order_no.'%');
            });
        }

        if ($request->customer_name) {
            $query->whereHas('get_order.get_user', function ($q) use ($request) {
                $q->where('first_name', 'LIKE', '%'.$request->customer_name.'%');
            });
        }

        if ($request->transaction_id) {
            $query->where('transaction_id', 'LIKE', '%'.$request->transaction_id.'%');
        }

        if ($request->payment_gateway) {
            $query->where('payment_gateway', $request->payment_gateway);
        }

        if ($request->payment_status) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->from_date) {
            $from = Carbon::createFromFormat('d-m-Y', $request->from_date)->format('Y-m-d');
            $query->whereDate('paid_at', '>=', $from);
        }

        if ($request->to_date) {
            $to = Carbon::createFromFormat('d-m-Y', $request->to_date)->format('Y-m-d');
            $query->whereDate('paid_at', '<=', $to);
        }

        $payments = $query->get();
        if ($request->type == 'excel') {
            return Excel::download(new PaymentExport($payments),'payment_list.xlsx');
        }


        if ($request->type == 'pdf') {
            $pdf = Pdf::loadView('Export.pdf.payment_pdf',['payments' => $payments]);
            return $pdf->download('payment_list.pdf');
        }
    }
}
