<?php

namespace Étula\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Étula\LessonToken;
use Étula\Lesson;
use Étula\LessonTeacher;

class TokenController extends Controller
{

    public function create(Request $request, $id) {
        $lesson = Lesson::find($id);
        if (!isset($lesson)) {
            return redirect()->route("home");
        }

        if($request->user()->type != "teacher") {
            abort(403, "Forbidden");
        }

        // TODO a faire aussi pour les encadrants, pas le time
        if ($lesson->teacher_id != $request->user()->id) {
            return redirect()->route("home");
        }

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

        foreach($_POST as $key => $valeur){
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
