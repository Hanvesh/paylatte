<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Models\Bill;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $bills = Bill::all();
        return response()->json($bills);
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
     * @param \App\Http\Requests\StoreBillRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBillRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill_id)
    {
        $bills = Bill::findOrFail($bill_id);
        return response()->json($bills);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateBillRequest $request
     * @param \App\Models\Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBillRequest $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        //
    }

    function showtransaction($us)
    {
        $transaction = DB::table('transactions')->select('receiver_id', 'transaction_amount',
            'transaction_date', 'transaction_status')->where('sender_id', '=', $us)->get();

        $bill = $transaction->sum('transaction_amount');

        return response()->json($transaction);

    }

    function showtransactionbill($us)
    {
        $transaction = DB::table('transactions')->select('receiver_id', 'transaction_amount',
            'transaction_date', 'transaction_status')->where('sender_id', '=', $us)
            ->where('transaction_status','=',true)->get();
            $bill = $transaction->sum('transaction_amount');
            return response()->json($bill);




    }

}


