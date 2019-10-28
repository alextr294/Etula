<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Lesson;
use App\Student;
use Illuminate\Support\Facades\Auth;

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
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $user_type = Auth::user()->type;
        if($user_type=="student"){
            $lessons = Auth::user()->studentAccess->presentLessons;
            //var_dump(Auth::user()->id);
            //return view('student', compact("lessons"));
            return view('student');
        }
        elseif($user_type=="teacher"){
            $lessons = Lesson::where('teacher_id', Auth::user()->id)->get();
            return view('teacher',compact("lessons"));
        }
        elseif($user_type=="admin"){
            return view('admin');
        }
        else{
            return view('home');
        }
    }
}
