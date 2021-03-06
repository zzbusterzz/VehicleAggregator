<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requests;
use DB;

class BookingsController extends Controller
{
    function fetchStates($services)
    {

        $states = DB::table('locations')
                    ->distinct()
                    ->select('locations.state')
                    ->join('provided_by','provided_by.location_id','=','locations.id')
                    ->where('provided_by.service_id', $services )
                    ->get();
                    
        return response()->json($states);    
    }

    function fetchCities($services, $state)
    {
        $cities  =  DB::table('locations')
                    ->distinct()
                    ->select('locations.city')
                    ->join('provided_by','provided_by.location_id','=','locations.id')
                    ->where([
                        ['provided_by.service_id', $services],
                        ['state', $state]
                     ])
                    ->get();

        return response()->json($cities);    
    }

    function fetchServiceProviders($services, $state, $city)
    {
        $shopsLocations  =  DB::table('locations')
                            ->join('provided_by','provided_by.location_id','=','locations.id')
                            ->where([
                                ['provided_by.service_id', $services],
                                ['state',$state],
                                ['city', $city],
                                ])
                            ->get();

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
        //location_id
        //service_id
        //serviceprovider id needed
        $location_id = $req->input('location_id');
        $service_id = $req->input('service_id'); 

        //booking_id 
        //service_id        X
        //vehiclebrand_id   X
        //location_id       X
        //customer_id
        //serviceprovider_id
        //appointment_date
        //appointment_time
        //booking_date
        //booking_time
        //vehicleno
        //yearofmfc
        //status
        $serviceProvID  =  DB::table('provided_by')
                        ->select('serviceprovider_id')
                        ->where([
                            ['location_id',$location_id],
                            ['service_id',$service_id]
                            ])->value('serviceprovider_id');;  
       
        
            
        $serviceprovider_id = $serviceProvID;
        

        $vehiclebrand_id = $req->input('vehiclebrand_id');
        //$serviceprovider_id  = '2';
        //print("Controllller +" + $serviceprovider_id);
        //$serviceProvID->get("serviceprovider_id"); 
        $customer_id =  $req->session()->get('user_id');
        $appointment_date = $req->input('appointment_date');
        $appointment_time = $req->input('appointment_time'); 
        $booking_date = $req->input('booking_date');
        $booking_time = $req->input('booking_time'); 
        $vehicleno = $req->input('vehicleno');
        $yearofmfc = $req->input('yearofmfc'); 
                           
       
        // $request = new Requests([
        //     'service_id' => $service_id,
        //     'vehiclebrand_id' => $vehiclebrand_id,
        //     'location_id' => $location_id,
        //     'customer_id' => $customer_id,
        //     'serviceprovider_id' => $serviceProvID,
        //     'appointment_date' => $appointment_date,
        //     'appointment_time' => $appointment_time,
        //     'booking_date' => $booking_date,
        //     'booking_time' => $booking_time,
        //     'vehicleno' => $vehicleno,
        //     'yearofmfc' => $yearofmfc,
        //     'status' => 'Pending'
        // ]);
        // $request->save();
        
                    
        $checkInsert = DB::insert('insert into requests  (booking_id, service_id, vehiclebrand_id, location_id, customer_id, serviceprovider_id, 
                                        appointment_date, appointment_time, booking_date, booking_time, vehicleno, yearofmfc, status) 
                                    values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
                                    [null, $service_id, $vehiclebrand_id, $location_id, $customer_id, $serviceprovider_id, 
                                    $appointment_date, $appointment_time, $booking_date, $booking_time, $vehicleno, $yearofmfc, 'Pending']);

        if($checkInsert){
           return redirect()->back()->with('success','Booked service successfully!');
        }
    }

    function fetchBrandsAndModel($brandID)//Returns brand name and subtype based on id
    {
        $brandDet  =  DB::table('vehicles')
                        ->where([
                            ['id',$brandID]
                            ])->get(); 
        return response()->json($brandDet);
    }

    function fetchLocationOnID($locID)//Returns brand name and subtype based on id
    {
        $locDet  =  DB::table('locations')
                        ->where([
                            ['id',$locID]
                            ])->get(); 
        return response()->json($locDet);
    }

    function fetchServiceOnID($servID)//Returns brand name and subtype based on id
    {
        $serv  =  DB::table('services')
                        ->where([
                            ['id',$servID]
                            ])->get(); 
        return response()->json($serv);
    }
}
