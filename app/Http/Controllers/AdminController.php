<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\admin;
use App\unit;
use Auth;
use Hash;
use DB;
use App\Events\addunit;

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
        $units=DB::table('units')->get()->count();
      
        return view('admin.home')->with('units',$units);
    }
    /************end home page */
    /////////////////////////////////////////////////////////////////////////////////////
    /*units*//////////////////////
    /*units*////////////////////////////\
    /************************************************ */
    //show units
    public function unitpage()
    {  
        $units=DB::table('units')->get();
        return view('admin.unit')->with('units',$units);
    }
    //add unit
    public function addunit(Request $request)
    {
        $unit =new unit();
       $unit->name=$request->name;
       $unit->Admin_id=Auth::guard('admin')->user()->id;
       event(new addunit('.$request->id.',$request->name));
       $unit->save();
       return back()->with('success-message', 'Unit Added');
    }
    //Remove Unit
    public function RemoveUnit($id)
    {
        // dd(admin::where('id',$id)->delete());
      unit::where('id',$id)->delete();
      return back()->with('delete-message', 'Unit Removed');
    }
    //show edit page
    public function showeditpage(Request $request , $id)
    {
        $unit =DB::table('units')->where('id',$id)->first();
        return view('admin.Edit-unit')->with('unit',$unit);
    }
    //edit unit
    public function editunit($id,Request $request)
    {
        
        $unit =DB::table('units')->where('id',$id)->update(['name' => $request->name]);
     
        return back()->with('success-message', 'Unit Edited');
    }
  /////////////////////////////////////////////////////////////end all Thing in unit /////////////////
  ///////////////////////////////////////////////////////////////////////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////Lessons///////////////////////////////////////////////////
    /*Lessons*//////////////////////
    /*lessons*////////////////////////////\
    /************************************************ */
    //show lessons
    public function show_lesson_page()
    {
        $units=DB::table('units')->get();
        return view('admin.add-lesson')->with('units',$units);
    }
}
