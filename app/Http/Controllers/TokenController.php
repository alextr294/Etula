<?php

namespace Étula\Http\Controllers;

use Illuminate\Http\Request;
use Étula\LessonToken;
use Étula\Lesson;

class TokenController extends Controller
{
    /**
     * Create new Controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // TODO: Determine if admins and students need to do something with tokens, if they do we need policies.
        // middleware = for all class, policy = can differ for some actions
        $this->middleware(['auth', 'teacher']);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create($id){
        $this->authorize('create', $id);

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

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($id){
        $lt = LessonToken::where('lesson_id', $id)->first();
        $this->authorize('delete', $lt);
        $lt->delete();
        return redirect()->route('home');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function accept(Request $request){
        $this->authorize('accept');

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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function acceptByTeacher(Request $request){
        $this->authorize('acceptByTeacher');

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
