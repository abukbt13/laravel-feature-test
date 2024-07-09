<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentsRequest;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function storeComment(CommentsRequest $request,$post_id){

        $user_id=Auth::user()->id;
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->post_id = $post_id;
        $comment->user_id = $user_id;
        $comment->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Comment created successfully!',
            'comments' => $comment
        ], 201);
    }

    public function getComments(){
        $comment = Comment::all();
        return([
            'status' => 'success',
            'message' => 'Comments retrieved',
            'comments' => $comment
        ]);
    }
}
