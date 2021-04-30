@extends('layouts/app')

@section('content')
@if($id == Auth::user()->id)
    @php
        $profile = Auth::user();
    @endphp
@else
    @php
        $profile = $users->where('id', $id)->first();
    @endphp
@endif
<!-- Profile pic area -->
<div class="row"
    style="background-image: url('/storage/{{ $profile->pb }}'); background-position: center; background-size: cover; position: relative; height: 90%;">
    <div class="col-sm-12 p-0">
        <br>
        <br class="hidden">
        <div>
            <div style="margin-top: 100px; top: 70px; left: 10px;" class="avatar-container">
                <img style="position: absolute; z-index: 99;" class="avatar hover-img"
                    src="/storage/{{ $profile->pp }}" alt="Avatar">
            </div>
        </div>
    </div>
</div>
<!-- End of Profile pic area -->

{{-- Profile Area --}}
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <br>
        <br>
        @if($profile->id == Auth::user()->id)
            <a href="/users/{{ $profile->id }}/edit">
                <button class="float-right mysonar-btn">edit profile</button>
            </a>
        @endif
        <h3>{{ $profile->name }}</h3>
        <h6>{{ $profile->bio }}</h6>
    </div>
    <div class="col-sm-1"></div>
</div>
{{-- End of Profile Area --}}
<hr>
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <center>
            <h5>Posts</h5>
        </center>
        @php
            $posts = $posts->where('id', $profile->id);
        @endphp
        @if($posts->count() > 0)
            @foreach($posts as $post)
                {{-- Likes --}}
                @php
                    $postLikes = $post->post_likes->where('post_id', $post->id)->where('id',
                    $profile->id)->count();
                @endphp
                @if($postLikes > 0)
                    @php
                        $heartForm = "post-like-delete-form";
                        $heart ="<span style='color: #cc3300;'>
                            <svg class=bi bi-heart-fill width=1.2em height=1.2em viewBox=0 0 16 16 fill=currentColor
                                xmlns=http://www.w3.org/2000/svg>
                                <path fill-rule=evenodd'
                                    d='M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z' />
                            </svg>
                        </span>
                        <small>" . $post->post_likes->count() . "</small>";
                    @endphp
                @else
                    @php
                        $heartForm = "post-like-form";
                        $heart = "
                        <svg class='bi bi-heart' width='1.2em' height='1.2em' viewBox='0 0 16 16' fill='currentColor'
                            xmlns='http://www.w3.org/2000/svg'>
                            <path fill-rule='evenodd'
                                d='M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z' />
                        </svg>
                        <small>" . $post->post_likes->count() . "</small>";
                    @endphp
                @endif
                @php
                    $followCount = $follows->where('followed', $post->id)->where('user_id',
                    $profile->id)->count();
                    /* Get polls */
                    $getPolls = $polls->where('post_id', $post->id);
                    /* Get total polls */
                    $pollTime = (time() - strtotime($post->created_at)) / 3600;
                    if ($post->user_id == $profile->id || $pollTime > 24) {
                    $votes = $polls->where('post_id', $post->id)->count();
                    } else {
                    $votes = "ongoing...";
                    }
                    /* Check if user has voted */
                    $userPoll = $polls->where('post_id', $post->id)->where('user_id', $profile->id);
                @endphp
                {{-- Making the polls look better when they appear --}}
                {{-- Get parameter 1 --}}
                @if(!empty($post->parameter_1))
                    @php
                        $pollCheck = $polls->where('post_id', $post->id)->where('parameter',
                        $post->parameter_1)->count();
                        $pollTime = (time() - strtotime($post->created_at)) / 3600;
                        if ($post->user_id == $profile->id || $pollTime > 24) {
                        $votesTwo = $pollCheck;
                        } else {
                        $votesTwo = "";
                        }
                        $pollParaCheck = $polls->where('post_id', $post->id)->where('user_id',
                        $profile->id)->where('parameter', $post->parameter_1)->count();
                        if ($pollCheck > 0) {
                        $percentage = round($pollCheck / $polls->where('post_id', $post->id)->count() *
                        100);
                        } else {
                        $percentage = 0;
                        }
                    @endphp
                    {{-- Condition to show user's vote after poll expiry --}}
                    @if($pollParaCheck == 1 && $pollTime > 24)
                        @php
                            $yourVote = "gold";
                        @endphp
                    @else
                        @php
                            $yourVote = "#232323";
                        @endphp
                    @endif
                    {{-- Check if user already voted and change the vote button accordingly --}}
                    @if($userPoll->count() == 0 && $pollTime < 24)
                        @php
                            $parameter_1 = Form::button($post->parameter_1,
                            ['type' => 'submit', 'class' => 'mysonar-btn mb-1', 'style' => 'width:
                            100%;']);
                        @endphp
                    @else
                        {{-- Check if user has voted for this parameter in particular and change vote button accordingly --}}
                        @if($pollParaCheck == 1 && $pollTime < 24)
                            @php
                                $parameter_1 = Form::button($post->parameter_1,
                                ['type' => 'reset', 'class' => 'mysonar-btn mb-1 btn-2', 'style' => 'width:
                                100%;']);
                            @endphp
                        @else
                            @if($pollTime < 24)
                                @php
                                    $parameter_1 = Form::button($post->parameter_1,
                                    ['type' => 'reset', 'class' => 'mysonar-btn mb-1', 'style' => 'width:
                                    100%;']);
                                @endphp
                            @endif
                            @php
                                if( $pollTime > 24 || $post->user_id == $post->id) {
                                $parameter_1 =
                                "<div class='progress rounded-0 mb-1' style='height: 33px'>
                                    <div class='progress-bar' style='width: $percentage%; background-color: $yourVote'>
                                        $post->parameter_1 - $percentage%
                                    </div>
                                </div>";
                                }
                            @endphp
                        @endif
                    @endif
                    @php
                        $totalVotes = "<small><i style='color: grey;'>Total votes:$votes</i></small>";
                    @endphp
                @else
                    @php
                        $parameter_1 = "";
                        $totalVotes = "";
                    @endphp
                @endif

                {{-- Get parameter 2 --}}
                @if(!empty($post->parameter_2))
                    @php
                        $pollCheck = $polls->where('post_id', $post->id)->where('parameter',
                        $post->parameter_2)->count();
                        $pollTime = (time() - strtotime($post->created_at)) / 3600;
                        if ($post->user_id == $post->id || $pollTime > 24) {
                        $votesTwo = $pollCheck;
                        } else {
                        $votesTwo = "";
                        }
                        $pollParaCheck = $polls->where('post_id', $post->id)->where('user_id',
                        $post->id)->where('parameter', $post->parameter_2)->count();
                        if ($pollCheck > 0) {
                        $percentage = round($pollCheck / $polls->where('post_id', $post->id)->count() *
                        100);
                        } else {
                        $percentage = 0;
                        }
                    @endphp
                    {{-- Condition to show user's vote after poll expiry --}}
                    @if($pollParaCheck == 1 && $pollTime > 24)
                        @php
                            $yourVote = "gold";
                        @endphp
                    @else
                        @php
                            $yourVote = "#232323";
                        @endphp
                    @endif
                    {{-- Check if user already voted and change the vote button accordingly --}}
                    @if($userPoll->count() == 0 && $pollTime < 24)
                        @php
                            $parameter_2 = Form::button($post->parameter_2,
                            ['type' => 'submit', 'class' => 'mysonar-btn mb-1', 'style' => 'width:
                            100%;']);
                        @endphp
                    @else
                        {{-- Check if user has voted for this parameter in particular and change vote button accordingly --}}
                        @if($pollParaCheck == 1 && $pollTime < 24)
                            @php
                                $parameter_2 = Form::button($post->parameter_2,
                                ['type' => 'reset', 'class' => 'mysonar-btn mb-1 btn-2', 'style' => 'width:
                                100%;']);
                            @endphp
                        @else
                            @if($pollTime < 24)
                                @php
                                    $parameter_2 = Form::button($post->parameter_2,
                                    ['type' => 'reset', 'class' => 'mysonar-btn mb-1', 'style' => 'width:
                                    100%;']);
                                @endphp
                            @endif
                            @php
                                if( $pollTime > 24 || $post->user_id == $post->id) {
                                $parameter_2 =
                                "<div class='progress rounded-0 mb-1' style='height: 33px'>
                                    <div class='progress-bar' style='width: $percentage%; background-color: $yourVote'>
                                        $post->parameter_2 - $percentage%
                                    </div>
                                </div>";
                                }
                            @endphp
                        @endif
                    @endif
                    @php
                        $totalVotes = "<small><i style='color: grey;'>Total votes:$votes</i></small>";
                    @endphp
                @else
                    @php
                        $parameter_2 = "";
                        $totalVotes = "";
                    @endphp
                @endif

                {{-- Get parameter 3 --}}
                @if(!empty($post->parameter_3))
                    @php
                        $pollCheck = $polls->where('post_id', $post->id)->where('parameter',
                        $post->parameter_3)->count();
                        $pollTime = (time() - strtotime($post->created_at)) / 3600;
                        if ($post->user_id == $post->id || $pollTime > 24) {
                        $votesTwo = $pollCheck;
                        } else {
                        $votesTwo = "";
                        }
                        $pollParaCheck = $polls->where('post_id', $post->id)->where('user_id',
                        $post->id)->where('parameter', $post->parameter_3)->count();
                        if ($pollCheck > 0) {
                        $percentage = round($pollCheck / $polls->where('post_id', $post->id)->count() *
                        100);
                        } else {
                        $percentage = 0;
                        }
                    @endphp
                    {{-- Condition to show user's vote after poll expiry --}}
                    @if($pollParaCheck == 1 && $pollTime > 24)
                        @php
                            $yourVote = "gold";
                        @endphp
                    @else
                        @php
                            $yourVote = "#232323";
                        @endphp
                    @endif
                    {{-- Check if user already voted and change the vote button accordingly --}}
                    @if($userPoll->count() == 0 && $pollTime < 24)
                        @php
                            $parameter_3 = Form::button($post->parameter_3,
                            ['type' => 'submit', 'class' => 'mysonar-btn mb-1', 'style' => 'width:
                            100%;']);
                        @endphp
                    @else
                        {{-- Check if user has voted for this parameter in particular and change vote button accordingly --}}
                        @if($pollParaCheck == 1 && $pollTime < 24)
                            @php
                                $parameter_3 = Form::button($post->parameter_3,
                                ['type' => 'reset', 'class' => 'mysonar-btn mb-1 btn-2', 'style' => 'width:
                                100%;']);
                            @endphp
                        @else
                            @if($pollTime < 24)
                                @php
                                    $parameter_3 = Form::button($post->parameter_3,
                                    ['type' => 'reset', 'class' => 'mysonar-btn mb-1', 'style' => 'width:
                                    100%;']);
                                @endphp
                            @endif
                            @php
                                if( $pollTime > 24 || $post->user_id == $post->id) {
                                $parameter_3 =
                                "<div class='progress rounded-0 mb-1' style='height: 33px'>
                                    <div class='progress-bar' style='width: $percentage%; background-color: $yourVote'>
                                        $post->parameter_3 - $percentage%
                                    </div>
                                </div>";
                                }
                            @endphp
                        @endif
                    @endif
                    @php
                        $totalVotes = "<small><i style='color: grey;'>Total votes:$votes</i></small>";
                    @endphp
                @else
                    @php
                        $parameter_3 = "";
                        $totalVotes = "";
                    @endphp
                @endif

                {{-- Get parameter 4 --}}
                @if(!empty($post->parameter_4))
                    @php
                        $pollCheck = $polls->where('post_id', $post->id)->where('parameter',
                        $post->parameter_4)->count();
                        $pollTime = (time() - strtotime($post->created_at)) / 3600;
                        if ($post->user_id == $post->id || $pollTime > 24) {
                        $votesTwo = $pollCheck;
                        } else {
                        $votesTwo = "";
                        }
                        $pollParaCheck = $polls->where('post_id', $post->id)->where('user_id',
                        $post->id)->where('parameter', $post->parameter_4)->count();
                        if ($pollCheck > 0) {
                        $percentage = round($pollCheck / $polls->where('post_id', $post->id)->count() *
                        100);
                        } else {
                        $percentage = 0;
                        }
                    @endphp
                    {{-- Condition to show user's vote after poll expiry --}}
                    @if($pollParaCheck == 1 && $pollTime > 24)
                        @php
                            $yourVote = "gold";
                        @endphp
                    @else
                        @php
                            $yourVote = "#232323";
                        @endphp
                    @endif
                    {{-- Check if user already voted and change the vote button accordingly --}}
                    @if($userPoll->count() == 0 && $pollTime < 24)
                        @php
                            $parameter_4 = Form::button($post->parameter_4,
                            ['type' => 'submit', 'class' => 'mysonar-btn mb-1', 'style' => 'width:
                            100%;']);
                        @endphp
                    @else
                        {{-- Check if user has voted for this parameter in particular and change vote button accordingly --}}
                        @if($pollParaCheck == 1 && $pollTime < 24)
                            @php
                                $parameter_4 = Form::button($post->parameter_4,
                                ['type' => 'reset', 'class' => 'mysonar-btn mb-1 btn-2', 'style' => 'width:
                                100%;']);
                            @endphp
                        @else
                            @if($pollTime < 24)
                                @php
                                    $parameter_4 = Form::button($post->parameter_4,
                                    ['type' => 'reset', 'class' => 'mysonar-btn mb-1', 'style' => 'width:
                                    100%;']);
                                @endphp
                            @endif
                            @php
                                if( $pollTime > 24 || $post->user_id == $post->id) {
                                $parameter_4 =
                                "<div class='progress rounded-0 mb-1' style='height: 33px'>
                                    <div class='progress-bar' style='width: $percentage%; background-color: $yourVote'>
                                        $post->parameter_4 - $percentage%
                                    </div>
                                </div>";
                                }
                            @endphp
                        @endif
                    @endif
                    @php
                        $totalVotes = "<small><i style='color: grey;'>Total votes:$votes</i></small>";
                    @endphp
                @else
                    @php
                        $parameter_4 = "";
                        $totalVotes = "";
                    @endphp
                @endif

                {{-- Get parameter 5 --}}
                @if(!empty($post->parameter_5))
                    @php
                        $pollCheck = $polls->where('post_id', $post->id)->where('parameter',
                        $post->parameter_5)->count();
                        $pollTime = (time() - strtotime($post->created_at)) / 3600;
                        if ($post->user_id == $post->id || $pollTime > 24) {
                        $votesTwo = $pollCheck;
                        } else {
                        $votesTwo = "";
                        }
                        $pollParaCheck = $polls->where('post_id', $post->id)->where('user_id',
                        $post->id)->where('parameter', $post->parameter_5)->count();
                        if ($pollCheck > 0) {
                        $percentage = round($pollCheck / $polls->where('post_id', $post->id)->count() *
                        100);
                        } else {
                        $percentage = 0;
                        }
                    @endphp
                    {{-- Condition to show user's vote after poll expiry --}}
                    @if($pollParaCheck == 1 && $pollTime > 24)
                        @php
                            $yourVote = "gold";
                        @endphp
                    @else
                        @php
                            $yourVote = "#232323";
                        @endphp
                    @endif
                    {{-- Check if user already voted and change the vote button accordingly --}}
                    @if($userPoll->count() == 0 && $pollTime < 24)
                        @php
                            $parameter_5 = Form::button($post->parameter_5,
                            ['type' => 'submit', 'class' => 'mysonar-btn mb-1', 'style' => 'width:
                            100%;']);
                        @endphp
                    @else
                        {{-- Check if user has voted for this parameter in particular and change vote button accordingly --}}
                        @if($pollParaCheck == 1 && $pollTime < 24)
                            @php
                                $parameter_5 = Form::button($post->parameter_5,
                                ['type' => 'reset', 'class' => 'mysonar-btn mb-1 btn-2', 'style' => 'width:
                                100%;']);
                            @endphp
                        @else
                            @if($pollTime < 24)
                                @php
                                    $parameter_5 = Form::button($post->parameter_5,
                                    ['type' => 'reset', 'class' => 'mysonar-btn mb-1', 'style' => 'width:
                                    100%;']);
                                @endphp
                            @endif
                            @php
                                if( $pollTime > 24 || $post->user_id == $post->id) {
                                $parameter_5 =
                                "<div class='progress rounded-0 mb-1' style='height: 33px'>
                                    <div class='progress-bar' style='width: $percentage%; background-color: $yourVote'>
                                        $post->parameter_5 - $percentage%
                                    </div>
                                </div>";
                                }
                            @endphp
                        @endif
                    @endif
                    @php
                        $totalVotes = "<small><i style='color: grey;'>Total votes:$votes</i></small>";
                    @endphp
                @else
                    @php
                        $parameter_5 = "";
                        $totalVotes = "";
                    @endphp
                @endif

                {{-- Check if user has followed poster --}}
                @if($followCount == 1)
                    <div class='media p-2 border-bottom'>
                        <div class='media-left'>
                            <a href='/users/{{ $post->user_id }}'>
                                <img src='/storage/{{ $post->user->pp }}'
                                    style='float: right; vertical-align: top; width: 40px; height: 40px; border-radius: 50%;'
                                    alt='avatar'>
                            </a>
                        </div>
                        <div class='media-body'>
                            <h6 class="media-heading m-0"
                                style='width: 100%; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                                <b>{{ $post->user->name }}</b><small>{{ $post->user_id }}</small>
                                <span style='color: gold;'>
                                    <svg class="bi bi-circle" width="1em" height="1em" viewBox="0 0 16 16"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    </svg>
                                </span>
                                <span style='font-size: 10px;'>{{ $post->user->deco }}</span>
                                <small>
                                    <i
                                        class="float-right mr-1">{{ $post->created_at->format('j-M-Y') }}</i>
                                </small>
                            </h6>
                            <p class="mb-0">
                                {{ $post->text }}
                            </p>
                            {{-- Show media --}}
                            @if(!empty($post->media))
                                <div class="mb-1" style="border-top-left-radius: 10px; border-top-right-radius: 10px;
                                    border-bottom-right-radius: 10px; border-bottom-left-radius: 10px; overflow:
                                    hidden; width: 100%; height: auto;">
                                    <img src="/storage/{{ $post->media }}" alt="" width="auto" height="auto">
                                </div>
                            @elseif(!empty($post->parameter_1))
                                {{-- Poll --}}
                                {{-- Parameter 1 --}}
                                {!!Form::open(['action' => 'PollsController@store', 'method' => 'POST'])!!}
                                {!! $parameter_1 !!}
                                {{ Form::hidden('post-id', $post->id) }}
                                {{ Form::hidden('parameter', $post->parameter_1) }}
                                {!!Form::close()!!}
                                {{-- Parameter 2 --}}
                                {!!Form::open(['action' => 'PollsController@store', 'method' => 'POST'])!!}
                                {!! $parameter_2 !!}
                                {{ Form::hidden('post-id', $post->id) }}
                                {{ Form::hidden('parameter', $post->parameter_2) }}
                                {!!Form::close()!!}
                                {{-- Parameter 3 --}}
                                {!!Form::open(['action' => 'PollsController@store', 'method' => 'POST'])!!}
                                {!! $parameter_3 !!}
                                {{ Form::hidden('post-id', $post->id) }}
                                {{ Form::hidden('parameter', $post->parameter_3) }}
                                {!!Form::close()!!}
                                {{-- Parameter 4 --}}
                                {!!Form::open(['action' => 'PollsController@store', 'method' => 'POST'])!!}
                                {!! $parameter_4 !!}
                                {{ Form::hidden('post-id', $post->id) }}
                                {{ Form::hidden('parameter', $post->parameter_4) }}
                                {!!Form::close()!!}
                                {{-- Parameter 5 --}}
                                {!!Form::open(['action' => 'PollsController@store', 'method' => 'POST'])!!}
                                {!! $parameter_5 !!}
                                {{ Form::hidden('post-id', $post->id) }}
                                {{ Form::hidden('parameter', $post->parameter_5) }}
                                {!! $totalVotes !!}
                                {!!Form::close()!!}
                            @endif

                            {{-- Likes --}}
                            {!!Form::open(['id' => $post->id, 'action' => 'PostLikesController@store',
                            'method' => 'POST'])!!}
                            {{ Form::hidden('post-id', $post->id) }}
                            {{ Form::hidden('to', '/users/' . $post->id) }}
                            {!!Form::close()!!}
                            <a href='#' onclick='event.preventDefault();
													 document.getElementById("{{ $post->id }}").submit();'>
                                {!!$heart!!}
                            </a>
                            {{-- Comment --}}
                            <a href="/posts/{{ $post->id }}">
                                <svg class="bi bi-chat ml-5" width="1.2em" height="1.2em" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
                                </svg>
                                <small>{{ $post->post_comments->count() }}</small>
                            </a>
                            <!-- Default dropup button -->
                            <div class="dropup float-right">
                                <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <svg class="bi bi-three-dots-vertical" width="1em" height="1em" viewBox="0 0 16 16"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                    </svg>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right p-0" style="border-radius: 0;">
                                    @php
                                        $postD = 'post-delete-form' . $post->id;
                                    @endphp
                                    @if($post->id
                                        == Auth::user()->id)
                                        @if($post->user_id != $post->id)
                                            @if($post->user_id
                                                != '@blackmusic')
                                                <a href='#' class="dropdown-item">
                                                    <h6>Mute</h6>
                                                </a>
                                                <a href='#' class="dropdown-item">
                                                    <h6>Unfollow {{ $post->poster_id }}</h6>
                                                </a>
                                            @endif
                                        @else
                                            {!!Form::open(['id' => $postD, 'action' =>
                                            ['PostsController@destroy',
                                            $post->id], 'method' => 'POST'])!!}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            {!!Form::close()!!}
                                            <a href='#' class="dropdown-item" onclick='event.preventDefault();
													 document.getElementById("{{ $postD }}").submit();'>
                                                <h6>Delete post</h6>
                                            </a>
                                        @endif
                                    @else
                                        @if($post->user_id == $post->id)
                                            @if($post->user_id
                                                != '@blackmusic')
                                                <a href='#' class="dropdown-item">
                                                    <h6>Mute</h6>
                                                </a>
                                                <a href='#' class="dropdown-item">
                                                    <h6>Unfollow {{ $post->poster_id }}</h6>
                                                </a>
                                            @endif
                                        @else
                                            {!!Form::open(['id' => $postD, 'action' =>
                                            ['PostsController@destroy',
                                            $post->id], 'method' => 'POST'])!!}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            {!!Form::close()!!}
                                            <a href='#' class="dropdown-item" onclick='event.preventDefault();
													 document.getElementById("{{ $postD }}").submit();'>
                                                <h6>Delete post</h6>
                                            </a>
                                        @endif
                                    @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
    <div class="col-sm-4"></div>
</div>
@endsection
