<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Models\Bill;
use App\Models\Credit;
use App\Models\Refund;
use App\Models\Repayment;
use App\Models\Report;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show(Admin $admin)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $user)
    {

    }

    public function showuser($id){
       $user = User::findOrFail($id);
       return response()->json($user);
     //   return 'hello';
    }

    public function showbill($bill_id)
    {
        $bills = Bill::findOrFail($bill_id);
        return response()->json($bills);
    }
    public function showcredit($credit_id)
    {
        $credit = Credit::findOrFail($credit_id);
        return response()->json($credit);
    }
    public function showrefund($refund_id)
    {
        $refunds = Refund::findOrFail($refund_id);
        return response()->json($refunds);
    }
    public function showrepayment($repayment_id)
    {
        $repayments = Repayment::findOrFail($repayment_id);
        return response()->json($repayments);
    }
    public function showreport($report)
    {
        $reports = Report::findOrFail($report);
        return response()->json($reports);
    }
    public function showtransaction($transaction)
    {
        $transactions = Transaction::findOrFail($transaction);
        return response()->json($transactions);
    }
    public function showvendor($vendor)
    {
        $vendors = Vendor::findOrFail($vendor);
        return response()->json($vendors);
    }

}
