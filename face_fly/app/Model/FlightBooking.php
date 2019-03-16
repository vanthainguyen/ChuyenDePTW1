<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{
    protected $fillable = [
    	'fb_id',
    	'fb_airline_id',
    	'fb_city_from_id',
    	'fb_city_to_id',
    	'fb_departure_date',
    	'fb_landing_day',
    	'fb_transit_id'
    ];

    protected $table = 'flight_booking';
    protected $timestamp = false;
    protected $primarykey = 'fb_id';

}
