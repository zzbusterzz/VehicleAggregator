<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use DB;

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
    public function updatedelrecord(Request $request)
    {

        switch ($request->input('action')) {
            case 'update':
                // Save model
                $test = 0;
                break;
    
            case 'delete':
                // Preview model
                $test = 0;
                break;
    
            case 'Add Shop':
                // Redirect to advanced edit
                $test = 0;
                break;
        }

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

        $shop = new Location([
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

    public function getUserLocations($userid)
    {
        $data = DB::table('locations')
        ->join('provided_by', 'provided_by.location_id', '=', 'locations.id')
        // ->join('services', 'services.id', '=', 'provided_by.service_id')
        ->select('provided_by.location_id', 'locations.h_no', 'locations.street', 'locations.locality', 'locations.city', 'locations.state', 
                'locations.pincode', 'locations.shopphone', 'locations.shopname')
        ->where('provided_by.serviceprovider_id', '=', $userid)
        ->distinct()
        ->get();
        return view('serviceprovider.AddShop', compact('data'));
    }

    public function getServForLocations($locid)
    {
        $data = DB::table('provided_by')
        ->where([
            ['location_id',$locid]
            ])
        ->get();
        return response()->json($data);
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
