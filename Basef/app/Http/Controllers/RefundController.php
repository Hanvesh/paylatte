<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRefundRequest;
use App\Http\Requests\UpdateRefundRequest;
use App\Models\Refund;
use App\Models\Transaction;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RefundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $refunds = Refund::all();
        return response()->json($refunds);
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
     * @param  \App\Http\Requests\StoreRefundRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $faker=Factory::create();
        $request->validate([
            'transaction_id'=>'required|integer',
            'transaction_amount'=>'required|integer'
        ]);
        $trans_id=$request->get('transaction_id');
      /*  $transaction = Transaction::all('transaction_type','transaction_amount',
            'transaction_date', 'transaction_status')->where('id', '=', $trans_id);*/
      $transaction = DB::table('transactions')->select('transaction_type','transaction_amount',
            'transaction_date', 'transaction_status')->where('id', '=', $trans_id)->first();
        $trans_date = $transaction->transaction_date;
        $trans_status = $transaction->transaction_status;
        $trans_amount = $transaction->transaction_amount;
        $type=$transaction->transaction_type;

        if($trans_status == false ) {
            DB::table('refunds')->insert([
                'transaction_id' => $trans_id,
                'refund_amount' => $trans_amount,
                'refund_date' => $faker->dateTimeBetween($trans_date,'+1 week'),
                'refund_status'=>1,
            ]);
            return response("Transaction failed and send to refunds");
        }
        return response("Transaction failed but not send to refunds");

    }

    /**s
     * Display the specified resource.
     *
     * @param  \App\Models\Refund  $refund
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Refund $refund_id)
    {
        $refunds = Refund::findOrFail($refund_id);
        return response()->json($refunds);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Refund  $refund
     * @return \Illuminate\Http\Response
     */
    public function edit(Refund $refund)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRefundRequest  $request
     * @param  \App\Models\Refund  $refund
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRefundRequest $request, Refund $refund)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Refund  $refund
     * @return \Illuminate\Http\Response
     */
    public function destroy(Refund $refund)
    {
        //
    }
}
