<?php

use App\Events\Models\Post\PostCreated;
use App\Events\Models\Post\PostDeleted;
use App\Events\Models\Post\PostUpdated;
use \App\Models\Post;

function getPostPayload(array $override = []): array
{
    return array_merge([
        "title" => "test title",
        "body" => [
            "body" => "test body"
        ]
    ], $override);
}

test('it creates a post', function () {
    Event::fake();
    $response = $this->postJson('/api/v1/posts', getPostPayload());
    Event::assertDispatched(PostCreated::class);
    $response->assertCreated();
});

test('it lists posts', function () {
    Post::factory()->count(3)->create();
    $response = $this->getJson('/api/v1/posts');
    dump($response->json('data'));
    $response
        ->assertOk()
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' =>[
                    'id',
                    'title',
                    'body'
                ]
            ]
        ]);

});

test('it shows a post', function () {
    $post = Post::factory()->create();
    $response= $this->getJson("/api/v1/posts/{$post->id}");
    $response
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'body'
            ]
        ]);
});

test('it updates a post', function () {
    Event::fake();
    $post = Post::factory()->create();
    $response= $this->patchJson("/api/v1/posts/{$post->id}", getPostPayload([
        "title" => "updated test title",
        "body" => []
    ]));
    Event::assertDispatched(PostUpdated::class);
    $response->assertOk();
});


test('it deletes a post', function () {
    Event::fake();
    $post = Post::factory()->create();
    $response = $this->deleteJson("/api/v1/posts/{$post->id}");
    Event::assertDispatched(PostDeleted::class);
    $response->assertOk();
});


test('post title is required', function ()
{
    $response = $this->postJson('/api/v1/posts', []);
    $response->assertUnprocessable();
});

test('show returns 404 when post not found', function ()
{
    $response = $this->getJson('/api/v1/posts/999');
    $response->assertNotFound();
});





