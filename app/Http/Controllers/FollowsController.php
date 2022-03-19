<?php

namespace App\Http\Controllers;

use App\Follows;
use App\User;
use App\FollowNotifications;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Follows::all();
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
        /* Add follow */
        $followQuery = Follows::where('followed', $request->id)->where('user_id', auth()->user()->id)->count();

        if ($followQuery > 0) {
            Follows::where('followed', $request->id)->where('user_id', auth()->user()->id)->delete();
            $message = "Unfollowed";
        } else {
            $post = new Follows;
            $post->followed = $request->input('id');
            $post->user_id = auth()->user()->id;
            $post->muted = "false";
            $post->blocked = "false";
            $post->save();
            $message = "Followed";

            // $notification = new FollowNotifications;
            // $notification->user_id = $request->input('id');
            // $notification->follower = auth()->user()->id;
            // $notification->save();
        }

		$name = User::find($request->input('id'))->name;

        return response('You ' . $message . ' ' . $name, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Follows  $follows
     * @return \Illuminate\Http\Response
     */
    public function show(Follows $follows)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Follows  $follows
     * @return \Illuminate\Http\Response
     */
    public function edit(Follows $follows)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Follows  $follows
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Follows $follows)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Follows  $follows
     * @return \Illuminate\Http\Response
     */
    public function destroy(Follows $follows)
    {
        //
    }
}
