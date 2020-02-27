<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'id', 'h_no', 'street', 'locality', 'city', 'state', 'pincode', 'shopphone', 'shopname'
    ];
}
