<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\User;
use App\TeachingUnit;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\LessonTeacher;

class LessonController extends Controller
{
    /**
    * Create new Controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        // TODO: Determine if admins and students need to see all Lessons, if they do we need policies.
        // middleware = for all class, policy = can differ for some actions
        $this->middleware('auth');
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        // TODO: Teacher Policy
        $units = TeachingUnit::all();
        $types = ['CM', 'TD', 'TP'];
        return view('lesson_create', compact('units', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(Request $request)
    {
        // TODO: Teacher Policy
        $request->validate([
            'name' => 'required|string|max:255',
            'type' =>'required|in:CM,TD,TP',
            'begin_at' =>'required|date|after_or_equal:today', // always in format: yyyy-mm-dd
            'begin_at_time' => 'required|date_format:G:i', // format: hh:mm 24h
            'end_at' =>'required|date|after_or_equal:today|after_or_equal:begin_at', // always in format: yyyy-mm-dd
            'end_at_time' => 'required|date_format:G:i|after:begin_at_time', // format: hh:mm 24h
            'unit' =>'required|exists:teaching_units,id',
        ]);
        // create begin_at & end_at attributes
        $begin_at = new \DateTime($request->begin_at.' '.$request->begin_at_time);
        $end_at = new \DateTime($request->end_at.' '.$request->end_at_time);
        // add new in DB
        Lesson::create([
            'name' => $request->name,
            'type' => $request->type,
            'begin_at' => $begin_at,
            'end_at' => $end_at,
            'unit_id' => $request->unit,
            'teacher_id' => $request->user()->id
        ]);

        return redirect()->route('home');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Lesson  $lesson
    * @return \Illuminate\Http\Response
    */
    public function show(Lesson $lesson){
        $presentStudents_id = $lesson->presentStudents;
        $teachers_id = Teacher::all(); //var_dump($teachers);die();
        $teachers = array();
        foreach($teachers_id as $t) {
            array_push($teachers,User::find($t->user_id));
        }
        $studentsPresents = [];

        foreach ($presentStudents_id as $presentStudent_id) {
            $studentsPresents [] = $presentStudent_id->user_id;
        }

        $students_id = $lesson->unit->group->students;
        $students = array();

        foreach ($students_id as $student_id) {
            $present = false;
            $id = $student_id->user_id;
            if (in_array($id, $studentsPresents)) {
                $present = true;
            }
            $students [] = array(User::where('id', $id)->get(), $present);
        }

        //var_dump($students);

        return view('lesson_details',compact("lesson","students","teachers"));
    }

    public function showLessonsStudent(Request $request){
        $student = $request->user()->studentAccess;
        $AllLessons = Lesson::all();
        $PresentLessons = $student->presentLessons;

        $c=0;
        foreach($AllLessons as $lesson){
            if(strtotime($lesson->begin_at)<strtotime("last Monday") or strtotime($lesson->begin_at)>strtotime("next Sunday")){
                unset($AllLessons[$c]);
            }
            $c++;
        }

        $PresentLessonsId = [];
        foreach ($PresentLessons as $lesson) {
            $PresentLessonsId [] = $lesson->id;
        }

        return view('lesson_student',compact('PresentLessonsId','AllLessons'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Lesson  $lesson
    * @return \Illuminate\Http\Response
    */
    public function edit(Lesson $lesson)
    {
        // TODO: Teacher Policy
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Lesson  $lesson
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Lesson $lesson)
    {
        // TODO: Teacher Policy
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Lesson  $lesson
    * @return \Illuminate\Http\Response
    */
    public function destroy(Lesson $lesson)
    {
        // TODO: Teacher Policy
    }

    public function teacher_add(Request $request){
        $list_name = $request->all();
        array_shift($list_name);
        $lesson_id = array_pop($list_name);
        $lesson = Lesson::find($lesson_id);
        foreach($list_name as $key=>$valeur){
            if(!$lesson->teachers->contains($valeur)) {
                $lesson->teachers()->attach($valeur);
            }
        }
        return redirect()->route('lessons.show',$lesson_id);
    }

}
