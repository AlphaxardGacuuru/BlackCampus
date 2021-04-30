<?php

namespace App\Http\Controllers;

use App\PostCommentLikes;
use App\PostComments;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        /* Create new post */
        $postComment = new PostComments;
        $postComment->post_id = $request->input('post-id');
        $postComment->user_id = auth()->user()->id;
        $postComment->text = $request->input('comment-text');
        $postComment->media = "";
        $postComment->save();

        return redirect('posts/' . $postComment->post_id)->with('success', 'Comment Sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PostComments  $postComments
     * @return \Illuminate\Http\Response
     */
    public function show(PostComments $postComments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PostComments  $postComments
     * @return \Illuminate\Http\Response
     */
    public function edit(PostComments $postComments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PostComments  $postComments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostComments $postComments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PostComments  $postComments
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postComment = PostComments::where('id', $id)->first();
        PostCommentLikes::where('comment_id', $id)->delete();
        PostComments::find($id)->delete();
        return redirect('posts/' . $postComment->post_id)->with('success', 'Comment deleted');
    }
}
