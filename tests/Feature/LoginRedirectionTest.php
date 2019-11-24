<?php

namespace Tests\Feature;

use Étula\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginRedirectionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_student_redirect_to_student_view()
    {
        $user = factory(User::class)->create(["type" => "student"]);

        $this->followingRedirects()->actingAs($user)->get("/login")->assertViewIs("student");

    }

    public function test_teacher_redirect_to_teacher_view()
    {
        $user = factory(User::class)->create(["type" => "teacher"]);

        $this->followingRedirects()->actingAs($user)->get("/login")->assertViewIs("teacher");
    }

    public function test_admin_redirect_to_admin_view()
    {
        $user = factory(User::class)->create(["type" => "admin"]);

        $this->followingRedirects()->actingAs($user)->get("/login")->assertViewIs("admin");
    }
}
