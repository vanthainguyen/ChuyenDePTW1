<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\MessageBag;
use App\Model\Users;
Use Alert;
use DateTime;

class LoginController extends Controller
{
    
    public function getLogin() {
        return view('login');
    }

    public function postLogin(Request $request) 
    {
        // Validator - for Login 
        $rules = [
            'email' =>'required|email',
            'password' => 'required|min:6'
        ];
        // The Message of the Validator will return when an error occurs
        $messages = [
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
        ];

    
        // Check error from user input 
        $validator = Validator::make($request->all(),$rules,$messages);

        if ($validator->fails()) # if have error
        {
            return redirect()->back()->withErrors($validator)->withInput();
        } 
        else 
        {
            $obj_users = new Users();
            $data_users = $obj_users->getdata($request->email);

            $attempt_now = $data_users['user_attempt'];
            $getEmail = $data_users['user_email'];
            $getPassword = $data_users['user_password'];
            $getLast_access = strtotime($data_users['users_last_access']);
            

            if($getEmail == $request->email) 
            {   
                if($getPassword == $request->password )
                {
                    if($attempt_now >= 3)
                    {
                        $current_time = time('Asia/Ho_Chi_Minh');
                        if($getLast_access < $current_time && $current_time < $getLast_access + 1800)
                        {
                            return redirect()->route('home')->with('errorlogin', alert()->dangerous('Thông báo', 'Tài khoản đã bị khóa 30 phút !'));
                        }
                        else
                        {
                            $obj_users->updateAttempt($getEmail,$current_time,0);
                        }
                    }
                    else
                    {
                        $current_time = time('Asia/Ho_Chi_Minh');
                        // Set session return for app.blade.php
                        $request->session()->put('login', true);
                        $request->session()->put('email', $data_users['user_email']);
                        $request->session()->put('firstname', $data_users['user_first_name']);
                        $request->session()->put('lastname', $data_users['user_last_name']);
                        $request->session()->put('phonenumber', $data_users['user_phone']);

                        return redirect()->route('home')->with('errorlogin', alert()->success('Thông báo', 'Đăng nhập thành công !'));
                    }
                }
                else
                {
                    if($attempt_now >= 3)
                    {
                        $current_time = time();
                        if($getLast_access < $current_time && $current_time < $getLast_access + 1800)
                        {
                            return redirect()->route('home')->with('errorlogin', alert()->dangerous('Thông báo', 'Tài khoản đã bị khóa 30 phút !'));
                        }
                        else
                        {
                            $obj_users->updateAttempt($getEmail,$current_time,0);
                        }
                    }
                    else
                    {
                        $current_time = time();
                        $obj_users->updateAttempt($getEmail,$current_time,$attempt_now + 1);
                        return redirect()->back()->with('errorlogin', alert()->error('Sai email hoặc mật khẩu !','Vui lòng kiểm tra lại !'));
                    }   
                }
            } 
            else 
            {
                $errors = new MessageBag(['errorlogin' => 'Email không tồn tại . Vui lòng đăng ký tài khoản!']);
                return redirect()->back()->withInput()->withErrors($errors);
            }
        }
    }
    public function getLogout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('getLogin')->with('errorlogin', alert()->info('Thông báo', 'Đã đăng xuât tài khoản !'));
    }


}



