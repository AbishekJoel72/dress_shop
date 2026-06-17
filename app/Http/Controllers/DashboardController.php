<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Favourites;
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
        $data['man_products'] = Product::whereHas('get_category', function ($q) {$q->where('name', 'Man');})->count();
        $data['women_products'] = Product::whereHas('get_category', function ($q) {$q->where('name', 'Woman');})->count();
        $data['kids_products'] = Product::whereHas('get_category', function ($q) {$q->where('name', 'Kids');})->count();
        $data['total_orders'] = Order::count();
        $data['today_orders'] = Order::whereDate('order_date', Carbon::today())->count();
        $data['feedback'] = Feedback::count();
        $data['user'] = Registration::where('role', 'user')->count();
        $data['payment'] = Payment::where('payment_status', 'success')->count();
        $data['contact'] = Contact::count();
        $data['favourites'] = Favourites::count();
        return view("dashboard.dashboard")->with($data);
    }
}
