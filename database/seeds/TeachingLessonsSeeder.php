<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TeachingLessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teaching_units')->insert([
            [
                'id' => 1,
                'name' => "Réseaux",
                'group_id' => 1
            ]
        ]);
        DB::table('lessons')->insert([
            [
                'id' => 1,
                'name' => "Cours de Réseaux TEST",
                'type' => "CM",
                'teacher_id' => 3,
                'begin_at' => Carbon::create(2019, 12, 2, 10, 0, 0, 'Europe/Paris'),
                'end_at' => Carbon::create(2019, 12, 2, 12, 0, 0, 'Europe/Paris'),
                'unit_id' => 1
            ]
        ]);
        DB::table('lesson_student')->insert([
            [
                'lesson_id' => 1,
                'student_id' => 1
            ],
            [
                'lesson_id' => 1,
                'student_id' => 2
            ]
        ]);
        DB::table('lesson_tokens')->insert([
            [
                'lesson_id' => 1,
                'token' => str_random(10)
            ]
        ]);
    }
}
