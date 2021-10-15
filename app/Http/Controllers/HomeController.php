<?php

namespace App\Http\Controllers;

use App\Follows;
use App\Posts;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return [
            "id" => Auth::user()->id,
            "name" => Auth::user()->name,
            "email" => Auth::user()->email,
            "account_type" => Auth::user()->account_type,
            "pp" => Auth::user()->pp,
            "pb" => Auth::user()->pb,
            "bio" => Auth::user()->bio,
            "dob" => Auth::user()->dob,
            "followers" => Follows::where('followed', Auth::user()->id)->count(),
            "following" => Follows::where('followed', Auth::user()->id)->count(),
            "posts" => Posts::where('user_id', Auth::user()->id)->count(),
            "created_at" => Auth::user()->created_at,
        ];
    }
}
