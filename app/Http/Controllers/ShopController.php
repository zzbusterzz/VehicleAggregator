<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('serviceprovider.AddShop');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'shopno' => 'required',
            'shopname' => 'required',
            'shopphone' => 'required',
            'street' => 'required',
            'locality' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required'
        ]);

        $shop = new Shop([
            'Service' => $request->get('Service'),
            'shopno' => $request->get('shopno'),
            'shopname' => $request->get('shopname'),
            'shopphone' => $request->get('shopphone'),
            'street' => $request->get('street'),
            'locality' => $request->get('locality'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'pincode' => $request->get('pincode')
        ]);
        $shop->save();
        return redirect()->route('AddShop');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
