<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('isAdmin');
        $posts = Post::with('user')->orderBy('created_at', 'desc')
            ->paginate(5);

        return response()->json([
            'posts' => PostResource::collection($posts),
            'current_page' => $posts->currentPage(),
            'total' => $posts->total(),
            'last_page' => $posts->lastPage()
        ], 200);
    }

    

    
    public function store(CreatePostRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'user_id' => $request->user()->id,
            'content' => $request->content,
            'status' => $request->status
        ]);
        return response()->json(['message' => 'Post created successfully'], 201);
    }

   

    
    public function update(CreatePostRequest $request, string $id)
    {
        $post = Post::findOrFail($id);
        Gate::authorize('isAdmin');

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status
        ]);

        return response()->json(['message' => 'Post updated successfully','post'=>$post], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        Gate::authorize('isAdmin');

        $post->delete();
        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
    // user part
    public function my_posts(Request $request)
    {
        Gate::authorize('isUser');
        $posts = Post::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return response()->json([
            'posts' => PostResource::collection($posts),
            'current_page' => $posts->currentPage(),
            'total' => $posts->total(),
            'last_page' => $posts->lastPage()
        ], 200);
    }
    public function update_mypost(CreatePostRequest $request, string $id)
    {
        $post = Post::findOrFail($id);
        Gate::authorize('PostOwner',$post);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status
        ]);

        return response()->json(['message' => 'Post updated successfully', 'post' => $post], 200);
    }
    public function destroy_mypost(string $id)
    {
        $post = Post::findOrFail($id);
        Gate::authorize('PostOwner', $post);

        $post->delete();
        return response()->json(['message' => 'Post deleted successfully'], 200);
    }

}
