<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\Location;
use App\ProvidedBy;
use DB;

class ShopController extends Controller
{
    public function updateadddelloc(Request $request)
    {

        $result = 0;
        switch ($request->input('action')) {
            case 'Update':
                // Save model
                $this->validate($request, [
                    'shopno' => 'required|max:8',
                    'shopname' => 'required|max:128|alpha',
                    'shopphone' => 'required|max:255|numeric',
                    'street' => 'required|max:64',
                    'locality' => 'required|max:64',
                    'city' => 'required|max:25',
                    'state' => 'required|max:25',
                    'pincode' => 'required|max:11|numeric',
                    'service' => 'required',
                ]);

                $result = DB::table('locations')->where('id',  $request->input('locid'))
                                                ->update([  'h_no' => $request->input('shopno'),
                                                            'street' => $request->input('street'),
                                                            'locality' => $request->input('locality'),
                                                            'city' => $request->input('city'),
                                                            'state' => $request->input('state'),
                                                            'pincode' => $request->input('pincode'),
                                                            'shopphone' => $request->input('shopphone'),
                                                            'shopname' => $request->input('shopname')]);

                $userid =  $request->session()->get('user_id');
                $str_arr = explode ("/", $request->input('servicevalues'));
                $result = DB::table('provided_bies')->where('location_id', $request->input('locid'))->delete();//clear linked data for that location

                foreach ($str_arr as $service)//enter data freshly
                {
                    if($request->input($service) == "true"){
                        $provide = new ProvidedBy([
                            'serviceprovider_id' => $userid,
                            'location_id' => $request->input('locid'),
                            'service_id' => $service,
                        ]);
                        $provide->save();
                        $provide = null;
                    }
                }

                return back()->with('info','Location Deleted Successfully');
                break;

            case 'Delete':
                //locid
                $result = DB::table('locations')->where('id',  $request->input('locid'))
                                                ->delete();
                if($result != 1)
                    return back()->with('error','Could not delete location');

                $result = DB::table('provided_bies')->where('location_id', $request->input('locid'))
                                        ->delete();


                if($result == 1)
                    return back()->with('info','Location Deleted Successfully');
                else
                    return back()->with('error','Could not delete location');
                break;

            case 'Add Shop':
                // Redirect to advanced edit
                $this->validate($request, [
                    'shopno' => 'required|max:8',
                    'shopname' => 'required|max:128',
                    'shopphone' => 'required|max:255',
                    'street' => 'required|max:64',
                    'locality' => 'required|max:64',
                    'city' => 'required|max:64',
                    'state' => 'required|max:64',
                    'pincode' => 'required|max:11',
                    'service' => 'required',
                ]);

                $location = new Location([
                    'h_no' => $request->input('shopno'),
                    'street' => $request->input('street'),
                    'locality' => $request->input('locality'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'pincode' => $request->input('pincode'),
                    'shopphone' => $request->input('shopphone'),
                    'shopname' => $request->input('shopname')
                ]);
                $result = $location->save();

                $result = DB::table('locations')
                        ->select('locations.id')
                        ->where([
                        'h_no' => $request->input('shopno'),
                        'street' => $request->input('street'),
                        'locality' => $request->input('locality'),
                        'city' => $request->input('city'),
                        'state' => $request->input('state'),
                        'pincode' => $request->input('pincode'),
                        'shopphone' => $request->input('shopphone'),
                        'shopname' => $request->input('shopname')
                    ])
                    ->get();

                $locid = $result[0]->id;
                $userid =  $request->session()->get('user_id');
                $str_arr = explode ("/", $request->input('servicevalues'));

                foreach ($str_arr as $service)//enter data freshly
                {
                    if($request->input($service) == "true"){
                        $provide = new ProvidedBy([
                            'serviceprovider_id' => $userid,
                            'location_id' => $locid,
                            'service_id' => $service,
                        ]);
                        $provide->save();
                        $provide = null;
                    }
                }

                return back()->with('info','Location Deleted Successfully');
                break;
        }
    }

    public function getUserLocations($userid)
    {
        $data = DB::table('locations')
        ->join('provided_bies', 'provided_bies.location_id', '=', 'locations.id')
        // ->join('services', 'services.id', '=', 'provided_bies.service_id')
        ->select('provided_bies.location_id', 'locations.h_no', 'locations.street', 'locations.locality', 'locations.city', 'locations.state',
                'locations.pincode', 'locations.shopphone', 'locations.shopname')
        ->where('provided_bies.serviceprovider_id', '=', $userid)
        ->distinct()
        ->get();
        return view('serviceprovider.AddShop', compact('data'));
    }

    public function getServForLocations($locid)
    {
        $data = DB::table('provided_bies')
        ->where([
            ['location_id',$locid]
            ])
        ->get();
        return response()->json($data);
    }
}
