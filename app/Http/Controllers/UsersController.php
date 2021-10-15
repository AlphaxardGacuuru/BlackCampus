<?php

namespace App\Http\Controllers;

use App\Follows;
use App\Polls;
use App\Posts;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getUser = User::where('id', $id)->first();

        // Get profile info
        $profile = array(
            "name" => $getUser->name,
            "email" => $getUser->email,
            "pp" => $getUser->pp,
            "following" => Follows::where('followed',  auth()->user()->id)->where('user_id', $id)->count(),
            "followers" => Follows::where('followed',  $id)->where('user_id', auth()->user()->id)->count(),
            "hasFollowed" => Follows::where('followed', $id)->where('user_id', auth()->user()->id)->exists(),
        );

        return response(["profile" => $profile]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
