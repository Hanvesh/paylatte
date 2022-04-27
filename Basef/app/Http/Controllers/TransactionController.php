<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Credit;
use App\Models\Transaction;
use App\Models\User;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $transactions = Transaction::all();
        return response()->json($transactions);
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
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $faker = Factory::create();
  /*      $credit = User::all()->where('id','=',$request->get('sender_id'))->first();
        $pan = $credit->pancard;
        $panc = DB::table('credits')->select('credit_limit')
            ->where('pancard','=',$pan)->first(); */
        $request->validate([
            'sender_id'=>'required|integer',
            'receiver_id'=>'required|integer',
            'transaction_amount'=>'required|integer'
        ]);
        $rt = DB::table('transactions')->select('credit_balance')
            ->where('sender_id','=',$request->get('sender_id'))
            ->orderBy('transaction_date','desc')->first();
        $r = $rt->credit_balance;
        echo($r);
        DB::table('transactions')->insert([
            'sender_id' =>$request->get('sender_id'),
            'receiver_id' => $request->get('receiver_id'),
            'transaction_type'=>'debit',
            'transaction_amount' => $tr = $request->get('transaction_amount'),
            'transaction_status' => $ts = rand(0,1),
            'transaction_date' => now(),
            'credit_balance'=> $this->diff($r,$tr)

        ]);
        if($ts ==1){return response()->json(["status"=>"Transaction Recorded and Successful"]);}
        return response()->json(["status"=>"Transaction Recorded and Failed"]);




    }

    function diff($b,$c)
    {
        if(($b > $c) &&($b > 1)){
            return $b -$c;
        }
        else{
            return $b;
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Transaction $transaction)
    {
        $transactions = Transaction::findOrFail($transaction);
        return response()->json($transactions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionRequest  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->transaction_status =(bool)$request->get('transaction_status');
        $transaction->save();

        return response()->json($transaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
