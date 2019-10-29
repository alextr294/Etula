<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Lesson;
use App\Student;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

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
     * @param Request $request
     * @param $token
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $token = null)
    {
        $user_type = Auth::user()->type;
        if($user_type=="student"){

            $lessons = Auth::user()->studentAccess->presentLessons;

            return view('student', compact(["lessons", "token"]));
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
