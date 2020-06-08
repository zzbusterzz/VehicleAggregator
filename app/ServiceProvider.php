<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['username','firstname','lastname','password','phone','email'];

}
