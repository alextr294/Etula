<?php


namespace Étula\Http\Controllers;


use Étula\Group;
use Étula\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // TODO: index() Determine student can see groups in which they participate
        // middleware = for all class, policy = can differ for some actions
        $this->middleware(['auth', 'admin']);
    }

    /**
     * GET(/groups)
     *
     * @return mixed - list of all available groups
     */
    public function index() {
        // retrieve raw data from DB
        $rawData = Group::all();
        // return view
        return view('group.group_manager',array('groups'=>$rawData));
    }

    /**
     * GET(/groups/{idCourse})
     *
     * @param $idGroup
     * @return mixed - group view including all student members/ active courses
     */
    public function show($idGroup) {
        // retrieve raw data from DB
        $rawGroup = Group::find($idGroup);
        // error 404 -- no group found
        if ($rawGroup == null) {
            return new JsonResponse(array('message'=>'group not found'),404);
        }
        // group found.
        // 1.get all student members
        $rawMembers = $rawGroup->students()->get();
        $members = array();
        foreach ($rawMembers as $m) {
            $student = User::find($m->user_id);
            if ($student != null) {
                array_push($members,$student);
            }
        }
        // return view
        return view('group.group_detail', array('members' => $members, 'group' => $rawGroup));
    }

    /**
     * Request an input form.
     * GET(/groups/create)
     *
     * @return mixed -
     */
    public function create() {
        // TODO: Admin Policy
        return view('group.input_form');
    }

    /**
     * POST(/groups)
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request) {
        // TODO: Admin Policy
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Group::create($validatedData);
        return redirect()->action('GroupController@index');
    }

    /**
     * DELETE /groups/{idGroup}
     *
     * @param $idGroup
     * @return mixed
     */
    public function destroy($idGroup) {
        // retrieve raw data from DB
        $rawGroup = Group::find($idGroup);
        // error 404 -- no group found
        if ($rawGroup == null) {
            return new JsonResponse(array('message'=>'group not found'),404);
        }
        // group found then delete
        $rawGroup->delete();
        // return 200
        return new JsonResponse(array('message'=>'group deleted'),200);
    }

    /**
     * Add a student as group member input form
     * GET/groups/{idGroup}/students/create
     * @param $idGroup
     * @return mixed
     */
    public function add_student_form($idGroup) {
        // test url parameter
        $rawGroup = Group::find($idGroup);
        if ($rawGroup == null) {
            return new JsonResponse(array('message'=>'group not found'),404);
        }
        // request parameters passed the test, create new group-student relation
        return view('group.add_new_student_form',array('group'=>$rawGroup));
    }

    /**
     * Search students by name.
     * Send notification if student is already group member.
     * GET /groups/{idGroup}/students/search?key=keyword
     *
     * @param Request $request
     * @param $idGroup
     * @return mixed
     */
    public function search_student(Request $request, $idGroup) {
        // test url parameters
        $rawGroup = Group::find($idGroup);
        if ($rawGroup == null) {
            return new JsonResponse(array('message'=>'group not found'),404);
        }
        if ($request->has('key')) {
            $student_name = $request->key;
        } else {
            return new JsonResponse(array('message'=>'request has no parameter',400));
        }
        // search for student having matching name
        $rawStudent = User::where(array(
            ['name','like','%'.$student_name.'%'],
            ['type','student'])
        )->get();
        // print output
        $output = '';
        foreach ($rawStudent as $stu) {
            if ($rawGroup->students()->find($stu->id) == null) {
                $name = '<td>' . $stu->name . '</td>';
                $email = '<td>' . $stu->email . '</td>';
                $option = '<td><button class="btn btn-outline-primary" onclick="add_action(this)" data-value="'.$stu->id.'">Add</button></td>';
                $output = $output . '<tr>' . $name . $email . $option . '</tr>';
            }
        }
        return Response($output);
    }

    /**
     * Add a student as group member.
     * POST /groups/{idGroup}/students.
     * @param Request $request
     * @param $idGroup
     * @return mixed
     */
    public function add_student(Request $request, $idGroup) {
        // test url parameters
        $rawGroup = Group::find($idGroup);
        if ($rawGroup == null) {
            return new JsonResponse(array('message'=>'group not found'),404);
        }
        $idStudent = $request->input('student_id');
        $rawStudent = User::find($idStudent);
        if ($rawStudent == null) {
            return new JsonResponse(array('message'=>'student not found'),404);
        }
        // request parameters passed the test, create new group-student relation
        $rawGroup->students()->attach($rawStudent->id);
        // return 200
        return new JsonResponse(array('message'=>'new student added'),200);
    }

    /**
     * Remove a student from group.
     * DELETE /groups/{idGroupe}/students/{idStudents}.
     * @param $idGroup
     * @param $idStudent
     * @return mixed
     */
    public function remove_student($idGroup, $idStudent) {
        // test url parameters
        $rawGroup = Group::find($idGroup);
        if ($rawGroup == null) {
            return new JsonResponse(array('message'=>'group not found'),404);
        }
        $rawStudent = User::find($idStudent);
        if ($rawStudent == null) {
            return new JsonResponse(array('message'=>'student not found'),404);
        }
        // test passed, delete group-student relation
        $rawGroup->students()->detach($idStudent);
        // return 200
        return new JsonResponse(array('message'=>'student removed'),200);
    }
}