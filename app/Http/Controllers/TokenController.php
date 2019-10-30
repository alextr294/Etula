<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\LessonToken;
use App\Lesson;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
    public function create(Request $request){

        $token = new LessonToken;
        $token->lesson_id = $request->id;

        $characts = 'abcdefghijklmnopqrstuvwxyz';
        $characts .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characts .= '1234567890';
        $code_aleatoire = '';

        for($i=0;$i < 10;$i++)
        {
            $code_aleatoire .= $characts[ rand() % strlen($characts) ];
        }

        $token->token = $code_aleatoire;
        $token->longitude = $request->longitude;
        $token->latitude = $request->latitude;

        $token->save();
        return new JsonResponse(array('success'=>true),200);
    }

    public function accept(Request $request){

        $token = $request->input('token');
        $lessonToken = LessonToken::where('token',$token)->first();

        if($lessonToken !=null){
            $lesson = Lesson::where('id',$lessonToken->lesson_id)->first();
            $student_id = Auth::user()->id;

            if(!$lesson->presentStudents->contains($student_id)) {
                $lesson->presentStudents()->attach($student_id);
            }
        }

        return redirect()->route('home');
    }
}
