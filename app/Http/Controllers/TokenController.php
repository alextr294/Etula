<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\LessonToken;
use App\Lesson;
use App\LessonTeacher;

class TokenController extends Controller
{
    public function create($id){
        $token = new LessonToken;
        $token->lesson_id = $id;

        //$characts = 'abcdefghijklmnopqrstuvwxyz';
        //$characts .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characts = '1234567890';
        $code_aleatoire = '';

        for($i=0;$i < 6;$i++)
        {
            $code_aleatoire .= $characts[ rand() % strlen($characts) ];
        }

        $token->token = $code_aleatoire;
        $token->longitude = 0;
        $token->latitude = 0;

        $token->save();

        return view('code', compact('token'));
    }

    public function delete($id){
        LessonToken::where('lesson_id',$id)->delete();
        return redirect()->route('home');
    }

    public function accept(Request $request){
        $request->validate([
            'token' => 'required|numeric|digits:6'
        ]);
        $token = $request->input('token');
        $lessonToken = LessonToken::where('token', $token)->first();

        if($lessonToken != null) {
            $lesson = Lesson::where('id', $lessonToken->lesson_id)->first();
            $student_id = $request->user()->id;

            if(!$lesson->presentStudents->contains($student_id)) {
                $request->session()->flash('success', 'Vous venez de valider votre présence !');
                $lesson->presentStudents()->attach($student_id);
            }
            else{
                $request->session()->flash('warning', 'Vous avez déjà validé votre présence !');
            }
        }
        else {
            $request->session()->flash('danger', 'Mauvais code !');
        }

        return redirect()->route('home');
    }

    public function acceptByTeacher(Request $request){
        $lesson = Lesson::where('id', $request->input('lesson_id'))->first();
        $lesson->presentStudents()->detach();
        foreach($_POST as $key=>$valeur){
            if( strstr($key, "student")){
                $student_id = preg_replace('~\D~', '', $key);
                if(!$lesson->presentStudents->contains($student_id)) {
                    $lesson->presentStudents()->attach($student_id);
                }
            }
        }
        return redirect()->route('home');
    }
}
