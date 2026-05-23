<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function AddToCart(Request $request)
    {
        $cart = session()->get('cart', []);
        if ($request->get_cart) {
            $id = decrypt($request->id);
            $product = Product::with('get_product_images')->where('id', $id)->first();
            $finalPrice = $product->price;
            if (isset($product->discount_price) && $product->discount_price > 0) {
                $finalPrice = $product->price - $product->discount_price;
            }
            if (isset($cart[$request->id])) {
                $cart[$id]['quantity'] += 1;
            } else {
                $cart[$id] = [
                    "id" => $id,
                    "name" => $product->product_name,
                    "price" => $finalPrice,
                    "image" => $product->get_product_images->image_path ?? null,
                    "quantity" => 1,
                ];
            }
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Successfully Added To The Cart');
        }

        if ($request->ajax()) {
            if ($request->quantity) {
                if (isset($cart[$request->id])) {
                    $cart[$request->id]['quantity'] = $request->quantity;
                    session()->put('cart', $cart);
                }
                return response()->json(['status' => true]);
            }
        }
    }



    public function Cart(Request $request)
    {
        if ($request->get_deletecart) {
            $cart = session()->get('cart', []);
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return response()->json(['status' => true]);
        }

        $cart = session()->get('cart', []);
        return view('Cart.cart', compact('cart'));
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
