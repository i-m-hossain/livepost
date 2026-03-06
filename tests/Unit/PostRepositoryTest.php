<?php

use App\Repositories\PostRepository;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(
    RefreshDatabase::class,
    TestCase::class
);


function payload(array $override = []): array
{
    return array_merge([
        "title" => "test title",
        "body" => []
    ], $override);
}

test('post can be created', function () {
    $repository = app(PostRepository::class);
    $post = $repository->create(payload());
    expect($post->title)->toBe("test title", "post can't be created");
    $this->assertDatabaseHas("posts", [
        "title" => "test title",
    ]);
});

test('post can be updated', function () {
    $repository = app(PostRepository::class);
    $result = Post::factory()->create();
    $updatedPost = $repository->update($result, payload([
        'title' => "updated test title"
    ]));
    expect($updatedPost->title)->toBe("updated test title", "post can't be updated");
    $this->assertDatabaseHas('posts', [
        'title' => 'updated test title'
    ]);
} );

test('post can be deleted', function () {
    $repository = app(PostRepository::class);
    $post = Post::factory()->create();
    $deleted = $repository->forceDelete($post);
    expect($deleted)->toBeTrue("Post can't be deleted");
    $this->assertDatabaseMissing('posts', [
        'id' => $post->id
    ]);
});
