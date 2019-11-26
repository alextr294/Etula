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
        $this->actingAs($this->createUser("student"));

        $this->get("/login")->assertStatus(302);

    }

    public function test_teacher_redirect_to_teacher_view()
    {
        $this->actingAs($user = $this->createUser("teacher"));
        $this->get("/login")->assertStatus(302);
    }

    public function test_admin_redirect_to_admin_view()
    {
        $this->actingAs($user = $this->createUser("admin"));
        $this->get("/login")->assertStatus(302);
    }
}
