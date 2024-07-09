<?php

namespace App\Http\Controllers;

use App\Http\Requests\Postrequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function CreatePost(Postrequest $request)
    {
       $data = $request->all();
       $post = new Post();
       $post->user_id = Auth::user()->id;
       $post->title = $data['title'];
       $post->description= $data['description'];
       $post->save();
       return([
           'status' => 'success',
           'message'=>'Post Created',
           'post'=>$post
       ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function listPosts()
    {
        $posts = Post::all();
        return response()->json([
            'status' => 'success',
            'message'=>'Posts Fetched',
            'posts'=>$posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
