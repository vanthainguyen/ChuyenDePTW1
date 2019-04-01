<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FlightRoute extends Model
{
    protected $fillable = [
    	'fr_id',
        'fr_name'
    ];

    protected $table = 'flight_route';
    protected $timestamp = false;
    protected $primarykey = 'fr_id';
}
