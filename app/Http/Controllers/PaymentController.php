<?php

namespace App\Http\Controllers;

use App\Exports\PaymentExport;
use App\Exports\PaymentRefundExport;
use App\Models\Payment;
use App\Models\PaymentRefund;
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
            $query = Payment::with(['get_order', 'get_order.get_user'])->whereNot('payment_status', 'refunded');
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
        $query = Payment::with(['get_order', 'get_order.get_user']);

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
            return Excel::download(new PaymentExport($payments), 'payment_list.xlsx');
        }

        if ($request->type == 'pdf') {
            $pdf = Pdf::loadView('Export.pdf.payment_pdf', ['payments' => $payments]);

            return $pdf->download('payment_list.pdf');
        }
    }

    public function PaymentRefund(Request $request)
    {
        if ($request->ajax()) {

            $query = PaymentRefund::with([
                'get_payment.get_order.get_user',
            ]);

            if ($request->from_date) {
                $query->whereDate('refund_date', '>=', $request->from_date);
            }

            if ($request->to_date) {
                $query->whereDate('refund_date', '<=', $request->to_date);
            }

            if ($request->payment_method) {
                $query->whereHas('get_payment', function ($q) use ($request) {
                    $q->where('payment_gateway', $request->payment_method);
                });
            }

            if ($request->order_no) {
                $query->whereHas('get_payment.get_order', function ($q) use ($request) {
                    $q->where('order_no', 'like', '%'.$request->order_no.'%');
                });
            }

            if ($request->customer_name) {
                $query->whereHas('get_payment.get_order.get_user', function ($q) use ($request) {
                    $q->whereRaw("CONCAT(first_name,' ',last_name) LIKE ?", ['%'.$request->customer_name.'%']);
                });
            }

            $query = $query->get();

            return DataTables::of($query)
                ->addIndexColumn()

                ->addColumn('customer_name', function ($row) {
                    return ($row->get_payment->get_order->get_user->first_name ?? '').' '.
                           ($row->get_payment->get_order->get_user->last_name ?? '');
                })

                ->addColumn('order_no', function ($row) {
                    return $row->get_payment->get_order->order_no ?? '-';
                })

                ->addColumn('payment_method', function ($row) {
                    return $row->get_payment->payment_gateway ?? '-';
                })

                ->addColumn('transaction_id', function ($row) {
                    return $row->get_payment->transaction_id ?? '-';
                })

                ->addColumn('status', function ($row) {
                    return '<span class="badge bg-success">Refunded</span>';
                })

                ->rawColumns(['status'])
                ->make(true);
        }

        return view('payment.payment_refund');
    }

    public function PaymentRefundExport(Request $request)
    {
        $query = PaymentRefund::with([
            'get_payment.get_order.get_user',
        ]);

        if ($request->from_date) {
            $from = Carbon::createFromFormat('d-m-Y', $request->from_date)->format('Y-m-d');
            $query->whereDate('refund_date', '>=', $from);
        }

        if ($request->to_date) {
            $to = Carbon::createFromFormat('d-m-Y', $request->to_date)->format('Y-m-d');
            $query->whereDate('refund_date', '<=', $to);
        }

        if ($request->payment_method) {
            $query->whereHas('get_payment', function ($q) use ($request) {
                $q->where('payment_gateway', $request->payment_method);
            });
        }

        if ($request->order_no) {
            $query->whereHas('get_payment.get_order', function ($q) use ($request) {
                $q->where('order_no', 'LIKE', '%'.$request->order_no.'%');
            });
        }

        if ($request->customer_name) {
            $query->whereHas('get_payment.get_order.get_user', function ($q) use ($request) {
                $q->whereRaw("CONCAT(first_name,' ',last_name) LIKE ?", ['%'.$request->customer_name.'%']);
            });
        }

        $refunds = $query->get();

        if ($request->type == 'excel') {
            return Excel::download(new PaymentRefundExport($refunds), 'payment_refund.xlsx');
        }

        if ($request->type == 'pdf') {
            $pdf = Pdf::loadView('Export.pdf.payment_refund_pdf', compact('refunds'));

            return $pdf->download('payment_refund.pdf');
        }
    }
}
