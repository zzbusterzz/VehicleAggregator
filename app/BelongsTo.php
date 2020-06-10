<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BelongsTo extends Model
{
    protected $table = 'belongs_to';

    public $timestamps = false;

    protected $fillable = [
        'vehiclebrand_id', 'part_id'
    ];
}
