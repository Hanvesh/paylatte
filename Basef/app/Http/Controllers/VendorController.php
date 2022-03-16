<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use App\Models\Vendor;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $vendors = Vendor::all();
        return response()->json($vendors);
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
     * @param  \App\Http\Requests\StoreVendorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorRequest $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users|email',
            'password' => 'required|string|max:6',
            'phone_number' => 'required|integer|digits_between:12,12',
            'address' => 'required|string',
        ]);

        $newvendor = new Vendor([
            'name' => $request->get('name'),
           ' email'=>$request->get('email'),
            'password'=>$request->get('password'),
            'phone_number' => $request->get('phone_number'),
            'address'=>$request->get('address'),

        ]);

        $newvendor->save();

        return response()->json($newvendor);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Vendor $vendor)
    {
        $vendors = Vendor::findOrFail($vendor);
        return response()->json($vendors);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVendorRequest  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        $vendor = Vendor::findOrFail($vendor);
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users|email',
            'password' => 'required|string|max:6',
            'phone_number' => 'required|integer|digits_between:12,12',
            'address' => 'required|string',
        ]);
        $vendor->name = $request->get('name');
        $vendor->email = $request->get('email');
        $vendor->password=$request->get('password');
        $vendor->phone_number = $request->get('phone_number');
        $vendor->address = $request->get('address');

        $vendor->save();

        return response()->json($vendor);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $vendor = Vendor::findOrFail($vendor);
        $vendor->delete();

        return response()->json($vendor::all());
    }
}
