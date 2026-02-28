<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Repositories\CommentRepository;
use App\Repositories\PostRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResource
     */
    public function index()
    {
        $pageSize = $request->page_size ?? 10;
        $comments = Comment::query()->paginate($pageSize);
        return CommentResource::collection($comments);

    }

    /**
     * Store a newly created resource in storage.
     * @return CommentResource
     */
    public function store(StoreCommentRequest $request, CommentRepository $repository)
    {
        $created =  $repository->create($request->only([
            'body',
            'user_id',
            'post_id'
        ]));
        return new CommentResource($created);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment, CommentRepository $repository)
    {
        $repository->update($comment, $request->only([
            'body',
            'user_id',
            'post_id'
        ]));
        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     * @return JsonResponse
     */
    public function destroy(Comment $comment, CommentRepository $repository)
    {
        $deleted = $repository->forceDelete($comment);
        return new JsonResponse([
            'success' => 'Comment has been deleted.',
        ]);
    }
}
