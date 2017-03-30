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
        $this->call(RoleTableSeeder::class);

        $this->call(SchoolsTableSeeder::class);

        $this->call(SchoolYearTableSeeder::class);

        $this->call(EmployeesTableSeeder::class);

        $this->call(LevelsTableSeeder::class);

        $this->call(SectionsTableSeeder::class);

        $this->call(FeesTableSeeder::class);

        $this->call(SchedulesTableSeeder::class);
        
        $this->call(UsersTableSeeder::class);
    }
}
