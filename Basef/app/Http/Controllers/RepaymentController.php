<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRepaymentRequest;
use App\Http\Requests\UpdateRepaymentRequest;
use App\Models\Bill;
use App\Models\Repayment;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $repayments = Repayment::all();
        return response()->json($repayments);
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
     * @param  \App\Http\Requests\StoreRepaymentRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $faker=Factory::create();
        $request->validate([
            'name'=>'required|string',
            'dob'=>'required|date'
        ]);
        $user = User::all()->where('name','=', $request->get('name'))
            ->where('dob','=',$request->get('dob'))->first();
        $id = $user->id;
        $bill = Bill::all()->where('user_id','=',$id)->first();
        $bill_id = $bill->id;
        $rt = DB::table('transactions')->select('credit_balance')
            ->where('sender_id','=',$id)
            ->orderBy('transaction_date','desc')->first();
        $r = $rt->credit_balance;
        $repayment = Repayment::all()->where('bill_id','=',$bill_id)->first();
        $repayment_id = $repayment->id;
        $repayment_status=$repayment->repayment_status;
        $repayment_cost = $repayment->repayment_amount;
        $repayment_date = $repayment->repayment_date;
        if($repayment_status) {
            DB::table('transactions')->insert([
                'id' => $repayment_id,
                'sender_id' => $id,
                'receiver_id' => '1612512120205',
                'transaction_type' => 'repayment',
                'transaction_amount' => $repayment_cost,
                'transaction_status' => 1,
                'transaction_date' =>$rs=now(),
                'credit_balance' => $this->lateFee($r,$repayment_date,$rs)
            ]);

            return response()->json(["status","Repayment Successful and Transaction Recorded"]);}

        return response()->json(["status","Repayment Not Successful and Transaction Recorded"]);

    }
    function lateFee($bill,$bd,$rd){
        $c = Carbon::parse($bd)->diffInDays(Carbon::parse($rd));
        if($c >30){
            $c = $c -30;
            if($bill >=0 && $bill <= 1500){
                $bill +=($c * 10);
                return $bill;
            }
            if($bill >=1501 && $bill <= 4000){
                $bill +=($c * 15);
                return $bill;
            }
            if($bill >=4001 && $bill <= 6000){
                $bill +=($c * 20);
                return $bill;

            }
            if($bill > 6000 ){
                $bill +=($c * 30);
                return $bill;
            }
        }
        return $bill;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Repayment  $repayment
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Repayment $repayment_id)
    {
        $repayments = Repayment::findOrFail($repayment_id);
        return response()->json($repayments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Repayment  $repayment
     * @return \Illuminate\Http\Response
     */
    public function edit(Repayment $repayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRepaymentRequest  $request
     * @param  \App\Models\Repayment  $repayment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRepaymentRequest $request, Repayment $repayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Repayment  $repayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repayment $repayment)
    {
        //
    }
}
