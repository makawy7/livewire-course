<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

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



Route::get('/contact', function () {
    return view('contact-us');
});
Route::get('/music', function () {
    return view('music');
});
Route::get('/users', function () {
    return view('users-table');
});
Route::get('/posts', function () {
    return view('posts', [
        'posts' => Post::all()
    ]);
});
Route::get('/posts/{post}/show', function (Post $post) {
    return view('posts.show', [
        'post' => $post->load('comments')
    ]);
})->name('post.show');
