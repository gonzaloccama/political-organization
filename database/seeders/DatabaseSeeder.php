<?php

namespace Database\Seeders;

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
         \App\Models\User::factory(200)->create();
//         \App\Models\SystemMenu::factory(1)->create();
//         \App\Models\Post::factory(6548)->create();
//         \App\Models\PostsComment::factory(7563)->create();
//         \App\Models\PostsReaction::factory(8453)->create();
//         \App\Models\Event::factory(25)->create();
//         \App\Models\EventsCategory::factory(20)->create();
//         \App\Models\Role::factory(5)->create();
    }
}
