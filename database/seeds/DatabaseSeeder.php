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
        // $this->call(UsersTableSeeder::class);

        factory(App\User::class, 20)->create();
        factory(App\Activity::class, 20)->create();
        factory(App\Schedules::class, 25)->create();
        factory(App\Achievement::class, 12)->create();
    }
}
