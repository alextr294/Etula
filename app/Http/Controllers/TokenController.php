<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LessonToken;
use App\Lesson;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
    public function create($id){
        //var_dump($id);

        $token = new LessonToken;
        $token->lesson_id = $id;

        $characts = 'abcdefghijklmnopqrstuvwxyz';
        $characts .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characts .= '1234567890';
        $code_aleatoire = '';

        for($i=0;$i < 10;$i++)
        {
            $code_aleatoire .= $characts[ rand() % strlen($characts) ];
        }

        $token->token = $code_aleatoire;
        $token->longitude = 0;
        $token->latitude= 0;

        $token->save();

        $lessons = Lesson::where('teacher_id', Auth::user()->id)->get();;
        return view('teacher',compact("lessons"));
    }
}
