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
        
       
           

        return response()->json($shopsLocations);
    }

    function fetchBrands()
    {
        $brandNames  =  DB::table('vehicles')
                        ->distinct()
                        ->select('brandname')->get();

        return response()->json($brandNames);
    }

    function fetchModels($brandName)
    {
        $brandModel  =  DB::table('vehicles')
                        ->where([
                            ['brandname',$brandName]
                            ])->get();           

        return response()->json($brandModel);
    }

    function bookservice(Request $req){

        $this->validate($req, [
            'username' => 'required',
            'password' => 'required',
        ]);

        //location_id
        //service_id
        //serviceprovider id needed
        $location_id = $req->input('location_id');
        $service_id = $req->input('service_id'); 

        //booking_id 
        //service_id
        //vehiclebrand_id
        //location_id
        //customer_id
        //serviceprovider_id
        //appointment_date
        //appointment_time
        //booking_date
        //booking_time
        //vehicleno
        //yearofmfc
        //status
        
        

         DB::insert('insert into customers  (booking_id, service_id, vehiclebrand_id, location_id, customer_id, serviceprovider_id, 
                                            appointment_date, appointment_time, booking_date, booking_time, vehicleno, yearofmfc, status) 
                                     values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
                                     [null, $service_id, $vehiclebrand_id, $location_id, $customer_id, $serviceprovider_id, 
                                     $appointment_date, $appointment_time, $booking_date, $booking_time, $vehicleno, $yearofmfc, 'Pending']);

       
    }
}
