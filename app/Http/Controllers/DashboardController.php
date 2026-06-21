<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\Favourites;
use App\Models\Feedback;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Registration;
use App\Models\Sizetype;
use App\Models\State;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function Dashboard()
    {
        $data['category'] = Category::count();
        $data['size'] = Sizetype::count();

        $data['man_products'] = Product::whereHas('get_category', function ($q) {
            $q->where('name', 'Man');
        })->count();

        $data['women_products'] = Product::whereHas('get_category', function ($q) {
            $q->where('name', 'Woman');
        })->count();

        $data['kids_products'] = Product::whereHas('get_category', function ($q) {
            $q->where('name', 'Kids');
        })->count();

        $data['total_orders'] = Order::count();
        $data['today_orders'] = Order::whereDate('order_date',Carbon::today() )->count();
        $data['feedback'] = Feedback::count();
        $data['user'] = Registration::where('role','user')->count();
        $data['payment'] = Payment::where('payment_status','success')->count();
        $data['contact'] = Contact::count();
        $data['favourites'] = Favourites::count();
        $data['pending_orders'] = Order::where('delivery_status','pending')->count();
        $data['delivered_orders'] = Order::where('delivery_status','delivered')->count();
        $data['cancelled_orders'] = Order::where('delivery_status','cancelled')->count();
        $data['returns'] = Order::where('delivery_status','returned')->count();
        $data['today_users'] = Registration::whereDate('created_at',Carbon::today())->count();
        $data['low_stock'] = Product::where('stock','<', 10)->count();
        $data['out_stock'] = Product::where('stock', 0)->count();
        // $data['states'] = State::count();
        // $data['cities'] = City::count();
        $data['revenue'] = Payment::where('payment_status','success')->sum('amount');

        return view('dashboard.dashboard')->with($data);
    }
}
