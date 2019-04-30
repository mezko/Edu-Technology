<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\admin;
use Auth;
use Hash;
class AdminController extends Controller
{ 
   
    // public function __construct()
    // {
    //     // $this->middleware('guest')->except('logout');
    //     $this->middleware('guest:admin')->except('logout');
        
    // }
   
    //login function of the admin
    public function login(Request $request){
    if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember')))
    {
         
    return redirect()->intended('admin/home');
    }
    else {
        return back()->withInput($request->only('email', 'remember'));
    }
  
}
    ////register function //////////////////////////////////////////////
    public function Register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    
       
        $admin=new admin();
        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->password=Hash::make($request->password);
        $admin->save();
        return redirect('admin/home');
    }
    /////////////////////////////////////////////////////////////////////////////////////
    //show home page
    public function homepage()
    {
        return view('admin.admin-panel');
    }
}
