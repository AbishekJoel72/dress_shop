<?php

namespace App\Http\Controllers;

use App\Exports\OrderExport;
use App\Models\Address;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sizetype;
use App\Models\State;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function Order(Request $request)
    {

        if ($request->method('POST')) {
            if ($request->order_items) {
                try {
                    $validation = $request->validate([
                        'address' => 'required',
                        'state_id' => 'required',
                        'city_id' => 'required',
                        'pincode' => 'required',
                        'product_id' => 'required',
                        'size_id' => 'required',
                        'quantity' => 'required',
                        'payment_gateway' => 'required',
                        'total_amount' => 'required',
                    ]);
                    if ($validation) {
                        $lastOrder = Order::latest('id')->first();
                        $orderNo = 'ORD'.str_pad(($lastOrder?->id + 1 ?? 1), 5, '0', STR_PAD_LEFT);
                        $order = new Order;
                        $order->order_no = $orderNo;
                        $order->order_date = $request->order_date ?? now();
                        $order->user_id = session('user_id');
                        $order->delivery_charge = 0;
                        $order->grand_total = $request->total_amount;
                        $order->delivery_status = 'pending';
                        $order->save();

                        $item = new OrderItems;
                        $item->order_id = $order->id;
                        $item->product_id = $request->product_id;
                        $item->size_id = $request->size_id;
                        $item->quantity = $request->quantity;
                        $item->price = $request->price;
                        $item->discount_price = $request->discount;
                        $item->total_amount = $request->total_amount;
                        $item->save();

                        $address = new Address;
                        $address->user_id = session('user_id');
                        $address->order_id = $order->id;
                        $address->address_line1 = $request->address;
                        $address->address_line2 = $request->address2;
                        $address->state_id = $request->state_id;
                        $address->city_id = $request->city_id;
                        $address->pincode = $request->pincode;
                        $address->save();

                        $payment = new Payment;
                        $payment->order_id = $order->id;
                        $payment->payment_gateway = $request->payment_gateway;
                        $payment->amount = $request->total_amount;
                        $payment->currency = 'INR';
                        if ($request->payment_gateway == 'cash_on_delivery') {
                            $payment->transaction_id = null;
                            $payment->payment_status = 'pending';
                            $payment->paid_at = null;
                        } else {
                            $payment->transaction_id = 'TXN'.time();
                            $payment->payment_status = 'success';
                            $payment->paid_at = now();
                        }
                        $payment->save();
                        session()->flash('success', 'Order Placed Successfully');

                        return redirect()->route('product_list');
                    }
                } catch (\Throwable $th) {
                    session()->flash('error', $th->getMessage());

                    return redirect()->back();
                }
            }
        }

        if ($request->ajax()) {
            if ($request->get_city) {
                $state = $request->stateID;
                $city = City::where('state_id', $state)->get();

                return response()->json($city);
            }
        }

        if ($request->id) {
            $id = decrypt($request->id);
            $data['product_items'] = Product::where('id', $id)->first();
        }
        $data['size'] = Sizetype::get();
        $data['state'] = State::get();
        $data['address'] = Address::where('user_id', session('user_id'))->first();

        return view('Order.order')->with($data);
    }

    public function OrderPlaced(Request $request)
    {

        $user = session('user_id');
        if ($request->ajax()) {
            if ($request->get_view_item) {
                $id = $request->id;
                $order = Order::with('get_product', 'get_product.get_category', 'get_state', 'get_size', 'get_cities')
                    ->where('id', $id)
                    ->first();

                return response()->json($order);
            }
            if ($request->get_payment_list) {
                $id = $request->id;
                $order = Order::where('id', $id)
                    ->whereHas('get_payment', function ($q) use ($id) {

                        $q->where('order_id', $id);
                    })
                    ->with('get_payment')
                    ->first();

                return response()->json($order);
            }
            if ($request->delete_order) {
                $id = $request->id;
                Payment::where('order_id', $id)->delete();
                $order = Order::where('id', $id)->delete();

                return response()->json($order);
            }
            $data = Order::where('user_id', $user)
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actions = '
                        <div class="dropdown">
                            <a href="#" class="text-dark" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="javascript:void(0)" class="ViewRow dropdown-item" data-id="'.$row->id.'">View</a>
                                </li>
                            </ul>
                        </div>';

                    return $actions;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Order.orderplaced');
    }

    public function OrderList(Request $request)
    {
        if ($request->method('POST')) {
            if ($request->edit_status) {

                $validation = $request->validate([
                    'delivery_status' => 'required',
                ]);
                if ($validation) {
                    $id = $request->id;
                    $order = Order::with('get_orderitems')->where('id', $id)->first();
                    if ($request->delivery_status == 'delivered' && $order->delivery_status != 'delivered') {
                        Payment::where('order_id', $id)
                            ->where('payment_gateway', 'cash_on_delivery')
                            ->update([
                                'transaction_id' => 'TXN'.time(),
                                'payment_status' => 'success',
                                'paid_at' => now(),
                            ]);

                        foreach ($order->get_orderitems as $item) {
                            $product = Product::find($item->product_id);
                            if ($product) {
                                $newStock = $product->stock - $item->quantity;
                                $product->stock = max(0, $newStock);
                                $product->save();
                            }
                        }
                    }
                    $order->update(['delivery_status' => $request->delivery_status]);

                    
                    // Order::where('id', $id)->update([
                    //     'delivery_status' => $request->delivery_status,
                    // ]);
                    // if ($request->delivery_status == 'delivered') {
                    //     Payment::where('order_id', $id)->where('payment_gateway', 'cash_on_delivery')->update([
                    //         'transaction_id' => 'TXN'.time(),
                    //         'payment_status' => 'success',
                    //         'paid_at' => now(),
                    //     ]);

                    //     $order = Order::find($id);
                    //     $product = Product::find($order->product_id);
                    //     if ($product) {
                    //         $product->stock = $product->stock - $order->quantity;
                    //         $product->save();
                    //     }
                    // }
                    session()->flash('success', 'Status Updated Successfully');

                    return redirect()->route('order_list');
                }
            }
        }

        if ($request->get_invoice_bill) {
            $id = $request->id;
            $order = Order::with([
                'get_user',
                'get_address.get_city',
                'get_address.get_state',
                'get_orderitems.get_product.get_product_images',
                'get_orderitems.get_size',
                'get_payment',
            ])->where('id', $id)->first();
            $pdf = Pdf::loadView('Export.pdf.order_invoice_bill', ['order' => $order]);

            return $pdf->download('Invoice_'.$order->order_no.'.pdf');
        }

        if ($request->ajax()) {
            if ($request->get_view_item) {
                $id = $request->id;
                $order = Order::with(['get_user', 'get_payment', 'get_address.get_state', 'get_address.get_city',
                    'get_orderitems.get_product',
                    'get_orderitems.get_product.get_product_images',
                    'get_orderitems.get_size',
                ])->where('id', $id)->first();

                return response()->json($order);
            }

            if ($request->get_status) {
                $id = $request->id;
                $order = Order::where('id', $id)->first();

                return response()->json($order);
            }

            $query = Order::with('get_user', 'get_payment');
            if ($request->order_no) {
                $query->where('order_no', 'LIKE', '%'.$request->order_no.'%');
            }
            if ($request->customer_name) {
                $query->whereHas('get_user',
                    function ($q) use ($request) {
                        $q->where('first_name', 'LIKE', '%'.$request->customer_name.'%');
                    }
                );
            }
            if ($request->payment_gateway) {
                $query->whereHas('get_payment',
                    function ($q) use ($request) {
                        $q->where('payment_gateway', $request->payment_gateway);
                    }
                );
            }
            if ($request->payment_status) {
                $query->whereHas('get_payment',
                    function ($q) use ($request) {
                        $q->where('payment_status', $request->payment_status);
                    }
                );
            }
            if ($request->delivery_status) {
                $query->where('delivery_status', $request->delivery_status);
            }
            if ($request->from_date) {
                $from = Carbon::createFromFormat('d-m-Y', $request->from_date)->format('Y-m-d');
                $query->whereDate('created_at', '>=', $from);
            }
            if ($request->to_date) {
                $to = Carbon::createFromFormat('d-m-Y', $request->to_date)->format('Y-m-d');
                $query->whereDate('created_at', '<=', $to);
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('customer_name', function ($row) {
                    return ($row->get_user->first_name ?? '').' '.($row->get_user->last_name ?? '');
                })
                ->addColumn('action', function ($row) {
                    $actions = '
                        <div class="dropdown">
                            <a href="#" class="text-dark" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="javascript:void(0)" class="ViewRow dropdown-item" data-id="'.$row->id.'">View</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="EditStatusRow dropdown-item" data-id="'.$row->id.'">Status</a>
                                </li>
                            </ul>
                        </div>';

                    return $actions;
                })
                ->make(true);
        }

        return view('Order.order_list');
    }

    public function OrderExport(Request $request)
    {
        $query = Order::with(['get_user', 'get_payment']);

        if ($request->order_no) {
            $query->where('order_no', 'LIKE', '%'.$request->order_no.'%');
        }

        if ($request->customer_name) {
            $query->whereHas('get_user', function ($q) use ($request) {
                $q->whereRaw("CONCAT(COALESCE(first_name,''),' ',COALESCE(last_name,'')) LIKE ?", ['%'.$request->customer_name.'%']);
            });
        }

        if ($request->payment_gateway) {
            $query->whereHas('get_payment', function ($q) use ($request) {
                $q->where('payment_gateway', $request->payment_gateway);
            });
        }

        if ($request->payment_status) {
            $query->whereHas('get_payment', function ($q) use ($request) {
                $q->where('payment_status', $request->payment_status);
            });

        }

        if ($request->delivery_status) {
            $query->where('delivery_status', $request->delivery_status);
        }

        if ($request->from_date) {
            $from = Carbon::createFromFormat('d-m-Y', $request->from_date)->format('Y-m-d');
            $query->whereDate('order_date', '>=', $from);
        }

        if ($request->to_date) {
            $to = Carbon::createFromFormat('d-m-Y', $request->to_date)->format('Y-m-d');
            $query->whereDate('order_date', '<=', $to);
        }

        $orders = $query->get();
        if ($request->type == 'excel') {
            return Excel::download(new OrderExport($orders), 'orders.xlsx');
        }

        if ($request->type == 'pdf') {
            $pdf = Pdf::loadView('Export.pdf.order_pdf', ['orders' => $orders]);

            return $pdf->download('orders.pdf');

        }
    }
}
