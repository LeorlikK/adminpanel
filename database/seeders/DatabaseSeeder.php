<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
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
         User::factory(1)->create();
         Category::factory(2)->create();
         $posts = Post::factory(12)->create();
         $tags = Tag::factory(5)->create();

         foreach ($posts as $post) {
             $id = $tags->random(2)->pluck('id');
             $post->tag()->attach($id);
         }

    }
}
