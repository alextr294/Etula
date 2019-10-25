<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_student_must_be_redirected_to_the_right_page()
    {
        $user = factory(User::class)->create(["type" => "student"]);

        $response = $this->post('/login', [$user]);
        $response->assertRedirect("/student");
    }

    public function a_teacher_must_be_redirected_to_the_right_page()
    {

    }

    public function a_administrator_must_be_redirected_to_the_right_page()
    {

    }

    public function a_student_cannot_access_a_teacher_or_admin_page()
    {

    }

    public function a_teacher_cannot_access_a_student_or_admin_page()
    {

    }

    public function a_administrator_cannot_access_a_teacher_or_student_page()
    {

    }
}
