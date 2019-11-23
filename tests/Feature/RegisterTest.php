<?php

namespace Tests\Feature;

use Étula\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_student_not_allowed_to_register()
    {
        $user = factory(User::class)->create(["type" => "student"]);
        $this->actingAs($user)->get("register")->assertStatus(401);
    }

    public function test_teacher_not_allowed_to_register()
    {
        $user = factory(User::class)->create(["type" => "teacher"]);
        $this->actingAs($user)->get("register")->assertStatus(401);
    }
}
