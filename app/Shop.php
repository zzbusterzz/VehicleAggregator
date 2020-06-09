<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = ['Service','shopno', 'shopname', 'shopphone', 'street', 'locality', 'city', 'state', 'pincode'];
}
