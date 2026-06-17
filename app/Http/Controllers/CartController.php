<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\CartList;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sizetype;
use App\Models\State;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function AddToCart(Request $request)
    {
        $user = session()->get('user_id');
        if ($request->add_into_cart) {

            $id = decrypt($request->id);
            $product = Product::with('get_product_images')->where('id', $id)->first();
            if (! empty($product)) {
                $cate = new CartList;
                $cate->user_id = $user;
                $cate->product_id = $id;
                $cate->size_id = null;
                $cate->quantity = 1;
                $cate->price = $product->price;
                $cate->discount_price = $product->discount_price;
                $cate->total_amount = $product->price - $product->discount_price;
                $cate->save();
                session()->flash('success', 'Successfully Added To The Cart');

                return redirect()->back();
            }
        }

        if ($request->ajax()) {
            if ($request->get_increasecart) {
                $id = $request->id;
                $cartItem = CartList::where('id', $id)->first();
                if ($cartItem) {
                    $cartItem->quantity = $request->quantity;
                    $cartItem->total_amount = $cartItem->quantity * ($cartItem->price - $cartItem->discount_price);
                    $cartItem->save();
                    $grandTotal = CartList::where('user_id', session('user_id'))->sum('total_amount');

                    return response()->json(['status' => true, 'quantity' => $cartItem->quantity, 'total_amount' => $cartItem->total_amount, 'cart_grand_total' => $grandTotal]);
                }

                return response()->json([
                    'status' => false,
                    'message' => 'Cart item not found',
                ]);
            }
        }
    }

    public function Cart(Request $request)
    {
        $user = session()->get('user_id');
        if ($request->ajax()) {
            if ($request->get_deletecart) {
                $id = $request->id;
                $c = CartList::where('id', $id)->delete();

                return response()->json($c);
            }
            if ($request->get_updatesize) {
                $id = $request->id;
                $sizeId = $request->size_id;
                $cartItem = CartList::where('id', $id)->first();
                if ($cartItem) {
                    $cartItem->size_id = $sizeId;
                    $cartItem->save();

                    return response()->json(['status' => true]);
                }

                return response()->json([
                    'status' => false,
                    'message' => 'Cart item not found',
                ]);
            }
        }

        $data['cart'] = CartList::with('get_product.get_product_images')->where('user_id', $user)->get();
        $data['sizes'] = Sizetype::all();

        return view('Cart.cart')->with($data);
    }

    public function checkout(Request $request)
    {
        $user = session()->get('user_id');
        if ($request->method() == 'POST') {
            if ($request->cart_items) {
                try {
                    $request->validate([
                        'address' => 'required',
                        'state_id' => 'required',
                        'city_id' => 'required',
                        'pincode' => 'required',
                        'payment_gateway' => 'required',
                    ]);
                    $lastOrder = Order::latest('id')->first();
                    $orderNo = 'ORD'.str_pad((($lastOrder?->id ?? 0) + 1), 5, '0', STR_PAD_LEFT);

                    $order = new Order;
                    $order->order_no = $orderNo;
                    $order->order_date = now();
                    $order->user_id = session('user_id');
                    $order->delivery_charge = 0;
                    $order->grand_total = 0;
                    $order->delivery_status = 'pending';
                    $order->save();

                    $grandTotal = 0;
                    foreach ($request->product_id as $key => $productId) {
                        $item = new OrderItems;
                        $item->order_id = $order->id;
                        $item->product_id = $productId;
                        $item->size_id = $request->size_id[$key];
                        $item->quantity = $request->quantity[$key];
                        $item->price = $request->price[$key];
                        $item->discount_price = $request->discount[$key];
                        $item->total_amount =
                            ($request->price[$key] - $request->discount[$key])
                            * $request->quantity[$key];
                        $grandTotal += $item->total_amount;
                        $item->save();
                    }

                    $order->grand_total = $grandTotal;
                    $order->save();

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
                    $payment->amount = $grandTotal;
                    $payment->currency = 'INR';
                    if ($request->payment_gateway == 'cash_on_delivery') {
                        $payment->transaction_id = null;
                        $payment->payment_status = 'pending';
                    } else {
                        $payment->transaction_id = 'TXN'.time();
                        $payment->payment_status = 'success';
                        $payment->paid_at = now();
                    }
                    $payment->save();
                    CartList::where('user_id', session('user_id'))->delete();
                    session()->flash('success', 'Order Placed Successfully');
                    return redirect()->route('product_list');
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

        $data['states'] = State::get();
        $data['cart'] = CartList::with('get_product.get_product_images', 'get_size')->where('user_id', $user)->get();
        if ($data['cart']->isEmpty()) {
            session()->flash('error', 'Your cart is empty. Please add items to the cart before proceeding to checkout.');

            return redirect()->route('product_list');
        }

        $data['address'] = Address::where('user_id', session('user_id'))->first();

        return view('Order.checkout')->with($data);
    }
}
