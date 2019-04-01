<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
Use Alert;
use App\Model\Users;

class RegisterController extends Controller
{
     public function store(Request $request)
    {
    	$messages = [
    		'email.required' => 'Email là trường bắt buộc',
    		'email.email' => 'Email không đúng định dạng',
    		'password.required' => 'Mật khẩu là trường bắt buộc',
    		'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
    		'password.max' => 'Mật khẩu lớn nhất 20 ký tự',
            'phone.required' => 'Mật khẩu là trường bắt buộc',
            'phone.min' => 'Số điện thoại phải chứa ít nhất 10 ký tự',
            'phone.max' => 'Số điện thoại chỉ chứa lớn nhất 15 ký tự',
            
    	];
        $validator = Validator::make($request->all(), [
            'email'      => 'required|email',
            'password'    => 'required|min:8|max:20',
            'first_name'       => 'required',
            'last_name'       => 'required',
            'phone' => 'required|min:10|max:15'
        ],$messages);

    	
        if ($validator->fails()) 
        {
           return redirect()->back()->withErrors($validator)->withInput();
        } 
        else 
        {

            $checkemail = Users::where('user_email',$request->email)->get();
            if(count($checkemail) > 0)
            {
                return redirect()->route('regis')->with('message', alert()->error('Thông báo', 'Tài khoản đã tồn tại !'));
            }
            else
            {
                
                Users::insert([
                    'user_email'       => $request->input('email'),
                    'user_password'      => $request->input('password'),
                    'user_last_name'    => $request->input('last_name'),
                    'user_first_name'    => $request->input('first_name'),
                    'user_phone' => $request->input('phone')
                ]);
                return redirect()->route('getLogin')->with('message', alert()->success('Thông báo', 'Đăng ký tài khoản thành công !'));
            }
            
        }
    }
}
