<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;
use Étula\Lesson;
use Étula\LessonToken;

class LessonTokenTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_token()
    {
        $this->actingAs($this->createUser("teacher"));
        $this->post(url('lessons'), $this->getLesson());
        $lesson = Lesson::get()->first();

        $this->get(route("code", $lesson->id))->assertSuccessful()->assertViewIs("code");

        $this->assertEquals(1, count(LessonToken::get()));
    }

    public function test_create_token_with_non_existing_lesson()
    {
        $this->actingAs($this->createUser("teacher"));

        // erreur generer un code pour une id de lesson qui n'existe pas
        $this->get(route("code", ["id" => 1]));

        $this->assertEquals(0, count(LessonToken::all()));
    }

    public function admin_cant_activate_lesson()
    {
        $this->actingAs($this->createUser("teacher"));
        $this->post(url('lessons'), $this->getLesson());

        $this->actingAs($this->createUser("admin"));

        $lesson = Lesson::all()->first();

        $this->expectException(HttpException::class);
        $this->get(route('code', ["id" => $lesson->id]));

        $this->assertEquals(0, LessonToken::count());

    }

    public function student_cant_activate_lesson()
    {
        $this->actingAs($this->createUser("teacher"));
        $this->post(url('lessons'), $this->getLesson());

        $this->actingAs($this->createUser("student"));

        $lesson = Lesson::all()->first();

        $this->expectException(HttpException::class);
        $this->get(route('code', ["id" => $lesson->id]));

        $this->assertEquals(0, LessonToken::count());
    }

    public function test_a_teacher_cant_activate_other_teachers_lesson_than_his()
    {
        $user_good = $this->createUser("teacher");
        $user_bad = $this->createUser("teacher");

        $this->actingAs($user_good);
        $this->post(url('lessons'), $this->getLesson());

        $this->startSession();
        $this->actingAs($user_bad);

        $lesson = Lesson::all()->first();
        $this->get(route('code', ["id" => $lesson->id]));
        $this->assertEquals(0, LessonToken::count());
    }
}
