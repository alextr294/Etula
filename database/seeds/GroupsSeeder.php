<?php

use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            [
                'id' => 1,
                'name' => "M1Info"
            ]
        ]);
        DB::table('group_student')->insert([
            [
                'group_id' => 1,
                'student_id' => 1
            ],
            [
                'group_id' => 1,
                'student_id' => 2
            ]
        ]);
    }
}
