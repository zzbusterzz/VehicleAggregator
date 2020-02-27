<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use DB;

class BookingsController extends Controller
{
    function fetchStates()
    {
        $states  =  DB::table('locations')
                    ->distinct()
                    ->select('state')->get();

        return response()->json($states);    
    }

    function fetchCities($state)
    {
        $cities  =  DB::table('locations')
                    ->distinct()
                    ->select('city')
                    ->where('state', $state)->get();

        return response()->json($cities);    
    }

    function fetchServiceProviders($state, $city)
    {
        $shopsLocations  =  DB::table('locations')
                            ->where([
                                ['state',$state],
                                ['city', $city],
                                ])->get();
        
        // $a=array();

        // foreach($shopsLocations as $location){
        //     $Location = new Customer([
        //         'id' => $location->id,
        //         'h_no' => $location->h_no,
        //         'street' => $location->street,
        //         'locality' => $location->locality,
        //         'city' => $location->city,
        //         'state' => $location->state,
        //         'pincode' => $location->pincode,
        //         'shopphone' => $location->shopphone,
        //         'shopname' => $location->shopname,
        //     ]);
        //     array_push($a, $Location );
        // }
           

        return response()->json($shopsLocations);
    }
}
