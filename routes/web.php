<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PacksizesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Product Routes
Route::resource('products', ProductController::class)->middleware(['auth']);
Route::get('products_search', [ProductController::class, 'search'])->name('products.search');

// Customer Routes
Route::resource('customers', CustomerController::class)->middleware(['auth']);
Route::get('customers_search', [CustomerController::class, 'search'])->name('customers.search');
Route::get('customers/{customer}/invoices', [CustomerController::class, 'invoices'])->name('customers.invoices')->middleware(['auth']);
Route::get('customers/{customer}/payments', [CustomerController::class, 'payments'])->name('customers.payments')->middleware(['auth']);

// Invoice Routes
Route::resource('invoices', InvoiceController::class)->middleware(['auth']);
Route::get('invoices_search', [InvoiceController::class, 'search'])->name('invoices.search')->middleware(['auth']);
Route::get('invoices/{invoice}/print', [InvoiceController::class, 'print'])->name('invoices.print')->middleware(['auth']);
Route::post('invoices/{invoice}/add-payment', [InvoiceController::class, 'addPayment'])->name('invoices.add-payment')->middleware(['auth']);

// Payment Routes
Route::resource('payments', PaymentController::class)->except(['create', 'store'])->middleware(['auth']);
Route::get('payments/create/{customer}', [PaymentController::class, 'create'])->name('payments.create')->middleware(['auth']);
Route::post('payments/store/{customer}', [PaymentController::class, 'store'])->name('payments.store')->middleware(['auth']);

Route::resource('packsizes', PacksizesController::class)->middleware(['auth']);
Route::resource('vendors', VendorController::class)->middleware(['auth']);
Route::resource('types', TypeController::class)->middleware(['auth']);
Route::resource('stocks', StockController::class)->middleware(['auth']);

Route::prefix('reports')->group(function () {
    Route::get('customer', [ReportController::class, 'customerReport'])->name('reports.customer')->middleware(['auth']);
    Route::get('product', [ReportController::class, 'productReport'])->name('reports.product')->middleware(['auth']);
});

require __DIR__.'/auth.php';
