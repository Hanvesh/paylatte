<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $comments = User::all();
        return response()->json($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|integer|digits_between:12,12',
            'address' => 'required|string',
            'aadhar' => 'required|integer|digits_between:12,12',
            'pancard' =>
                'required|
            regex:/^([A-Z]){5}([0-9]){4}([A-Z]){1}?$/
       ',
            'dob' => 'date',
            'email' => 'required|string|unique:users|email',
            'password' => 'required|string|max:6',

        ]);

        $newUser = new User([
            'name' => $request->get('name'),
            'phone_number' => $request->get('phone_number'),
            'address'=>$request->get('address'),
            'aadhar'=>$request->get('aadhar'),
            'pancard'=>$request->get('pancard'),
            'dob'=>$request->get('dob'),
            'email'=>$request->get('email'),
            'password'=>$request->get('password')
        ]);

        $newUser->save();

        return response()->json($newUser);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|integer|digits_between:12,12',
            'address' => 'required|string',
            'aadhar' => 'required|integer|digits_between:12,12',
            'pancard' =>
                'required|
            regex:/^([A-Z]){5}([0-9]){4}([A-Z]){1}?$/
       ',
            'dob' => 'date',
            'email' => 'required|string|unique:users|email',
            'password' => 'required|string|max:6',

        ]);


        $user->name = $request->get('name');
        $user->phone_number= $request->get('phone_number');
        $user->address = $request->get('address');
        $user->aadhar= $request->get('aadher');
        $user->pancard= $request->get('pancard');
        $user->dob = $request->get('dob');
        $user->email = $request->get('email');
        $user->password = $request->get('password');

        $user->save();

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json($user::all());
    }
    public function showlimit($pan){

        $limit = DB::table('credits')->select('credit_limit')
                                    ->where('pancard','=',$pan)->first();

        return response()->json($limit);
    }
    public function showbalance($user){

        $balance = DB::table('transactions')->select('credit_balance')
            ->where('sender_id','=',$user)->first();

        return response()->json($balance);
    }
    public function showbill($user){
        $bill = DB::table('bills')->select('bill_amount')
            ->where('user_id','=',$user)->first();

        return response()->json($bill);
    }

}
