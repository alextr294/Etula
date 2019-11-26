<?php

namespace Tests\Feature;

use http\Exception;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Étula\Lesson;
use Étula\LessonToken;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LessonAndTokenTest extends TestCase
{

    use RefreshDatabase;

    public function test_create_lesson()
    {

        $this->actingAs($this->createUser("teacher"));

        $this->get(url('lessons'))->assertSuccessful();
        $this->post(url('lessons'), $this->getLesson())->assertStatus(302); // found

        $this->assertEquals(1, Lesson::count());
    }

    public function test_create_lesson_with_bad_date()
    {
        $this->actingAs($this->createUser("teacher"));

        $lesson = $this->getLesson();
        $lesson['begin_at_time'] = "delamerde";
        $lesson['end_at_time'] = "encoredelamerde";

        $this->expectException(ValidationException::class);
        $this->post(url('lessons'), $lesson);

        $this->assertEquals(0, Lesson::count());
    }

    public function test_token_is_not_present_in_LessonToken_when_lesson_created()
    {
        $this->actingAs($this->createUser("teacher"));

        $this->post(url('lessons'), $this->getLesson());

        $this->assertEquals(1, Lesson::count());
        $this->assertEquals(0, LessonToken::count());
    }

    public function test_token_is_present_in_LessonToken_when_Lesson_activated()
    {
        $this->actingAs($this->createUser("teacher"));

        $lesson = $this->getLesson();

        $this->post(url('lessons'), $lesson);

        $this->assertEquals(1, Lesson::count());
        $lesson = DB::table('lessons')->get()->first();
        $this->get(route('code', ["id" => $lesson->id]), ['_token' => csrf_token()]);

        $this->assertEquals(1, LessonToken::count());
        $this->assertEquals($lesson->id, LessonToken::get()->first()->lesson->id);
    }

    public function test_add_coachs_to_an_existing_lesson()
    {
        // On cree d'abord un teacher qui va creer une lesson
        $this->actingAs($this->createUser("teacher"));
        $this->post(url('lessons'), $this->getLesson());
        $lesson = Lesson::all()->first();

        // On ajoute ensuite des encadrants a cette lesson
        $e1 = $this->createUser("teacher");
        $e2 = $this->createUser("teacher");

        $this->post(route('teacher_add'), [
            "_token" => csrf_token(),
            "list" . $e1->id => $e1->id,
            "list" . $e2->id => $e2->id,
            "lesson_id" => $lesson->id
        ])->assertStatus(302);

        $this->assertEquals(2, count($lesson->teachers));

    }

    public function test_add_coachs_to_non_existing_lesson()
    {
        // On cree d'abord un teacher qui va creer une lesson
        $this->actingAs($this->createUser("teacher"));

        // On ajoute ensuite des encadrants a cette lesson
        $e1 = $this->createUser("teacher");
        $e2 = $this->createUser("teacher");


        // ne doit PAS donner d'exception, on est cense gerer le cas ou la lesson
        // n'existe pas
        $this->post(route('teacher_add'), [
            "_token" => csrf_token(),
            "list" . $e1->id => $e1->id,
            "list" . $e2->id => $e2->id,
            "lesson_id" => 1
        ]);

        $this->assertEquals(0, DB::table('lesson_teacher')->count());

    }

    public function test_teacher_add_coachs_to_a_lesson_that_he_doesnt_own()
    {

        // On cree d'abord une lesson avec un enseignant
        $this->actingAs($this->createUser("teacher"));
        $this->post(url('lessons'), $this->getLesson());
        $lesson = Lesson::all()->first();

        // Puis on se connecte en tant qu'un autre
        $this->actingAs($this->createUser("teacher"));

        // On ajoute ensuite des encadrants a cette lesson
        $e1 = $this->createUser("teacher");
        $e2 = $this->createUser("teacher");

        $toAdd = [
            "_token" => csrf_token(),
            "list" . $e1->id => $e1->id,
            "list" . $e2->id => $e2->id,
            "lesson_id" => $lesson->id
        ];

        $this->post(route('teacher_add'), $toAdd);

        $this->assertEquals(0, count($lesson->teachers));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function student_cant_create_lesson()
    {
        $this->actingAs($this->createUser("student"));

        $this->expectException(HttpException::class);

        $this->get(url('lessons'))->getStatusCode();
        $response = $this->post(url('lessons'), $this->getLesson());
    }

    public function test_admin_cant_create_lesson()
    {
        $this->startSession();
        $this->actingAs($this->createUser("admin"));

        $this->expectException(HttpException::class);
        $response = $this->post('lesson_create', $this->getLesson());
    }

}
