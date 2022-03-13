<?php

namespace App\Http\Controllers\Common;

use App\Events\PostCreated;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Models\Category::all();
        $tags = \App\Models\Tag::all();

        return view('post.create', compact('categories', 'tags'));
    }

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

        return redirect()->back()->with('success', 'Blog guardado en borradores, ve y publicalo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);
        
        $post->load([
            'author',
        ]);

        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $categories = \App\Models\Category::all();
        $tags = \App\Models\Tag::all();

        $postTags = [];

        foreach ($post->tags as $tag) {
            $postTags[] = $tag->id;
        }

        return view('post.edit', compact('post', 'categories', 'tags', 'postTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->safe()->merge(['slug' => \Illuminate\Support\Str::slug($request['title'])])->toArray();
        $post->update($validated);
        $post->tags()->sync(isset($validated['tags']) ? $validated['tags'] : []);

        if($request->file('cover')){
            $path = $request->file('cover')->store('postCovers', 'public');
            \Illuminate\Support\Facades\Storage::disk('public')->delete($post->cover->link);
            $post->cover()->update(['link' => $path]);
        }

        return redirect()->route('dashboard.post.edit', $post)->with('success', 'Blog actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        \Illuminate\Support\Facades\Storage::disk('public')->delete($post->cover->link);
        $post->delete();

        return redirect()->back()->with('success', 'Blog ELIMINADO correctamente');
    }


    public function postIt(Post $post)
    {
        $this->authorize('update', $post);

        $post->update([
            'status' => 'PUBLICADO',
            'posted_at' => now(),
        ]);

        return redirect()->route('dashboard.post.drafts')->with('success', 'Blog publicado correctamente');
    }

    public function drafts()
    {
        $posts = \App\Models\Post::where([
            ['user_id', auth()->id()],
            ['status', '=', 'BORRADOR']
            ])
            ->select(['title', 'slug', 'id'])
            ->paginate(10);

        return view('post.drafts', compact('posts'));
    }

    public function searchByInput($search)
    {
        $posts = \App\Models\Post::limit(15)
            ->published()
            ->where('title', 'LIKE', "%$search%")
            ->with(['author', 'tags', 'cover'])
            ->withCount('comments')
            ->paginate(10);

        $searchBy = $search;

        return view('post.search', compact('posts', 'searchBy'));
    }

    public function searchByCategory(Category $category)
    {
        $posts = \App\Models\Post::limit(15)
            ->published()
            ->where('category_id', $category->id)
            ->with(['author', 'tags', 'cover'])
            ->withCount('comments')
            ->paginate(10);

        $searchBy = $category->name;

        return view('post.search', compact('posts', 'searchBy'));
    }
}
