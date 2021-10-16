<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Auth::routes();

Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('home', 'HomeController@index');

Route::resources([
    'follows' => "FollowsController",
    'follow-notifications' => "FollowNotificationsController",
    'notifications' => "NotificationsController",
    'posts' => 'PostsController',
    'post-likes' => 'PostLikesController',
    'post-comments' => 'PostCommentsController',
    'post-comment-likes' => 'PostCommentLikesController',
    'polls' => 'PollsController',
    'stories' => 'StoriesController',
    'users' => 'UsersController',
]);
