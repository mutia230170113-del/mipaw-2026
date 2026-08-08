<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;

// ================= ADMIN =================
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\GroomingServiceController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\GroomingBookingController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\ReportController;

// ================= CUSTOMER =================
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\ProductController as CustomerProductController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Customer\PaymentController as CustomerPaymentController;
use App\Http\Controllers\Customer\MembershipController as CustomerMembershipController;
use App\Http\Controllers\Customer\GroomingController as CustomerGroomingController;
use App\Http\Controllers\Customer\PetController as CustomerPetController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->get('/dashboard', function () {

    // PAKSA BYPASS BERDASARKAN EMAIL ADMIN ANDA
    if (auth()->user()->email == 'admin@mipaw.com') {
        return redirect()->route('admin.dashboard');
    }

    if (auth()->user()->role == 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('customer.dashboard');

})->name('dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:admin'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class,'index'])
        ->name('admin.dashboard');

    Route::resource('categories', CategoryController::class);

    Route::resource('products', ProductController::class);

    Route::resource('customers', CustomerController::class);

    Route::resource('orders', OrderController::class);

    Route::resource('payments', PaymentController::class);

    Route::resource('grooming-services', GroomingServiceController::class);

    Route::resource('pets', PetController::class);

    Route::resource('grooming-bookings', GroomingBookingController::class);

    Route::resource('memberships', MembershipController::class);

    Route::patch(
        'grooming-bookings/{groomingBooking}/finish',
        [GroomingBookingController::class,'finish']
    )->name('grooming-bookings.finish');

    Route::patch(
        'payments/{payment}/verify',
        [PaymentController::class,'verify']
    )->name('payments.verify');

    Route::patch(
        'payments/{payment}/reject',
        [PaymentController::class,'reject']
    )->name('payments.reject');

    Route::get(
        'payments/{payment}/receipt',
        [PaymentController::class,'receipt']
    )->name('payments.receipt');

    Route::get(
        'payments/{payment}/receipt/pdf',
        [PaymentController::class,'receiptPdf']
    )->name('payments.receipt.pdf');

    Route::get('/reports',[ReportController::class,'index'])
        ->name('reports.index');

    Route::get('/reports/preview',[ReportController::class,'preview'])
        ->name('reports.preview');

    Route::get('/reports/pdf',[ReportController::class,'pdf'])
        ->name('reports.pdf');

});


/*
|--------------------------------------------------------------------------
| CUSTOMER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/customer/dashboard',
        [CustomerDashboardController::class, 'index']
    )->name('customer.dashboard');


    /*
    |--------------------------------------------------------------------------
    | Produk
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/customer/products',
        [CustomerProductController::class, 'index']
    )->name('customer.products');

    Route::get(
        '/customer/products/{product}',
        [CustomerProductController::class, 'show']
    )->name('customer.products.show');


    

    /*
|--------------------------------------------------------------------------
| Pets
|--------------------------------------------------------------------------
/*
|--------------------------------------------------------------------------
| Hewan Saya
|--------------------------------------------------------------------------
*/

Route::get(
    '/customer/pets',
    [CustomerPetController::class, 'index']
)->name('customer.pets');

Route::get(
    '/customer/pets/create',
    [CustomerPetController::class, 'create']
)->name('customer.pets.create');

Route::post(
    '/customer/pets',
    [CustomerPetController::class, 'store']
)->name('customer.pets.store');

Route::get(
    '/customer/pets/{pet}/edit',
    [CustomerPetController::class, 'edit']
)->name('customer.pets.edit');

Route::put(
    '/customer/pets/{pet}',
    [CustomerPetController::class, 'update']
)->name('customer.pets.update');

Route::delete(
    '/customer/pets/{pet}',
    [CustomerPetController::class, 'destroy']
)->name('customer.pets.destroy');

    /*
    |--------------------------------------------------------------------------
    | Keranjang
    |--------------------------------------------------------------------------
    */

// TEST (letakkan PALING ATAS)
Route::get('/customer/cart/test', function () {
    return 'GET OK';
});

Route::post('/customer/cart/test', function () {
    return 'POST OK';
});

// Halaman keranjang
Route::get(
    '/customer/cart',
    [CartController::class, 'index']
)->name('customer.cart.index');

// Checkout
Route::post(
    '/customer/cart/checkout',
    [CartController::class, 'checkout']
)->name('customer.cart.checkout');

// Tambah ke keranjang
Route::post(
    '/customer/cart/{product}',
    [CartController::class, 'store']
)->name('customer.cart.store');



// Hapus item keranjang
Route::delete(
    '/customer/cart/{cart}',
    [CartController::class, 'destroy']
)->name('customer.cart.destroy');

    /*
    |--------------------------------------------------------------------------
    | Order
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/customer/orders',
        [CustomerOrderController::class, 'index']
    )->name('customer.orders');

    Route::get(
        '/customer/orders/{order}',
        [CustomerOrderController::class, 'show']
    )->name('customer.orders.show');


    /*
    |--------------------------------------------------------------------------
    | Pembayaran
    |--------------------------------------------------------------------------
    */

    // Daftar pembayaran
    Route::get(
        '/customer/payments',
        [CustomerPaymentController::class, 'index']
    )->name('customer.payments');

    // Detail pembayaran
    Route::get(
        '/customer/payments/{payment}',
        [CustomerPaymentController::class, 'show']
    )->name('customer.payments.show');

    // Form upload bukti pembayaran
    Route::get(
        '/customer/orders/{order}/payment',
        [CustomerPaymentController::class, 'create']
    )->name('customer.payments.create');

    // Simpan bukti pembayaran
    Route::post(
        '/customer/orders/{order}/payment',
        [CustomerPaymentController::class, 'store']
    )->name('customer.payments.store');

    Route::get(
    '/customer/payments/{payment}/receipt',
    [CustomerPaymentController::class, 'receipt']
    )->name('customer.payments.receipt');
    
/*
|--------------------------------------------------------------------------
| Grooming
|--------------------------------------------------------------------------
*/

Route::get(
    '/customer/grooming',
    [CustomerGroomingController::class, 'index']
)->name('customer.grooming');

Route::get(
    '/customer/grooming/create/{service}',
    [CustomerGroomingController::class, 'create']
)->name('customer.grooming.create');

Route::post(
    '/customer/grooming/store/{service}',
    [CustomerGroomingController::class, 'store']
)->name('customer.grooming.store');

Route::get(
    '/customer/grooming/history',
    [CustomerGroomingController::class, 'history']
)->name('customer.grooming.history');

Route::get(
    '/customer/grooming/{booking}',
    [CustomerGroomingController::class, 'show']
)->name('customer.grooming.show');

    /*
    |--------------------------------------------------------------------------
    | Membership
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/customer/membership',
        [CustomerMembershipController::class, 'index']
    )->name('customer.membership');
    Route::post('/membership/register', [App\Http\Controllers\Customer\MembershipController::class, 'register'])->name('customer.membership.register');


});


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile',[ProfileController::class,'edit'])
        ->name('profile.edit');

    Route::patch('/profile',[ProfileController::class,'update'])
        ->name('profile.update');

    Route::delete('/profile',[ProfileController::class,'destroy'])
        ->name('profile.destroy');

});

require __DIR__.'/auth.php';