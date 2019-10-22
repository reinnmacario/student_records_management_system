<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(EventTableSeeder::class);
        $this->call(StudentTableSeeder::class);
        $this->call(SpeakerTableSeeder::class);
        $this->call(CollegesTableSeeder::class);
        $this->call(CollegeCoursesTableSeeder::class);
    }
}
