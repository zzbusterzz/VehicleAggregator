<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'booking_id', 'service_id', 'vehiclebrand_id', 'location_id', 'customer_id', 'serviceprovider_id', 
        'appointment_date', 'appointment_time', 'booking_date', 'booking_time', 'vehicleno', 'yearofmfc', 'status'
    ];
}
