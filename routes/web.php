<?php

use App\Http\Controllers\CustomersReportController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoicesReportController;
use App\Http\Controllers\InvoicesAttachmentsController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\SectionsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\facades\Auth;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');



Auth::routes();
// Auth::routes(['register'=>false]);

Route::resource('sections', SectionsController::class);
Route::resource('products', ProductsController::class);

// Route::get('/section/{id}', 'InvoicesController@getproducts');


Route::resource('invoices', InvoicesController::class);

Route::get('invoices/section/{id}', [InvoicesController::class, 'getproducts'])->name('getproducts');
Route::get('edit/{id}', [InvoicesController::class, 'edit'])->name('invoices.edit');
Route::get('edit_status/{id}', [InvoicesController::class, 'ShowStatus'])->name('invoices.edit_status');
Route::post('Status_Update/{id}', [InvoicesController::class, 'StatusUpdate'])->name('Status_Update');

Route::get('invoices_paid', [InvoicesController::class, 'paidInvoices']);
Route::get('invoices_unpaid', [InvoicesController::class, 'unpaidInvoices'])->name('invoices.unpaid');
Route::get('invoices_partial', [InvoicesController::class, 'partialInvoices'])->name('invoices.partial');
Route::get('invoices_archive', [InvoicesController::class, 'view_archived'])->name('invoices.archive');

Route::delete('archive', [InvoicesController::class, 'archive'])->name('invoices.archive');
Route::delete('delete_archive', [InvoicesController::class, 'delete_archived'])->name('delete.archive');
Route::patch('restore_archive', [InvoicesController::class, 'restore_archived'])->name('restore.archive');

Route::get('invoices/print/{id}', [InvoicesController::class, 'print_invoice'])->name('invoices.print');
Route::get('export', [InvoicesController::class, 'export'])->name('invoices.export');
Route::get('markAllRead',[InvoicesController::class, 'MarkAllRead']);


Route::get('/markAsRead/{id}', function ($id) {
    $notification = auth()->user()->unreadNotifications->where('id', $id)->first();
    if ($notification) {
        $notification->markAsRead();
    }
    return redirect('/InvoicesDetails/' . $notification->data['id']);
})->name('markAsRead');




Route::get('/invoices_report',[InvoicesReportController ::class,'index']);
Route::POST('/invoices_search',[InvoicesReportController ::class,'searchInvoices']);

Route::get('/customers/report',[CustomersReportController ::class,'index']);

Route::POST('customers/search',[CustomersReportController::class,'searchCustomers']);



Route::get('/InvoicesDetails/{id}', [InvoicesDetailsController::class, 'edit']);
Route::get('/view_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'open_file']);
Route::get('/download/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'download_file']);
Route::post('delete_file', [InvoicesDetailsController::class, 'destroy'])->name('delete_file');

Route::resource('InvoiceAttachments', InvoicesAttachmentsController::class);



// routes/web.php
Route::get('/notifications/count', function () {
    return auth()->user()->unreadNotifications->count();
});

Route::get('/notifications/unread', function () {
    return view('partials.notifications', [
        'notifications' => auth()->user()->unreadNotifications
    ]);
});


Route::get('/home', [HomeController::class, 'index']);


Route::group(['middleware' => ['auth']], function() {
Route::resource('roles',RoleController::class);
Route::resource('users',UserController::class);
});






Route:

// Route::get('/get-products/{id}', [ProductsController::class, 'getProducts']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/{page}', 'App\Http\Controllers\AdminController@index');
