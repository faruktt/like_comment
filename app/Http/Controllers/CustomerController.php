<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CustomerController extends Controller
{

   public function log(){
    return view('customer.log');
   }
   public function reg(){
    return view('customer.reg');
   }


   public function store(Request $request){
      $request->validate([
           'name' => 'required',
           'email' => 'required',
           'password' => 'required',
      ]);
     Customer::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
     ]);
     return back();
   }

   public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    public function logout()
        {
            Auth::guard('customer')->logout();
            return redirect('/');
        }



}

