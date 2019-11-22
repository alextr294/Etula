<?php

namespace Tests\Feature;

use App\Lesson;
use App\LessonToken;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

        // TODO erreur generer par un id pour une lesson qui n'existe pas
        // donc faire le necessaire dans controller pour gerer ce cas
        $this->get(route("code", 1))->assertStatus(404); // pas forcement 404

        $this->assertEquals(0, count(LessonToken::get()));
    }

    public function test_create_token_with_teacher_that_doesnt_own_the_lesson()
    {
        // On cree d'abord une lesson avec un enseignant
        $this->actingAs($this->createUser("teacher"));
        $this->post(url('lessons'), $this->getLesson());
        $lesson = Lesson::get()->first();

        // Puis on se connecte en tant qu'un autre
        $this->actingAs($this->createUser("teacher"));
        $this->get(route("code", $lesson->id))->assertStatus(403);

        $this->assertEquals(0, count(LessonToken::get()));
    }
}
