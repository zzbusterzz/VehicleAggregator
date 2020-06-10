<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'category'
    ];
}
