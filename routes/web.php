<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;



//menu
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu/{id}', [HomeController::class, 'showMenu'])->name('menu.detail');

//kranjg
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add'); // Validasi min 30 pax
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

//login regist
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//co
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

//tm
Route::get('/payment/{order_code}', [OrderController::class, 'paymentPage'])->name('order.payment');
Route::post('/payment/{order_code}/confirm', [OrderController::class, 'confirmPayment'])->name('order.confirm');
Route::get('/order/track/{order_code}', [OrderController::class, 'trackingPage'])->name('order.tracking');
Route::get('/order/{order_code}/pelunasan', [OrderController::class, 'settlementPage'])->name('order.settlement');
Route::post('/order/{order_code}/pelunasan/konfirmasi', [OrderController::class, 'confirmSettlement'])->name('order.settlement.confirm');
Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('order.my_orders');

//atmint
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    //menu
    Route::get('/menus/categories', [AdminMenuController::class, 'categories'])->name('menus.categories');
    Route::get('/menus', [AdminMenuController::class, 'index'])->name('menus.index');
    Route::get('/menus/create', [AdminMenuController::class, 'create'])->name('menus.create');
    Route::post('/menus', [AdminMenuController::class, 'store'])->name('menus.store');
    Route::get('/menus/{id}/edit', [AdminMenuController::class, 'edit'])->name('menus.edit');
    Route::put('/menus/{id}', [AdminMenuController::class, 'update'])->name('menus.update');
    Route::delete('/menus/{id}', [AdminMenuController::class, 'destroy'])->name('menus.destroy');

    //treking pssn
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update_status');
    Route::put('/orders/{id}/tracking', [AdminOrderController::class, 'updateTracking'])->name('orders.update_tracking');
    Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');

    //notifikasi pesanan baru (dipanggil via fetch/polling dari topbar)
    Route::get('/notifications', [AdminOrderController::class, 'notifications'])->name('notifications.index');
    Route::put('/notifications/read-all', [AdminOrderController::class, 'markAllNotificationsRead'])->name('notifications.read_all');

    //data
    Route::get('/customers', [\App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customers.index');

});
