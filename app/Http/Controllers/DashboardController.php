<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function Dashboard(Request $request)
    {
        $data['category'] = Category::count();
        $data['size'] = Category::count();

        $data['men_products'] = Product::whereHas('get_category', function ($q) {
            $q->where('name', 'Men');
        })->count();
        $data['women_products'] = Product::whereHas('get_category', function ($q) {
            $q->where('name', 'Women');
        })->count();

         $data['total_orders'] = Order::count();
          $data['today_orders'] = Order::whereDate('date', Carbon::today())->count();

        $data['feedback'] = Feedback::count();
        $data['user'] = Registration::where('role', 'user')->count();
        $data['payment'] = Payment::count();
        return view("dashboard.dashboard")->with($data);
    }
}
