<?php

namespace App\Http\Controllers;

use App\TeachingUnit;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class TeachingUnitController extends Controller
{
    /*
     * This is Teaching Unit Controller.
     * ================================
     */

    /**
     * Create new Controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*
         * Default condition test: user must log in.
         */
        $this->middleware('auth');
    }

    /**
     * GET(/courses)
     *
     * @return mixed
     */
    public function index() {
        $courses = TeachingUnit::all();

        if ($courses == null) {
            return new JsonResponse(array('message'=>'404 not found'),404);
        } else {
            return new JsonResponse((array)$courses,200);
        }
    }

    /**
     * GET(/courses/{idCourse})
     *
     * @param $idCourse
     * @return mixed
     */
    public function show($idCourse) {
        $course = DB::table('teaching_units')->find($idCourse);

        if ($course == null) {
            return new JsonResponse(array('message'=>'404 not found'),404);
        } else {
            return new JsonResponse((array)$course,200);
        }
    }

    /**
     * Request an input form.
     * GET(/courses/create)
     *
     */
    public function create() {
        return view('course.input_form');
    }

    /**
     * POST(/courses)
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:255'
        ]);
        TeachingUnit::create($validatedData);
    }

}