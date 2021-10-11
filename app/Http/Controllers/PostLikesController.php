<?php

namespace App\Http\Controllers;

use App\PostLikes;
use Illuminate\Http\Request;

class PostLikesController extends Controller
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
        $postLikeCount = PostLikes::where('post_id', $request->input('post-id'))->where('user_id', auth()->user()->id)->count();
        if ($postLikeCount > 0) {
            PostLikes::where('post_id', $request->input('post-id'))->where('user_id', auth()->user()->id)->delete();
            $message = "Like removed";
        } else {
            $postLike = new PostLikes;
            $postLike->post_id = $request->input('post-id');
            $postLike->user_id = auth()->user()->id;
            $postLike->save();
            $message = "Post liked";
        }

        return redirect('posts')->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PostLikes  $postLikes
     * @return \Illuminate\Http\Response
     */
    public function show(PostLikes $postLikes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PostLikes  $postLikes
     * @return \Illuminate\Http\Response
     */
    public function edit(PostLikes $postLikes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PostLikes  $postLikes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostLikes $postLikes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PostLikes  $postLikes
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostLikes $postLikes)
    {
        //
    }
}
