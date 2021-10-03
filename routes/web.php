<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');

Route::redirect('/', 'posts');

Route::resources([
        'users' => 'UsersController',
        'posts' => 'PostsController',
        'post-likes' => 'PostLikesController',
        'post-comments' => 'PostCommentsController',
        'post-comment-likes' => 'PostCommentLikesController',
        'polls' => 'PollsController',
    ]);
