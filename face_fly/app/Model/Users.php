<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = [
    	'user_id',
        'user_email',
        'user_password',
        'user_first_name',
        'user_last_name',
        'user_phone',
        'user_last_access',
        'user_attempt',
        'user_status'
    ];

    protected $table = 'users';
    protected $timestamp = false;
    protected $primarykey = 'user_id';
    const UPDATED_AT = null;

    // Lấy toàn bộ dữ liệu ra = email 
    public function getdata($email)
    {
        $users = $this->where('user_email',$email)->get();
        return $users[0];
    }
    // Hàm cập nhật khi login sai 
    public function updateAttempt($email,$date,$attempt)
    {
        Users::where('user_email',$email)->update(['user_attempt'=> $attempt,'user_last_access'=>$date]);
    }
    
}
