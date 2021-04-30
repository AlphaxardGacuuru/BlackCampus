@extends('layouts/app')

@section('content')
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <div class="float-left">
            <a href="/posts">
                <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-arrow-left-short" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M7.854 4.646a.5.5 0 0 1 0 .708L5.207 8l2.647 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0z" />
                    <path fill-rule="evenodd" d="M4.5 8a.5.5 0 0 1 .5-.5h6.5a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z" />
                </svg>
            </a>
        </div>
        <br>
        <br>
        <div class='media p-2 border-bottom'>
            <div class="media-left">
                <img src="/storage/{{ Auth::user()->pp }}" width="40px" height="40px" class="border-radius-50"
                    alt="avatar">
            </div>
            <div class="media-body contact-form">
                {!! Form::open(['action' => 'PostCommentsController@store', 'method' => 'POST', 'enctype' =>
                'multipart/form-data']) !!}
                {{ Form::text('comment-text', '', ['class' => 'form-control', 'placeholder' => "Post your reply"]) }}
                <br>
                {{ Form::hidden('post-id', $post->id) }}
                {{ Form::submit('comment', ['class' => 'btn mysonar-btn float-right']) }}
                {!! Form::close() !!}
            </div>
        </div>
        @if(count($comments) > 0)
            @foreach($comments as $comment)
                <div class='media p-2 border-bottom'>
                    <div class='media-left'>
                        <a href='/users/{{ $comment->user->id }}'>
                            <img src='/storage/{{ $comment->user->pp }}'
                                style='float: right; vertical-align: top; width: 40px; height: 40px; border-radius: 50%;'
                                alt='avatar'>
                        </a>
                    </div>
                    <div class='media-body'>
                        <h6 class="media-heading m-0"
                            style='width: 100%; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                            <b>{{ $comment->user->name }}</b>
                            <small>
                                <i
                                    class="float-right mr-1">{{ $comment->created_at->format('j-M-Y') }}</i>
                            </small>
                        </h6>
                        <p class="mb-0">{{ $comment->text }}</p>
                        {{-- Comment Likes --}}
                        @php
                            $postCommentLikes = $comment->post_comment_likes->where('comment_id',
                            $comment->id)->where('user_id', Auth::user()->id)->count();
                            if($postCommentLikes > 0) {
                            $heart ="
                            <span style='color: #cc3300;'>
                                <svg class=bi bi-heart-fill width=1.2em height=1.2em viewBox=0 0 16 16 fill=currentColor
                                    xmlns=http://www.w3.org/2000/svg>
                                    <path fill-rule=evenodd'
                                        d='M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z' />
                                </svg>
                            </span>";
                            } else {
                            $heart = "
                            <svg class='bi bi-heart' width='1.2em' height='1.2em' viewBox='0 0 16 16'
                                fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                <path fill-rule='evenodd'
                                    d='M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z' />
                            </svg>";
                            }
                        @endphp
                        {!!Form::open(['id' => $comment->id,
                        'action' => 'PostCommentLikesController@store',
                        'method' => 'POST'])!!}
                        {{ Form::hidden('comment-id', $comment->id) }}
                        {{ Form::hidden('post-id', $comment->post->id) }}
                        {!!Form::close()!!}
                        <a href='#' onclick='event.preventDefault();
													 document.getElementById("{{ $comment->id }}").submit();'>
                            {!!$heart!!}
                        </a>
                        <small>{{ $comment->post_comment_likes->count() }}</small>
                        <!-- Default dropup button -->
                        <div class="dropup float-right">
                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <svg class="bi bi-three-dots-vertical" width="1em" height="1em" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                </svg>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-0" style="border-radius: 0;">
                                @php
                                    $commentD = 'comment-delete-form' . $comment->id;
                                @endphp
                                {!!Form::open([
                                'id' => $commentD,
                                'action' => ['PostCommentsController@destroy', $comment->id],
                                'method' => 'POST'
                                ])!!}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {!!Form::close()!!}
                                @if($comment->user_id == Auth::user()->id)
                                    <a href="#" class="dropdown-item" onclick="event.preventDefault();
                                                     document.getElementById('{{ $commentD }}').submit();">
                                        <h6 class="p-1">Delete comment</h6>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="col-sm-4"></div>
</div>
@endsection
