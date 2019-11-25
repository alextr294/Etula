<?php

namespace Étula\Http\Controllers;

use Étula\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // TODO: Determine if teachers and students need to see all Users, if they do we need policies.
        // middleware = for all class, policy = can differ for some actions
        // TODO: add missing actions (see LessonController)
        $this->middleware(['auth', 'admin']);
    }

    /**
     * GET(/users)
     *
     * @return mixed
     */
    public function index() {
        $users = User::all();
        $usersByType = array('admin'=>[],'teacher'=>[],'student'=>[]);
        foreach ($users as $user) {
            array_push($usersByType[$user->type],$user);
        }

        if ($usersByType == []) {
            return new JsonResponse(array('no user found'),404);
        } else {
            //return new JsonResponse((array)$selectedUsers,200);
            return view('auth.user_manager',['allUsers' => $usersByType]);
        }
    }

    /**
     * GET(/users/{id})
     *
     * @param $id
     * @return mixed
     */
    public function show($id) {
        $user = User::find($id);

        if ($user == null) {
            return new JsonResponse(array('user not found'),404);
        } else {
            // TODO: view user profile
            return new JsonResponse((array)$user,200);
        }
    }

    /**
     * Request an input form.
     *
     * GET(/users/create)
     *
     * @return mixed
     */
    public function create() {
        // TODO: Admin Policy
        return view('auth.user_add');
    }

    /**
     * POST(/users)
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request) {
        // TODO: Admin Policy
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'type' => 'required'
        ]);

        // can't create directly because we need to crypt the password
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'type' => $request['type']
        ]);

        switch($user->type) {
            case "student":
                $user->studentAccess()->create(['user_id' => $user->id]);
                break;
            case "admin:":
                $user->adminAccess()->create(['user_id' => $user->id]);
                break;
            case "teacher":
                $user->teacherAccess()->create(['user_id' => $user->id]);
                break;
        }

        return redirect()->route('users.index');
    }
}