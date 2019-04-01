<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Airlines extends Model
{
    protected $fillable = [
    	'airline_id',
    	'airline_name',
        'nation_id'
    ];
    public $timestamps = false;
    protected $table = 'airlines';
    protected $primarykey = 'airline_id';
    
	public function flydetail()
    {
        return $this->hasMany('App\Model\Flydetail');
    }
}
