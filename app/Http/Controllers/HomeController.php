<?php

namespace Étula\Http\Controllers;

use Illuminate\Http\Request;
use Étula\Lesson;
use Illuminate\Http\Response;
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
     * @param Request $request
     * @param $token
     * @return Response
     */
    public function index(Request $request, $token = null)
    {
        $user = $request->user;
        if($user->isStudent()) {
            $lessons = Auth::user()->studentAccess->presentLessons;
            return view('student', compact(["lessons", "token"]));
        } else if($user->isTeacher()) {
            $lessons = Lesson::where('teacher_id', Auth::user()->id)->get();
            return view('teacher', compact("lessons"));
        } else if($user->isAdmin()) {
            return view('admin');
        }
        // TODO: 404 or unauthorized header
        return view('home');
    }
}
