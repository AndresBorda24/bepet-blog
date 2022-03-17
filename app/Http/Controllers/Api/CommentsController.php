<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use PhpParser\Node\Stmt\Return_;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        $this->authorize('view', $post);

        $comments = Comment::where('post_id', $post->id)->get();

        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post, Request $request)
    {
        $request->validate(['body' => ['required', 'min:5', 'max:255']]);

        $comment = Comment::create([
            'body' => $request->body,
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ]);

        return (new CommentResource($comment))->additional(['message' => 'Created Successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate(['body' => ['required', 'min:5', 'max:255']]);
        $comment->update(['body' => $request->body]);

        return (new CommentResource($comment))->additional(['message' => 'Edit Success!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return response()->json([
            'message' => 'Deleted successfully!'
        ]);
    }
}
