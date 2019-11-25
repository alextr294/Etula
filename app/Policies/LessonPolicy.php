<?php

namespace Étula\Policies;

use Étula\User;
use Étula\Lesson;
use Illuminate\Auth\Access\HandlesAuthorization;

class LessonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the lesson.
     *
     * @param  \Étula\User  $user
     * @param  \Étula\Lesson  $lesson
     * @return mixed
     */
    public function view(User $user, Lesson $lesson)
    {
        return $user->isTeacher() && ($lesson->teacher_id == $user->id || $lesson->teachers->contains($user->id));
    }

    /**
     * Determine whether the user can create lessons.
     *
     * @param  \Étula\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isTeacher();
    }

    /**
     * Determine whether the user can update the lesson.
     *
     * @param  \Étula\User  $user
     * @param  \Étula\Lesson  $lesson
     * @return mixed
     */
    public function update(User $user, Lesson $lesson)
    {
        return $user->isTeacher() && $lesson->teacher_id == $user->id;
    }

    /**
     * Determine whether the user can delete the lesson.
     *
     * @param  \Étula\User  $user
     * @param  \Étula\Lesson  $lesson
     * @return mixed
     */
    public function delete(User $user, Lesson $lesson)
    {
        return $user->isTeacher() && $lesson->teacher_id == $user->id;
    }

    public function showStudentPlanning(User $user)
    {
        return $user->isStudent();
    }

    public function showAdminPlanning(User $user)
    {
        return $user->isAdmin();
    }
}
