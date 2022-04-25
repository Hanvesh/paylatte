<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('users',\App\Http\Controllers\UserController::class);
Route::resource('credits',\App\Http\Controllers\CreditController::class);
Route::resource('bills',\App\Http\Controllers\BillController::class);
Route::resource('refunds',\App\Http\Controllers\RefundController::class);
Route::resource('transactions',\App\Http\Controllers\TransactionController::class);
Route::resource('repayments',\App\Http\Controllers\RepaymentController::class);
Route::resource('reports',\App\Http\Controllers\ReportController::class);
Route::resource('vendors',\App\Http\Controllers\VendorController::class);

Route::resource('items',\App\Http\Controllers\ItemController::class);
Route::get('/vendor/items', function () {
    return redirect('/api/items');
});

Route::get('/admin/users/{id}',[\App\Http\Controllers\AdminController::class,'showuser']);
Route::get('/admin/bills/{id}',[\App\Http\Controllers\AdminController::class,'showbill']);
Route::get('/admin/credits/{credit_id}',[\App\Http\Controllers\AdminController::class,'showcredit']);
Route::get('/admin/refunds/{id}',[\App\Http\Controllers\AdminController::class,'showrefund']);
Route::get('/admin/repayments/{id}',[\App\Http\Controllers\AdminController::class,'showrepayment']);
Route::get('/admin/reports/{id}',[\App\Http\Controllers\AdminController::class,'showreport']);
Route::get('/admin/transactions/{id}',[\App\Http\Controllers\AdminController::class,'showtransaction']);
Route::get('/admin/vendors/{id}',[\App\Http\Controllers\AdminController::class,'showvendor']);

Route::get('limit/users/{id}',[\App\Http\Controllers\UserController::class,'showlimit']);
Route::get('balance/users/{id}',[\App\Http\Controllers\UserController::class,'showbalance']);
Route::get('bill/users/{id}',[\App\Http\Controllers\UserController::class,'showbill']);
Route::get('transactions/users/{id}',[\App\Http\Controllers\BillController::class,'showtransaction']);
Route::get('transactionBill/users/{id}',[\App\Http\Controllers\BillController::class,'showtransactionbill']);
