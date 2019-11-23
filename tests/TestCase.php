<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Étula\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->withoutExceptionHandling();
        $this->startSession();
    }

    protected function createUser($type) {
        $user = factory(User::class)->create(["type" => $type]);

        switch($type) {
            case "student":
                $user->studentAccess()->create(['user_id' => $user->id]);
                break;
            case "admin:":
                $user->adminAccess()->create(['user_id' => $user->id]);
                break;
            case "teacher":
                $user->teacherAccess()->create(['user_id' => $user->id]);
                break;
        }
        return $user;
    }
}
