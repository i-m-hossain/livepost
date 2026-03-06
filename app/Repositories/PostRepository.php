<?php


namespace App\Repositories;


use phpDocumentor\Reflection\Types\Boolean;
use App\Events\Models\Post\{PostCreated, PostUpdated, PostDeleted};
use App\Exceptions\GeneralJsonException;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PostRepository extends BaseRepository
{
    public function create(array $attributes): Post
    {
        return DB::transaction(function () use ($attributes) {

            $created = Post::query()->create([
                'title' => data_get($attributes, 'title', 'Untitled'),
                'body' => data_get($attributes, 'body'),
            ]);
           throw_if(!$created, GeneralJsonException::class, 'Failed to create. ');
           event(new PostCreated($created));
            if($userIds = data_get($attributes, 'user_ids')){
                $created->users()->sync($userIds);
            }
            return $created;
        });
    }

    /**
     * @param Post $post
     * @param array $attributes
     * @return mixed
     */
    public function update($post, array $attributes): Post
    {

        return DB::transaction(function () use($post, $attributes) {
            $updated = $post->update([
                'title' => data_get($attributes, 'title', $post->title),
                'body' => data_get($attributes, 'body', $post->body),
            ]);


           throw_if(!$updated, GeneralJsonException::class, 'Failed to update post');
           event(new PostUpdated($post));

            if($userIds = data_get($attributes, 'user_ids')){
                $post->users()->sync($userIds);
            }

            return $post;

        });
    }

    /**
     * @param Post $post
     * @return bool
     */
    public function forceDelete($post):bool
    {
        return DB::transaction(function () use($post) {
            $deleted = $post->forceDelete();

           throw_if(!$deleted, GeneralJsonException::class, "cannot delete post.");

           event(new PostDeleted($post));

            return $deleted;
        });
    }
}
