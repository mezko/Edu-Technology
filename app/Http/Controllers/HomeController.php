<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\comment;
use App\question;
use App\lesson;
use Illuminate\Database\Eloquent\Builder;
use App\Events\teachernoti;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   $courses=DB::table('courses')->get();
        return view('home')->with('courses',$courses);
    }
    ////////////////////////////////////////////////course page/////////////////////////////////
    //////////////show course page ////////////////
    public function show_course_page($id)
    {
        //for get course 
      $course=DB::table('courses')->where('id',$id)->first();
      //now for get the content of course 
      $content =DB::table('units')
      ->join('lessons','units.UN_id','=','lessons.unit_id')
    //   ->select('units.U_name')
      ->where('course_id',$id)->get();
    //   dd($content);
        return view('student.vidoeplayer')->with('course',$course)
        ->with('content',$content);
    }
    /******************************************************************************************* **********/
    /////////////////course page 
    public function course_video($id)
    { 
        $video=DB::table('lessons')->where('L_id',$id)->first();
        /////video id
        $video_id []=explode('=',$video->video);
        // dd($video_id);
        return view ('student.courspage')->with('videos',$video)->with('video_id',$video_id);
    }
    /////////////////////////////make a comment or ask question
    public function comment_or_question(Request $request,$id)
    { 
        $comment =new comment();
        $question=new question();
        if ($request->com_hid=="Question") {
        $question->question=$request->question;
        $question->user_id=Auth::user()->id;
        $question->lesson_id=$id;
        $question->save();
        event(new teachernoti("You Have new comment"));
        return back()->with('success-message', 'Question sent ,the answer will answer soon');
        } elseif ($request->com_hid=="comment") {
            $comment->comment=$request->comment;
            $comment->user_id=Auth::user()->id;
            $comment->lesson_id=$id;
            $comment->save();
            event(new teachernoti("You Have New Question"));
            return back()->with('success-message', 'Comment sent');
        }
        
    }
    /////////////////search for course
    public function search(request $request)
    {
    // dd($request->text);
     $courses=DB::table('courses')->Where('C_name','like', '%' .$request->text. '%')->get();
     return view('student.search')->with('courses',$courses);
    
    }
    /////////////////show_my_comment
    public function show_my_comment($id)
    {
        $comments=DB::table('comments')->join('answers','comments.co_id','answers.comment_id')
        ->join('lessons','lessons.L_id','comments.lesson_id')
           ->join('units','units.UN_id','lessons.unit_id')->join('courses','courses.id','units.course_id')
        ->where('comments.user_id',Auth::user()->id)->get();
        // dd($comments);
        return view('student.mycomment')->with('comments',$comments);
    }
    ///////////////////////////show_my_question
    public function show_my_question($id)
    {
        $questions=DB::table('questions')->join('answers','questions.Q_id','answers.question_id')
        ->join('lessons','lessons.L_id','questions.lesson_id')
           ->join('units','units.UN_id','lessons.unit_id')->join('courses','courses.id','units.course_id')
        ->where('questions.user_id',Auth::user()->id)->get();
        // dd($comments);
        return view('student.myquestion')->with('questions',$questions);
    }

}
