<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory('App\User', 25)->create();

        $user->each(function ($user) {
            factory('App\Comment', 15)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
