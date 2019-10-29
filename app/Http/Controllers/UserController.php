<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*
         * Default condition test: user must log in.
         */
        $this->middleware('admin');
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
            //TODO: view user profile
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
        return view('auth.register');
    }

    /**
     * POST(/users)
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'type' => 'required'
        ]);
        //User::create($validatedData);
        $user = new User();
        $user->password = Hash::make($validatedData['password']);
        $user->email = $validatedData['email'];
        $user->name = $validatedData['name'];
        $user->type = $validatedData['type'];
        $user->save();
        return view('admin');
    }
}