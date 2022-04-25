<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRepaymentRequest;
use App\Http\Requests\UpdateRepaymentRequest;
use App\Models\Bill;
use App\Models\Repayment;
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $faker=Factory::create();
        $request->validate([
            'user_id'=>'required|integer',
        ]);
        $id= $request->get('user_id');
        $bill = DB::table('bills')->select('id','bill_amount',
            'bill_due_date')->where('user_id', '=', $id)->first();
        $bill_id = $bill->id;
        $bill_amount=$bill->bill_amount;
        $bill_date=$bill->bill_due_date;
        DB::table('repayments')->insert([
            'bill_id'=>$bill_id,

            'repayment_date'=>$rd=$faker->dateTimeBetween($bill_date,"$bill_date + 2 month"),
            'repayment_amount'=> (int)$this->lateFee($bill_amount,$bill_date,$rd),
            'repayment_status'=>$rs = rand(0,1)
        ]);
        if($rs==1){
            return response()->json(["status","Repayment Sucessfull"]);
        }
        return response()->json(["status","Repayment Not Sucessfull"]);

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
