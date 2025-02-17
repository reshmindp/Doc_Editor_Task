<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        
        return redirect('/')->with('success', 'Registration successful!');

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $authentication = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
       
        if($authentication)
        {
            Toastr::success("Welcome to Home Page","Success",["positionClass" => "toast-bottom-left"]);
            return redirect()->route('dashboard');   
        }
        else
        {
             
            return back()->with('error', 'Invalid username or password.');
        }

    }
}
