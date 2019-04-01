<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $fillable = [
    	'city_id',
        'city_name',
        'city_code',
        'city_airport_id'
    ];
    public $timestamps = false;
    protected $table = 'cities';
    protected $primarykey = 'city_id';



    public function getCityAsc()
    {
        $citiesfrom = $this->all();
        return $citiesfrom;
    }

    public function getCityDesc()
    {
        $citiesto = $this->orderBy('city_id',' DESC')->get();
        return $citiesto;
    }
}
