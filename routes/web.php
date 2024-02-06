<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\CommunityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::post('/communities/{community}/kick/{user}', [CommunityController::class, 'kick'])->name('communities.kick');
    Route::post('/communities/{community}/approve/{user}', [CommunityController::class, 'approve'])->name('communities.approve');
    Route::post('/communities/{community}/reject/{user}', [CommunityController::class, 'reject'])->name('communities.reject');
    Route::get('/communities/{community}/posts/create', [CommunityController::class, 'communityPostCreate'])->name('communityPostCreate');
    Route::post('/communities/{community}/posts', [CommunityController::class, 'communityPostStore'])->name('communityPostStore');
    Route::get('/communities-home', [HomeController::class, 'communities'])->name('communities');
    Route::resource('communities', CommunityController::class);
    Route::post('/communities/{community}/join', [CommunityController::class, 'joinCommunity'])->name('joinCommunity');
    Route::post('/communities/{community}/leave', [CommunityController::class, 'leaveCommunity'])->name('leaveCommunity');
    Route::post('/posts/{post}/vote', [VoteController::class, 'vote'])->name('vote');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/my-posts', [HomeController::class, 'myPosts'])->name('myPosts');
    Route::resource('posts', PostController::class);
    Route::post('/posts/{post}/comments', [CommentController::class, 'comment'])->name('comment');
    Route::delete('/comments/{comment}', [CommentController::class, 'delComment'])->name('delComment');
    Route::post('/comments/{comment}/reply', [CommentController::class, 'reply'])->name('reply');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
