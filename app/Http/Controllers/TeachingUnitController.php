<?php

namespace App\Http\Controllers;

use App\Group;
use App\TeachingUnit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeachingUnitController extends Controller
{
    /**
     * Create new Controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // TODO: Determine if teachers and students need to see all TeachingUnits, if they do we need policies.
        // middleware = for all class, policy = can differ for some actions
        // TODO: add missing actions (see LessonController)
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
            // create custom $courseWithMane
            $coursesWithGroup = [];
            foreach ($courses as $course) {
                array_push($coursesWithGroup,array(
                    'id'=>$course->id,
                    'name'=>$course->name,
                    'group_name'=>Group::find($course->group_id)->name
                ));
            }
            return view('course.course_manager',array('courses'=>$coursesWithGroup));
        }
    }

    /**
     * GET(/courses/{idCourse})
     *
     * @param $idCourse
     * @return mixed
     */
    public function show($idCourse) {
        $course = TeachingUnit::find($idCourse);
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
        // TODO: Admin Policy
        $groups = Group::all();
        return view('course.input_form', compact('groups'));
    }

    /**
     * POST(/courses)
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request) {
        // TODO: Admin Policy
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'group_id' => 'required|integer'
        ]);
        TeachingUnit::create($validatedData);
        return redirect()->route('courses.index');
    }

}