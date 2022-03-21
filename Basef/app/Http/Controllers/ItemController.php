<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return response()->json($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        $request->validate([
            'item_name' => 'required|string',
            'item_cost' => 'required|integer',
            'available_quantity' => 'required|integer',
        ]);

        $newitem = new Item([
            'item_name'=>$request->get('item_name'),
            'item_cost'=>$request->get('item_cost'),
            'available_quantity'=>$request->get('available_quanity')
        ]);
        $newitem ->save();

        return response()->json($newitem);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $items= Item::findOrFail($item);

        return response()->json($items);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item =  Item::findOrFail($item);

        $request->validate([
            'item_name' => 'required|string',
            'item_cost' => 'required|integer',
            'available_quantity' => 'required|integer',
        ]);

        $item->item_name = $request->get('item_name');
        $item->item_cost = $request->get('item_cost');
        $item->available_quantity = $request->get('available_quantity');

        $item->save();

        return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item = Item::findOrFail($item);
        $item->delete();

        return response()->json($item::all());
    }
}
