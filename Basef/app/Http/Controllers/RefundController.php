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
        ]);
        $trans_id=$request->get('transaction_id');
      $transaction = Transaction::all()->where('id', '=', $trans_id)->first();
      $scid = $transaction->sender_id;
      $rcid = $transaction->receiver_id;
      $refund = Refund::all()->where('transaction_id', '=', $trans_id)->first();
      $rid = $refund->id;
      $amount = $refund->refund_amount;
      $status = $refund->refund_status;
      $rt = DB::table('transactions')->select('credit_balance')
            ->where('sender_id','=',$scid)
            ->orderBy('transaction_date','desc')->first();
      $rs = $rt->credit_balance;
        echo($rs);
        DB::table('transactions')->insert([
            'id'=>$rid,
            'sender_id' =>$rcid,
            'receiver_id' => $scid,
            'transaction_type'=>'refund',
            'transaction_amount' => $amount,
            'transaction_status' => $status,
            'transaction_date' => now(),
            'credit_balance'=> (int)$this->summ($rs, $amount)

        ]);
        if($status ==1){return response()->json(["status"=>"Transaction Recorded and Amount Refund"]);}
        return response()->json(["status"=>"Transaction Recorded and Amount Not Refunded"]);




    }
    function summ($b,$c)
    {
            return $b + $c;


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
