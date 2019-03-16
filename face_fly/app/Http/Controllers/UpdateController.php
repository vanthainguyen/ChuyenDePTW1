<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpdateController extends Controller
{
   public function store(Request $request)
    {
    	$messages = [
    		'email.required' => 'Email là trường bắt buộc',
    		'email.email' => 'Email không đúng định dạng',
    		'password.required' => 'Mật khẩu là trường bắt buộc',
    		'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
    		'password.max' => 'Mật khẩu lớn nhất 20 ký tự',
    	];
        $validator = Validator::make($request->all(), [
            'email'      => 'required|email',
            'password'    => 'required|min:8|max:20',
            'name'       => 'required',
            'phonenumber' => 'required|max:20'
        ],$messages);

    	
        if ($validator->fails()) {
           return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // Lưu thông tin vào database, phần này sẽ giới thiệu ở bài về database
            DB::table('users')->insert([
                'email'       => $request->input('email'),
                'password'      => $request->input('password'),
                'name'    => $request->input('name'),
                'phonenumber' => $request->input('phonenumber')
                ]);
            return redirect()->route('home')->with('message', 'Tài khoản đã đăng ký thành công ');
        }
    }
}
