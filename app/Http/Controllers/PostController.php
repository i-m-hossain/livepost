<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return ResourceCollection
     */
    public function index()
    {
        $pageSize = $request->page_size ?? 10;
        $posts = Post::query()->paginate($pageSize);
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     * @return PostResource
     */
    public function store(StorePostRequest $request, PostRepository $repository)
    {
        $created = $repository->create($request->only([
            'title',
            'body',
            'user_ids'
        ]));
        return new PostResource($created);
    }

    /**
     * Display the specified resource.
     * @return PostResource
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     * @return PostResource
     */
    public function update(UpdatePostRequest $request, Post $post, PostRepository $repository)
    {
        $post = $repository->update($post, $request->only([
            'title',
            'body',
            'user_ids'
        ]));
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     * @return JsonResponse
     */
    public function destroy(Post $post, PostRepository $repository)
    {
        $deleted = $repository->forceDelete($post);
        return new JsonResponse([
            'data' => "success"
        ]);
    }
}
