<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $fillable = [
    	'customer_id',
    	'customer_user_id',
    	'customer_first_name',
    	'customer_last_name',
    	'customer_title',
    	'customer_tranfer',
    	'customer_paypal',
        'customer_credit_card',
    	'customer_creadit_name',
    	'customer_creadit_ccv'
    ];
    protected $table = 'customers';
    protected $timestamp = false;
    protected $primarykey = 'customer_id';

}
