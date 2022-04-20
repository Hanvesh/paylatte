<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Credit;
use App\Models\Transaction;
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
        $credit = Credit::all()->random();
        $limit = $credit->credit_limit;
        $request->validate([
            'sender_id'=>'required|integer',
            'receiver_id'=>'required|integer',
            'transaction_amount'=>'required|integer'
        ]);

         DB::table('transactions')->insert([
            'sender_id' =>$request->get('sender_id'),
            'receiver_id' => $request->get('receiver_id'),
            'transaction_type'=>'debit',
            'credit_limit'=>$limit,
            'transaction_amount' => $tr = $request->get('transaction_amount'),
            'transaction_status' => $ts = rand(0,1),
            'transaction_date' => $faker->dateTimeBetween('-2 years'),
            'credit_balance' => $this->diff($ts,$limit,$tr),
        ]);


       if($tr==1){ return response("Transaction Successfull");}
       else{
           return response("Transaction Failed");
       }



    }

    function diff($a,$b,$c){
        if (($a ==1) and ($b > $c)){
            $b = $b - $c;
        }
        return $b;

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
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
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
