<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProvidedBy extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'serviceprovider_id', 'location_id', 'service_id'
    ];
}
