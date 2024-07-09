<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('auth/register', [AuthController::class,'RegisterUser']);
Route::post('/auth/login', [AuthController::class,'LoginUser']);


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'v1'], function () {
        Route::post('/posts', [PostController::class, 'CreatePost']);
        Route::get('/posts', [PostController::class, 'listPosts']);
        Route::get('/posts/{post_id}', [PostController::class, 'getPost']);
        Route::put('/posts/{post_id}', [PostController::class, 'updatePost']);
        Route::delete('/posts/{post_id}', [PostController::class, 'deletePost']);

        Route::post('/posts/{post_id}/comments', [CommentController::class, 'storeComment']);
        Route::get('/posts/{post_id}/comments', [CommentController::class, 'getComments']);
        Route::get('/posts/{post_id}/comments/{comment_id}', [CommentController::class, 'getComment']);
        Route::put('/posts/{post_id}/comments/{comment_id}', [CommentController::class, 'updateComment']);
        Route::delete('/posts/{post_id}/comments/{comment_id}', [CommentController::class, 'deleteComment']);
    });
   });
