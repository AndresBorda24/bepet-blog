<?php

namespace App\Http\Controllers\Api;

use App\Events\PostCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostContoller extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->safe()->merge([
            'status' => 'BORRADOR', 
            'user_id' => auth()->id(),
        ])->toArray();

        $post = Post::create($validated);
        $post->tags()->sync(isset($validated['tags']) ? $validated['tags'] : []);
        $path = $request->file('cover')->store('postCovers', 'public');

        event(new PostCreated($post, $path));

        return new PostResource($post->load(['category', 'tags']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);
     
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validated();
        $post->update($validated);
        $post->tags()->sync(isset($validated['tags']) ? $validated['tags'] : []);

        if($request->file('cover')){
            $path = $request->file('cover')->store('postCovers', 'public');
            \Illuminate\Support\Facades\Storage::disk('public')->delete($post->cover->link);
            $post->cover()->update(['link' => $path]);
        }

        return new PostResource($post->load(['tags', 'category', 'cover']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return response()->json([
            'message' => 'Post deleted succesfully'
        ]);
    }
}
