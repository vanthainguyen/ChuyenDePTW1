<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Nation extends Model
{
    protected $fillable = [
    	'nation_id',
        'nation_name'
    ];

    protected $table = 'nation';
    protected $timestamp = false;
    protected $primarykey = 'nation_id';

}
