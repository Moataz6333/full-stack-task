<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;



Route::post('/admin/login', [UserController::class, 'admin_login']);
Route::post('/user/login', [UserController::class, 'user_login']);

Route::middleware('auth:sanctum')->group(function () {
    // get all posts for admin
    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/create-post', [PostController::class, 'store']);
    // admin update
    Route::post('/update-post/{id}', [PostController::class, 'update']);
    // admin delete
    Route::delete('/delete-post/{id}', [PostController::class, 'destroy']);

    // user posts
    Route::get('/user/posts', [PostController::class, 'my_posts']);
    
    // update my post
    Route::post('/update-mypost/{id}', [PostController::class, 'update_mypost']);
    // admin delete
    Route::delete('/delete-mypost/{id}', [PostController::class, 'destroy_myPost']);
});


