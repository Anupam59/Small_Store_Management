<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
    function index()
    {
        return view('auth.login');
    }



    function registration()
    {
        return view('auth.registration');
    }



    function validate_registration(Request $request)
    {
        $request->validate([
            'name'         =>   'required',
            'email'        =>   'required|email|unique:users',
            'password'     =>   'required|min:6'
        ]);
        $data = $request->all();
        User::create([
            'name'  =>  $data['name'],
            'email' =>  $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        return redirect('login')->with('success', 'Registration Completed, now you can login');
    }


    function validate_login(Request $request)
    {
        $request->validate([
            'email' =>  'required',
            'password'  =>  'required'
        ]);
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials))
        {
            return redirect('dashboard');
        }
        return redirect('login')->with('success', 'Login details are not valid');
    }


    function dashboard()
    {

        if(Auth::check())
        {
            return redirect('dashboard');
        }
        return redirect('login')->with('success', 'you are not allowed to access');
    }


    function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
