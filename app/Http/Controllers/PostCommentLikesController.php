<?php

namespace App\Http\Controllers;

use App\PostCommentLikes;
use Illuminate\Http\Request;

class PostCommentLikesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postCommentLikeCount = PostCommentLikes::where('comment_id', $request->input('comment-id'))->where('user_id', auth()->user()->id)->count();
        if ($postCommentLikeCount > 0) {
            PostCommentLikes::where('comment_id', $request->input('comment-id'))->where('user_id', auth()->user()->id)->delete();
            $message = 'Like deleted';
        } else {
            $postCommentLikes = new PostCommentLikes;
            $postCommentLikes->comment_id = $request->input('comment-id');
            $postCommentLikes->user_id = auth()->user()->id;
            $postCommentLikes->save();
            $message = 'Comment liked';
        }

        return redirect('posts/' . $request->input('post-id'))->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PostCommentLikes  $postCommentLikes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PostCommentLikes  $postCommentLikes
     * @return \Illuminate\Http\Response
     */
    public function edit(PostCommentLikes $postCommentLikes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PostCommentLikes  $postCommentLikes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostCommentLikes $postCommentLikes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PostCommentLikes  $postCommentLikes
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostCommentLikes $postCommentLikes)
    {
        //
    }
}
