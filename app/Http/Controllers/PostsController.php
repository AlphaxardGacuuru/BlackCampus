<?php

namespace App\Http\Controllers;

use App\Follows;
use App\Polls;
use App\PostCommentLikes;
use App\PostComments;
use App\PostLikes;
use App\Posts;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getUsers = User::where('id', '!=', auth()->user()->id)
            ->where('id', '!=', 29)
            ->where('account_type', 'leader')
            ->get();

        // Get leaders
        foreach ($getUsers as $key => $user) {
            // Check if user has followed leader
            $hasFollowed = Follows::where('followed', $user->id)
                ->where('user_id', auth()->user()->id)
                ->exists();

            // Get leaders only
            $leaders[$key] = array(
                "id" => $user->id,
                "name" => $user->name,
                "account_type" => $user->account_type,
                "pp" => $user->pp,
                "bio" => $user->bio,
                "hasFollowed" => $hasFollowed,
            );
        }

        $getPosts = Posts::where('user_id', '!=', 29)->orderBy('id', 'DESC')->get();

        // Get Posts
        foreach ($getPosts as $key => $post) {
            // Check if user has followed leader
            $hasFollowed = Follows::where('followed', $post->user_id)
                ->where('user_id', auth()->user()->id)
                ->exists();

            // Check if user has liked post
            $hasLiked = PostLikes::where('post_id', $post->id)
                ->where('user_id', auth()->user()->id)
                ->exists();

            // Check if user has voted for parameter 1
            $hasVoted1 = Polls::where('user_id', auth()->user()->id)
                ->where('post_id', $post->id)
                ->where('parameter', $post->parameter_1)
                ->exists();
            // Check if user has voted for parameter 2
            $hasVoted2 = Polls::where('user_id', auth()->user()->id)
                ->where('post_id', $post->id)
                ->where('parameter', $post->parameter_2)
                ->exists();

            // Check if user has voted for parameter 3
            $hasVoted3 = Polls::where('user_id', auth()->user()->id)
                ->where('post_id', $post->id)
                ->where('parameter', $post->parameter_3)
                ->exists();

            // Check if user has voted for parameter 4
            $hasVoted4 = Polls::where('user_id', auth()->user()->id)
                ->where('post_id', $post->id)
                ->where('parameter', $post->parameter_4)
                ->exists();

            // Check if user has voted for parameter 5
            $hasVoted5 = Polls::where('user_id', auth()->user()->id)
                ->where('post_id', $post->id)
                ->where('parameter', $post->parameter_5)
                ->exists();

            // Get percentage for parameter 1
            // Get total polls for parameter 1
            $totalParameter1 = Polls::where('post_id', $post->id)
                ->where('parameter', $post->parameter_1)
                ->count();

            // Check if total polls for parameter 1 is not 0
            if ($totalParameter1 > 0) {
                $percentage1 = Polls::where('post_id', $post->id)->count() /
                    $totalParameter1 * 100;
            } else {
                $percentage1 = 0;
            }

            // Get total polls for parameter 2
            $totalParameter2 = Polls::where('post_id', $post->id)
                ->where('parameter', $post->parameter_2)
                ->count();

            // Check if total polls for parameter 2 is not 0
            if ($totalParameter2 > 0) {
                $percentage2 = Polls::where('post_id', $post->id)->count() /
                    $totalParameter2 * 100;
            } else {
                $percentage2 = 0;
            }

            // Get total polls for parameter 3
            $totalParameter3 = Polls::where('post_id', $post->id)
                ->where('parameter', $post->parameter_3)
                ->count();

            // Check if total polls for parameter 1 is not 0
            if ($totalParameter3 > 0) {
                $percentage3 = Polls::where('post_id', $post->id)->count() /
                    $totalParameter3 * 100;
            } else {
                $percentage3 = 0;
            }

            // Get total polls for parameter 4
            $totalParameter4 = Polls::where('post_id', $post->id)
                ->where('parameter', $post->parameter_4)
                ->count();

            // Check if total polls for parameter 1 is not 0
            if ($totalParameter4 > 0) {
                $percentage4 = Polls::where('post_id', $post->id)->count() /
                    $totalParameter4 * 100;
            } else {
                $percentage4 = 0;
            }

            // Get total polls for parameter 5
            $totalParameter5 = Polls::where('post_id', $post->id)
                ->where('parameter', $post->parameter_5)
                ->count();

            // Check if total polls for parameter 5 is not 0
            if ($totalParameter5 > 0) {
                $percentage5 = Polls::where('post_id', $post->id)->count() /
                    $totalParameter5 * 100;
            } else {
                $percentage5 = 0;
            }

            // Get total votes
            $totalVotes = Polls::where("post_id", $post->id)
                ->count();

            // Check if poll is within 24Hrs
            $isWithin24Hrs = Posts::where('id', $post->id)
                ->where('created_at', '>', Carbon::now()->subDays(1)->toDateTimeString())
                ->exists();

            $posts[$key] = array(
                "id" => $post->id,
                "user_id" => $post->user->id,
                "user" => $post->user->name,
                "pp" => $post->user->pp,
                "text" => $post->text,
                "media" => $post->media,
                "parameter_1" => $post->parameter_1,
                "parameter_2" => $post->parameter_2,
                "parameter_3" => $post->parameter_3,
                "parameter_4" => $post->parameter_4,
                "parameter_5" => $post->parameter_5,
                "hasVoted1" => $hasVoted1,
                "hasVoted2" => $hasVoted2,
                "hasVoted3" => $hasVoted3,
                "hasVoted4" => $hasVoted4,
                "hasVoted5" => $hasVoted5,
                "percentage1" => $percentage1,
                "percentage2" => $percentage2,
                "percentage3" => $percentage3,
                "percentage4" => $percentage4,
                "percentage5" => $percentage5,
                "totalVotes" => $totalVotes,
                "isWithin24Hrs" => $isWithin24Hrs,
                "hasFollowed" => $hasFollowed,
                "hasLiked" => $hasLiked,
                "likes" => $post->postLikes->count(),
                "comments" => $post->postComments->count(),
                "created_at" => $post->created_at->format("d F Y"),
            );
        }

        return ["leaders" => $leaders, "posts" => $posts];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/post-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('filepond-media')) {
            /* Handle media upload */
            $media = $request->file('filepond-media')->store('public/post-media');
            $media = substr($media, 7);
            return $media;
        } else {

            $this->validate($request, [
                'text' => 'required',
            ]);

			// Get proper location for media
			$media = $request->input('media') ? '/storage/' . $request->input('media') : "";

            /* Create new post */
            $post = new Posts;
            $post->user_id = auth()->user()->id;
            $post->text = $request->input('text');
            $post->media = $media;
            $post->parameter_1 = $request->input('para1') ? $request->input('para1') : "";
            $post->parameter_2 = $request->input('para2') ? $request->input('para2') : "";
            $post->parameter_3 = $request->input('para3') ? $request->input('para3') : "";
            $post->parameter_4 = $request->input('para4') ? $request->input('para4') : "";
            $post->parameter_5 = $request->input('para5') ? $request->input('para5') : "";
            $post->save();

            return redirect('posts')->with('success', 'Post Sent');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getComments = PostComments::where('post_id', $id)->orderby('id', 'DESC')->get();

        foreach ($getComments as $key => $comment) {
            // Check if user has liked
            $hasLiked = PostCommentLikes::where('user_id', auth()->user()->id)
                ->where('comment_id', $comment->id)
                ->exists();

            $comments[$key] = array(
                "id" => $comment->id,
                "user_id" => $comment->user->id,
                "name" => $comment->user->name,
                "pp" => $comment->user->pp,
                "text" => $comment->text,
                "hasLiked" => $hasLiked,
                "likes" => $comment->postCommentLikes->count(),
                "created_at" => $comment->created_at->format("d M Y"),
            );
        }

        return $comments;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $posts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Check file extension and handle filepond delete accordingly
        $ext = substr($id, -3);

        if ($ext == 'jpg' || $ext == 'png' || $ext == 'gif') {
            Storage::delete('public/post-media/' . $id);
            return response("Post media deleted", 200);
        } else {
            $post = Posts::where('id', $id)->first();
            Storage::delete('public/' . $post->media);
            Polls::where('post_id', $post->id)->delete();
            $comments = PostComments::where('post_id', $id)->get();
            foreach ($comments as $comment) {
                PostCommentLikes::where('comment_id', $comment->id)->delete();
            }
            PostComments::where('post_id', $id)->delete();
            PostLikes::where('post_id', $id)->delete();
            Posts::find($id)->delete();

            return response("Post deleted", 200);
        }
    }
}
