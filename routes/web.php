<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/users', [UserController::class, 'index']) ->name('users.users');
Route::match(['get', 'post'], '/users/{id}', [UserController::class, 'show'])->name('users.show');


//////////////////ADMIN//////////////////////////
Route::match(['get', 'post'], '/users/{id}', [AdminController::class, 'show'])->name('admin.show');
Route::get('/', [AdminController::class, 'home'])->name('admin.index');
Route::get('/login', [AdminController::class, 'log']);
Route::post('/login', [AdminController::class, 'login'])->name('login');
Route::get('/admin/users', [AdminController::class, 'index']) ->name('admin.users');
Route::get('/register', [AdminController::class, 'create']) ->name('user.create');
Route::post('/admin/users', [AdminController::class, 'store'])->name('user.store');
Route::post('/admin', [AdminController::class, 'storeAdmins'])->name('admin.store');
Route::delete('/admin/users/{userId}', [AdminController::class, 'deleteUser']) ->name('user.delete');



//////////////////////POSTS////////////////////////
Route::match(['get', 'post'], '/profile/{id}', [PostController::class, 'profile'])->name('users.show');
Route::get('/admin/posts', [PostController::class, 'index']) ->name('admin.posts');
Route::match(['get', 'post'], '/profile/posts/{userId}', [PostController::class, 'show'])->name('users.posts');
Route::get('/profile/{userId}/posts', [PostController::class, 'create'])->name('posts.create');
Route::post('/profile/posts/{userId}', [PostController::class, 'store'])->name('posts.store');
Route::delete('/profile/posts/{userId}/delete/{postId}', [PostController::class, 'destroy'])->name('posts.delete');

////////////////////Comments////////////////////////
Route::match(['get', 'post'], '/profile/posts/{userId}/comments/{postId}', [CommentController::class, 'show'])->name('users.comment');
Route::get('/profile/{userId}/posts/{postId}/comments', [CommentController::class, 'create'])->name('comment.create');
Route::post('/profile/posts/{userId}/comments/{postId}', [CommentController::class, 'store'])->name('comment.store');
Route::delete('/profile/{userId}/posts/{postId}/comments/{commentId}', [CommentController::class, 'delete'])->name('comment.delete');



