<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // création de 5 users aléatoires en db
        $this->users = factory(App\User::class, 5)->create();
    }
}
