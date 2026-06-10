<?php

namespace App\Http\Controllers;

use App\Models\CartList;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sizetype;

class CartController extends Controller
{
    public function AddToCart(Request $request)
    {
        $user = session()->get('user_id');
        if ($request->add_into_cart) {

            $id = decrypt($request->id);
            $product = Product::with('get_product_images')->where('id', $id)->first();
            // dd($product);
            if (!empty($product)) {
                $cate = new CartList();
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
                    return response()->json(['status' => true, 'quantity' => $cartItem->quantity, 'total_amount' => $cartItem->total_amount]);
                }
                return response()->json([
                    'status' => false,
                    'message' => 'Cart item not found'
                ]);
            }
        }
    }



    public function Cart(Request $request)
    {
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
                    'message' => 'Cart item not found'
                ]);
            }
        }

        $data['cart'] = CartList::with('get_product.get_product_images')->where('user_id', session('user_id'))->get();
        $data['sizes'] = Sizetype::all();
        return view('Cart.cart')->with($data);
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }
        return view('Order.checkout', compact('cart'));
    }
}
