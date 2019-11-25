<?php

namespace Étula\Policies;

use Étula\Lesson;
use Étula\User;
use Étula\LessonToken;
use Illuminate\Auth\Access\HandlesAuthorization;

class TokenPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create lessonTokens.
     *
     * @param \Étula\User $user
     * @param Lesson $lesson
     * @return mixed
     */
    public function create(User $user, Lesson $lesson)
    {
        return $user->isTeacher() && ($lesson->teacher_id == $user->id || $lesson->teachers->contains($user->id));
    }

    /**
     * Determine whether the user can delete the lessonToken.
     *
     * @param  \Étula\User  $user
     * @param  \Étula\LessonToken  $lessonToken
     * @return mixed
     */
    public function delete(User $user, LessonToken $lessonToken)
    {
        $lesson = $lessonToken->lesson;
        return $user->isTeacher() && ($lesson->teacher_id == $user->id || $lesson->teachers->contains($user->id));
    }

    /**
     * @param User $user
     * @return bool
     */
    public function accept(User $user) {
        return $user->isStudent();
    }

    /**
     * @param User $user
     * @return bool
     */
    public function acceptByTeacher(User $user) {
        return $user->isTeacher();
    }
}
