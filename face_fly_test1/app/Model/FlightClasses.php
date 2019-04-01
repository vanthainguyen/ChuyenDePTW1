<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FlightClasses extends Model
{
    protected $fillable = [
    	'fc_id',
        'fc_name'
    ];

    protected $table = 'flight_classes';
    protected $timestamp = false;
    protected $primarykey = 'fc_id';

    
    public function flydetail()
    {
        return $this->belongsTo('App\Model\Flydetail');
    }
}
