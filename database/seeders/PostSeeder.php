<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Traits\SkipIfRecordExist;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    use SkipIfRecordExist;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if($this->skipIfRecordExist(Post::class)) {
            return;
        }
        Post::factory()
            ->count(50)
            ->untitled()
            ->create()
            ->each(function (Post $post) {
                $userIds = User::inRandomOrder()
                    ->take(rand(1, 5))
                    ->pluck('id');
                $post->users()->attach($userIds);
            });
    }
}
