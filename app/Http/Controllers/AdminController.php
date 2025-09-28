<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request)
    {   
        return view('auth.login');
    }

    public function admin_login(Request $request)
    {
        
        $credentials = $request->validate([            
            'username' => 'required|string|max:200',
            'password' => 'required',
        ]);

        // dd($request->all());

        // $user = Admin::where('username', $credentials['username'])->first();
        // if($user && Hash::check($credentials['password'], $user->password)){
        //     $request->session()->put('type', 'admin');
        //     $request->session()->put('id', $user['id']);            
        //     return 1;
        // } else{
        //     return 0;
        // }
        
        if (Auth::guard('admin')->attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            return 1;            
        }else{
            return 0;
        }

        

    }
    
}
