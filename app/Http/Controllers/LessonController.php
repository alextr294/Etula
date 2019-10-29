<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use App\TeachingUnit;

class LessonController extends Controller
{
    public function create(){
        $units = TeachingUnit::all();
        return view('lesson_create',compact('units'));
    }


    public function postForm(Request $request){
        $request->validate([
            'name' => 'required',
            'type' =>'required',
            'begin_at' =>'required',
            'end_at' =>'required',
            'unit' =>'required',
        ]);

        $lesson = new Lesson;
        $lesson->name = $request->input('name');
        $lesson->type = $request->input('type');
        $lesson->unit_id = $request->input('unit');
        $lesson->begin_at = $request->input('begin_at');
        $lesson->end_at = $request->input('end_at');
        $lesson->teacher_id = $request->user()->id;
        $lesson->save();

        return redirect()->route('home');
    }

}
