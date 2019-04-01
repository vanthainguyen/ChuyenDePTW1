<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transits extends Model
{
     protected $fillable = [
    	'transit_id',
        'transit_city',
        'transit_departure_date',
        'transit_landing_date',
        'transit_fl_id',
        'transit_airport_id'
    ];

    protected $table = 'transits';
    protected $timestamp = false;
    protected $primarykey = 'transit_id';

    public function getTransit($idfly)
    {
        $obj = new Transits();
        $values = $obj::where('transit_fl_id',$idfly)
                ->join('cities','cities.city_id', '=', 'transits.transit_city_id')
                ->join('airports','airports.airport_id', '=', 'transits.transit_airport_id')
                ->paginate(4);
        return $values;
    }
}
