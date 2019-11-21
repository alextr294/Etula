<?php
namespace Tests\Feature;

use App\Group;
use App\Lesson;
use App\LessonToken;
use App\TeachingUnit;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LessonAndTokenTest extends TestCase
{

    use RefreshDatabase;

    public function getLesson() {
        $groupe = factory(Group::class)->create();

        $us = factory(TeachingUnit::class)->create(["group_id" => $groupe->id]);

        return [
            "_token" => csrf_token(),
            "name" => "name",
            "type" => "CM",
            "begin_at" => "2019-10-20 10:00:00",
            "end_at" => "2019-10-20 12:00:00",
            "unit" => $us->id
        ];

    }

    public function test_create_lesson() {

        $this->actingAs($this->createUser("teacher"));

        $this->get(url('lessons'))->assertSuccessful();
        $this->post(url('lessons'), $this->getLesson())->assertStatus(302); // found

        $this->assertEquals(1, Lesson::count());
    }

    public function test_create_lesson_with_bad_date() {
        $this->actingAs($this->createUser("teacher"));

        $lesson = $this->getLesson();
        $lesson['begin_at'] = "delamerde";
        $lesson['end_at'] = "encoredelamerde";

        $this->post(url('lessons'), $lesson);

        $this->assertEquals(0, Lesson::count());
    }

    public function test_token_is_not_present_in_LessonToken_when_lesson_created() {
        $this->actingAs($this->createUser("teacher"));

        $this->post(url('lessons'), $this->getLesson());

        $this->assertEquals(1, Lesson::count());
        $this->assertEquals(0, LessonToken::count());
    }

    public function test_token_is_present_in_LessonToken_when_Lesson_activated() {
        $this->actingAs($this->createUser("teacher"));

        $lesson = $this->getLesson();

        $this->post(url('lessons'), $lesson);

        $this->assertEquals(1, Lesson::count());
        $lesson = DB::table('lessons')->get()->first();
        $this->post(url('token_create', ["id" => $lesson->id]),['_token' => csrf_token()]);

        $this->assertEquals(1, LessonToken::count());
        $this->assertEquals($lesson->id, LessonToken::get()->first()->lesson->id);
    }

    public function test_add_coach_to_an_existing_lesson() {
        // On cree d'abord un teacher qui va creer une lesson
        $this->actingAs($this->createUser("teacher"));
        $lesson = $this->getLesson();
        $this->post(url('lessons'), $lesson);

        // On ajoute ensuite des encadrants a cette lesson
        $e1 = $this->createUser("teacher");
        $e2 = $this->createUser("teacher");

        $this->post(url('teachers_add'));
    }

    public function test_add_coach_to_non_existing_lesson() {
        // not implemented
    }

    /**
    * A basic test example.
    *
    * @return void
    */
    public function test_student_cant_create_lesson()
    {
        $this->actingAs($this->createUser("student"));

        $this->get(url('lessons'))->assertStatus(401); // forbidden
        $response = $this->post(url('lessons'), $this->getLesson());

        $response->assertStatus(401);
    }

    public function test_admin_cant_create_lesson() {
        $this->actingAs($this->createUser("admin"));

        $this->get(url('lessons'))->assertStatus(401);

        $response = $this->post('lesson_create', $this->getLesson());
        $response->assertStatus(401);
    }

    public function test_admin_cant_activate_lesson() {
        $this->actingAs($this->createUser("teacher"));

        $this->post(url('lessons'), $this->getLesson());
        $this->startSession();

        $this->actingAs($this->createUser("admin"));

        $lesson = DB::table('lessons')->get()->first();
        $this->post(url('token_create', ["id" => $lesson->id]),['_token' => csrf_token()])->assertStatus(401);

        $this->assertEquals(0, LessonToken::count());

    }

    public function test_student_cant_activate_lesson() {
        $this->actingAs($this->createUser("teacher"));

        $this->post(url('lessons'), $this->getLesson());
        $this->startSession();

        $this->actingAs($this->createUser("student"));

        $lesson = DB::table('lessons')->get()->first();
        $this->post(url('token_create', ["id" => $lesson->id]),['_token' => csrf_token()])->assertStatus(401);

        $this->assertEquals(0, LessonToken::count());
    }

    public function test_a_teacher_cant_activate_other_teachers_lesson_than_his() {
        $user_good = $this->createUser("teacher");
        $user_bad = $this->createUser("teacher");

        $this->actingAs($user_good);

        $this->post(url('lessons'), $this->getLesson());
        $this->startSession();

        $this->actingAs($user_bad);

        $lesson = DB::table('lessons')->get()->first();
        $this->post(url('token_create', ["id" => $lesson->id]),['_token' => csrf_token()])->assertStatus(401);

        $this->assertEquals(0, LessonToken::count());
    }



}
