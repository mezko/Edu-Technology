<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\admin;
use App\unit;
use App\lesson;
use App\course;
use App\reply;
use App\answer;
use Auth;
use Hash;
use DB;
use App\Events\addunit;
use App\Events\notif;


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
         if(Auth::guard('admin')->user()->permission==2)
         {
            return redirect()->intended('teacher_panel');
         }
            else{
                return redirect()->intended('admin/home');
            }
    
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
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////course page///////////////////////////////////////////////////
///////////////////show course page
public function courses_page()
{
    $courses=DB::table('courses')->get();
    return view('admin.add-courses')->with('courses',$courses);
}
//////add course
public function addcourse(Request $request)
{
    $course=new course();
    $course->C_name=$request->name;
    $course->catogary=$request->catogary;
    /////file
    $path=public_path("uploads/courses");
    $pic=$request->file('pic');
    $picname=time().$pic->getClientOriginalName();
    //upload
    $pic->move($path,$picname);
    $course->pic=$picname;
    //save to DB
    $course->save();
    return back()->with('success-message', 'Unit Added');
}

    
    /////////////////////////////////////////////////////////////////////////////////////
    /*units*//////////////////////
    /*units*////////////////////////////\
    /************************************************ */
    //show units
    public function unitpage()
    {  ///add courses to form
        $courses=DB::table('courses')->get();
        //////for tabe in page 
        $units=DB::table('units')->get();
        return view('admin.unit')->with('units',$units)->with('courses',$courses);
    }
    //add unit
    public function addunit(Request $request)
    {
        $unit =new unit();
       $unit->U_name=$request->name;
       $unit->Admin_id=Auth::guard('admin')->user()->id;
       $unit->course_id=$request->course_id;
    //    event(new addunit('.$request->id.',$request->name));
    //    dd($request);
       $unit->save();
       return back()->with('success-message', 'Unit Added');
    }
    //Remove Unit
    public function RemoveUnit($id)
    {
        // dd(admin::where('id',$id)->delete());
      unit::where('UN_id',$id)->delete();
      return back()->with('delete-message', 'Unit Removed');
    }
    //show edit page
    public function showeditpage(Request $request , $id)
    {
        $unit =DB::table('units')->where('UN_id',$id)->first();
        return view('admin.Edit-unit')->with('unit',$unit);
    }
    //edit unit
    public function editunit($id,Request $request)
    {
        
        $unit =DB::table('units')->where('UN_id',$id)->update(['U_name' => $request->name]);
     
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
        $allunit=DB::table('units')->get();
        $units=DB::table('units')->join('lessons','lessons.unit_id','units.UN_id')->get();
        // dd($units);
        return view('admin.add-lesson')->with('units',$units)->with('allunit',$allunit);
    }
    //add lesson
    public function add_lessons(Request $request)
    {
        $lesson=new lesson();
        $lesson->L_name=$request->name;
        $lesson->video=$request->video;
        $lesson->unit_id=$request->unit_id;
        /////file
        $path=public_path("uploads");
        $pic=$request->file('pic');
        $picname=time().$pic->getClientOriginalName();
        //upload
        $pic->move($path,$picname);
        $lesson->pic=$picname;
        //save to DB
        $lesson->save();
        return back()->with('success-message', 'Unit Added');
    }
    ///////remove lesson
    public function remove_lesson($id)
    {
        lesson::where('L_id',$id)->delete();
        return back()->with('delete-message', 'Lesson Removed');

       }
       //show edit lesson page
       public function edit_lesson_page($id)
       {
        $allunit=DB::table('units')->get();
        $units=DB::table('lessons')->join('units','lessons.unit_id','units.UN_id')->where('lessons.L_id',$id)->get();
          return view('admin.Edit-lesson')->with('units',$units)->with('allunit',$allunit);
       }
       //edit lesson function
       public function editlesson($id,request $request)
       {
        $lesson=lesson::find($id);
        $lesson->L_name=$request->name;
        $lesson->video=$request->video;
        $lesson->unit_id=$request->unit_id;
        /////file
        $path=public_path("uploads");
        $pic=$request->file('pic');
        $picname=time().$pic->getClientOriginalName();
        //upload
        $pic->move($path,$picname);
        $lesson->pic=$picname;
        //save to DB
        $lesson->save();
        return back()->with('success-message', 'Unit Added');
       }
       /////////////show teacher page
       public function allteachers()
       {
           $teachers=DB::table('admins')->get();
          return view('admin.add-teacher')->with('teachers',$teachers);
       }
       //add teacher
       public function add_teacher(request $request)
       {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    
       
        $teacher=new admin();
        $teacher->name=$request->name;
        $teacher->email=$request->email;
        $teacher->password=Hash::make($request->password);
        $teacher->permission=2;
        $teacher->save();
        return back()->with('success-message', 'Teacher Added');
           
       }
       //delte teacher
       public function delete_teacher($id)
       {
          DB::table('admins')->where('id',$id)->delete();
          return back()->with('delete-message', 'Unit Removed');
       }
       //show edit teacher
       public function show_edit_teacher($id)
       {
        $teachers=DB::table('admins')->where('id',$id)->first();
        return view('admin.Edit-teacher')->with('teachers',$teachers);
       }
       //edit teacher
       public function edit_teacher(request $request ,$id)
       {
          
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    
       
        $teacher=admin::find($id);
        $teacher->name=$request->name;
        $teacher->email=$request->email;
        $teacher->password=Hash::make($request->password);
        $teacher->permission=2;
        $teacher->save();
        return back()->with('success-message', 'Teacher Added');
       }
       /////////////////////////////////////////////////////////////////////////////////
       /////////////////////show teacher admin page 
       public function teacher_page()
       {
           $comments=DB::table('comments')->join('lessons','lessons.L_id','comments.lesson_id')
           ->join('units','units.UN_id','lessons.unit_id')->join('courses','courses.id','units.course_id')
           ->join('users','users.id','comments.user_id')
           ->where('status',0)->get();
        //    dd($comments);
        return view('teacher.comments')->with('comments',$comments);
       }
       /////////////////////replay comment
       ////////////////replay comment page
       public function replypage($id)
       {
        $comments=DB::table('comments')->join('lessons','lessons.L_id','comments.lesson_id')
        ->join('units','units.UN_id','lessons.unit_id')->join('courses','courses.id','units.course_id')
        ->join('users','users.id','comments.user_id')
        ->where('status',0)->where('co_id',$id)->first();
        
           return view('teacher.reply')->with('comments',$comments);
       }
       //////////////reply
       public function reply(Request $request , $id)
       {
        $reply=new reply();
        $reply->text=$request->reply;
        $reply->comment_id=$id;
        $reply->user_id=$request->user_id;
        $reply->save();
        $comment =DB::table('comments')->where('co_id',$id)->update(['status' => '1']);
        event(new notif("Your comment Replaied"));
        return redirect('/teacher_panel')->with('success-message', 'Reply done');
       }
       //////////////////answer page 
       /////////show answer page 
       public function questions_page()
       {
        $questions=DB::table('questions')->join('lessons','lessons.L_id','questions.lesson_id')
           ->join('units','units.UN_id','lessons.unit_id')->join('courses','courses.id','units.course_id')
           ->join('users','users.id','questions.user_id')
           ->where('status',0)->get();
           return view('teacher.answer')->with('questions',$questions);
       }
       /////////////anwer page of question
       public function answerpage($id)
       {
           $questions=DB::table('questions')->join('lessons','lessons.L_id','questions.lesson_id')
        ->join('units','units.UN_id','lessons.unit_id')->join('courses','courses.id','units.course_id')
        ->join('users','users.id','questions.user_id')
        ->where('status',0)->where('Q_id',$id)->first();
        // dd($questions->U_id); 
           
           return view('teacher.questionanswer')->with('questions',$questions);
       }
       //////////answer quetion fun
       public function answerquestion(Request $request , $id)
       {
   
        $answer=new answer();
        $answer->text=$request->answer;
        $answer->question_id=$id;
        $answer->user_id=$request->user_id;
        $answer->save();
        $comment =DB::table('questions')->where('Q_id',$id)->update(['status' => '1']);
        event(new notif("Your Question Answered"));
        return redirect('/questions')->with('success-message', 'Reply done');
           
       }

}
