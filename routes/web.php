<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeTypeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

Route::any('/', [HomeController::class, "home"])->name('home_page');
Route::any('/login', [RegistrationController::class, "login"])->name("login");
Route::any('/registration', [RegistrationController::class, "Registration"])->name("registration");
Route::any('/reset_password', [RegistrationController::class, "ResetPassword"])->name("reset_password");
Route::any('/ajax_reset_password', [RegistrationController::class, "AjaxResetPassword"])->name("ajax_reset_password");
Route::any('/logout', [RegistrationController::class, "Logout"])->name("logout");

Route::middleware([AdminMiddleware::class])->prefix('admin')->group(function () {

    Route::any('dashboard', [DashboardController::class, "Dashboard"])->name('dashboard');
    Route::any('configuration', [ConfigurationController::class, "Configuration"])->name('configuration');
    Route::any('categories', [CategoryController::class, "Categories"])->name('categories');
    Route::any('size_type', [SizeTypeController::class, "SizeType"])->name('size_type');
    Route::any('product', [ProductController::class, "Product"])->name('product');
    Route::any('update_products', [ProductController::class, "UpdateProduct"])->name('update_products');
    Route::any('order_list', [OrderController::class, "OrderList"])->name('order_list');
    Route::any('payment_list', [PaymentController::class, "PaymentList"])->name('payment_list');

    Route::any('user_list_details', [RegistrationController::class, 'UserList'])->name('user_list_details');
    Route::any('feedback_list', [FeedbackController::class, "FeedbackList"])->name('feedback_list');

});


Route::middleware([UserMiddleware::class])->prefix('customer')->group(function () {

    Route::any('product_list', [ProductController::class, "ProductList"])->name('product_list');
    Route::any('order', [OrderController::class, "Order"])->name('order');
    Route::any('order_placed', [OrderController::class, "OrderPlaced"])->name('order_placed');

    Route::any('feedback', [FeedbackController::class, "Feedback"])->name('feedback');

});
