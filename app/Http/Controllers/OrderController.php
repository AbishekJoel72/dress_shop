<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sizetype;
use App\Models\State;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function Order(Request $request)
    {

        if ($request->method("POST")) {
            if ($request->order_items) {
                try {
                    $validation = $request->validate([
                        "size_id" => "required",
                        "address" => "required",
                        "state_id" => "required",
                        "city_id" => "required",
                        "pincode" => "required",
                    ]);
                    if ($validation) {
                        $lastOrder = Order::latest()->first();
                        $newOrderId = 'ORD' . str_pad(($lastOrder?->id + 1 ?? 1), 5, '0', STR_PAD_LEFT);

                        $o = new Order();
                        $o->order_id =  $newOrderId;
                        $o->date = $request->date;
                        $o->user_id = session('user_id');
                        $o->product_id = $request->product_id;
                        $o->size_id = $request->size_id;
                        $o->quantity = $request->quantity;
                        $o->total_amount = $request->total_amount;
                        $o->address = $request->address;
                        $o->state_id = $request->state_id;
                        $o->city_id = $request->city_id;
                        $o->pincode = $request->pincode;
                        $o->save();


                        $lastOrder = Payment::latest()->first();
                        $transaction = 'TRA' . str_pad(($lastOrder?->id + 1 ?? 1), 5, '0', STR_PAD_LEFT);

                        $data = [
                            'order_id'        => $o->id,
                            'payment_gateway' => $request->payment_gateway,
                            'currency' => $request->currency,
                        ];

                        if ($request->payment_gateway != 'cash_on_delivery') {
                            $data['card_type']      = $request->card_type ?? null;
                            $data['transaction_id'] = $transaction ?? null;
                            $data['paid_at']        = now();
                        } else {
                            $data['card_type']      = null;
                            $data['transaction_id'] = null;
                            $data['paid_at']        = null;
                            $data['payment_status'] = '0';
                        }

                        Payment::create($data);


                        session()->flash("success", "Order Placed Successfully");
                        return redirect()->route("product_list");
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
                $city = City::where("state_id", $state)->get();
                return response()->json($city);
            }
        }


        if ($request->id) {
            $id = decrypt($request->id);
            $data['product_items'] = Product::where('id', $id)->first();
        }

        $data['size'] = Sizetype::get();
        $data['state'] = State::get();


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


            $data = Order::with('get_product', 'get_product.get_category', 'get_state', 'get_size', 'get_cities', 'get_payment')
                ->where('user_id', $user)
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('payment_gateway', function ($row) {
                    return $row->get_payment->payment_gateway ?? '-';
                })
                ->addColumn('action', function ($row) {
                    $actions = '
        <div class="dropdown">
            <a href="#" class="text-dark" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="javascript:void(0)" class="ViewRow dropdown-item" data-id="' . $row->id . '">View</a>
                </li>';

                    if ($row->get_payment->payment_status == "1") {
                        $actions .= '
                          <li>
                            <a href="javascript:void(0)" class="PaymentRow dropdown-item" data-id="' . $row->id . '">Payment</a>
                        </li>';
                    }


                    if (in_array($row->delivery_status, ['pending'])) {
                        $actions .= '
                <li>
                    <a href="javascript:void(0)" class="deleteRow dropdown-item text-danger" data-id="' . $row->id . '">Delete</a>
                </li>';
                    }


                    if ($row->delivery_status === 'delivered') {
                        $actions .= '
                <li>
                    <a href="javascript:void(0)" class="returnRow dropdown-item text-danger" data-id="' . $row->id . '">Return</a>
                </li>';
                    }

                    $actions .= '
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
        if ($request->method("POST")) {
            if ($request->edit_status) {
                $id = $request->id;

                Order::where('id', $id)->update([
                    'delivery_status' => $request->delivery_status,
                ]);

                session()->flash('success', 'Status Updated Successfully');
                return redirect()->route('order_list');
            }
        }

        if ($request->ajax()) {

            if ($request->get_payment) {
                $id = $request->id;
                $payment = Payment::where('order_id', $id)->first();

                $updateData = [
                    'payment_status' => '1',
                    'paid_at'        => now(),
                ];

                if (empty($payment->transaction_id)) {
                    $lastPayment = Payment::latest()->first();
                    $transaction = 'TRA' . str_pad(($lastPayment?->id + 1 ?? 1), 5, '0', STR_PAD_LEFT);
                    $updateData['transaction_id'] = $transaction;
                }

                $p = Payment::where('order_id', $id)->update($updateData);
                Order::where('id', $id)->update([
                    'delivery_status' => 'delivered'
                ]);
                session()->flash('success', 'Payment updated successfully for the customer.');
                return response()->json($p);
            }

            if ($request->get_status) {
                $id = $request->id;
                $order = Order::where('id', $id)->first();
                return response()->json($order);
            }

            if ($request->get_view_item) {
                $id = $request->id;
                $order = Order::with('get_product', 'get_product.get_category', 'get_state', 'get_size', 'get_cities')
                    ->where('id', $id)
                    ->first();
                return response()->json($order);
            }



            $data = Order::with('get_product', 'get_product.get_category', 'get_state', 'get_size', 'get_cities', 'get_payment')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('payment_gateway', function ($row) {
                    return $row->get_payment->payment_gateway ?? '-';
                })
                ->addColumn('action', function ($row) {
                    $actions = '

                    <div class="dropdown">
                        <a href="#" class="text-dark " role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="javascript:void(0)"  class="ViewRow dropdown-item" data-id="' . $row->id . '">View </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"  class="EditStatusRow dropdown-item" data-id="' . $row->id . '">Edit Status </a>
                            </li>';


                    // if ($row->get_payment && strtolower($row->get_payment->payment_gateway) == 'cash_on_delivery') {

                    //     if (strtolower($row->delivery_status) == 'delivered') {

                    //     } else {
                    //         $actions .= '
                    //         <li>
                    //             <a href="javascript:void(0)" class="AddPaymentRow dropdown-item" data-id="' . $row->id . '">Payment Update</a>
                    //         </li>';
                    //     }
                    // }
                    $actions .= '

                        </ul>
                    </div>';
                    return $actions;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view("Order.order_list");
    }
}
