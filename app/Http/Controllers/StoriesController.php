<?php

namespace App\Http\Controllers;

use App\Stories;
use Illuminate\Http\Request;

class StoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check if story is within 24Hrs
        // Stories::where('created_at', '<', Carbon::now()->subDays(1)->toDateTimeString())->get();
        // ->delete();
        // Storage::delete('public/post-media/' . substr($story->media));

        $stories = Stories::all();

        foreach ($stories as $key => $story) {
            $stories[$key] = array(
                "id" => $story->id,
                "user_id" => $story->user->id,
                "name" => $story->user->name,
                "pp" => $story->user->pp,
                "media" => $story->media,
            );
        }

        return $stories;
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
        /* Handle media upload */
        $media = $request->file('filepond-media')->store('public/story-media');

        // Get proper location for media
        $media = '/storage/' . substr($media, 7);

        $story = new Stories;
        $story->user_id = auth()->user()->id;
        $story->media = $media;
        $story->save();

        return $media;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StoriesController  $storiesController
     * @return \Illuminate\Http\Response
     */
    public function show(StoriesController $storiesController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StoriesController  $storiesController
     * @return \Illuminate\Http\Response
     */
    public function edit(StoriesController $storiesController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StoriesController  $storiesController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoriesController $storiesController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StoriesController  $storiesController
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Storage::delete('public/story-media/' . $id);
        return response("Stories media deleted", 200);
    }
}
