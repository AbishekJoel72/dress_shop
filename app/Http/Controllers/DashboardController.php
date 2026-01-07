<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Feedback;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Registration;
use App\Models\Sizetype;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function Dashboard()
    {
        $data['category'] = Category::count();
        $data['size'] = Sizetype::count();

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
        $data['contact'] = Contact::count();
        return view("dashboard.dashboard")->with($data);
    }
}
