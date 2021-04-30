@extends('layouts/app')

@section('content')
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <div class="contact-form">
            {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' =>
            'multipart/form-data']) !!}
            <div class="float-left">
                <a href="/posts">
                    <!-- Close Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-x"
                        viewBox="0 0 16 16">
                        <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                </a>
            </div>
            <div class="form group float-right">
                {{ Form::submit('post', ['class' => 'btn mysonar-btn']) }}
            </div>
            {{ Form::textarea('post-text', '', ['class' => 'form-control', 'placeholder' => "What's on your mind"]) }}
            <div class="form-group">
                {{ Form::file('post-media') }}
            </div>
            <a href="#" onclick="event.preventDefault();
                                                     document.getElementById('postdelete-form').submit();">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-image" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M14.002 2h-12a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zm-12-1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12z" />
                    <path
                        d="M10.648 7.646a.5.5 0 0 1 .577-.093L15.002 9.5V14h-14v-2l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71z" />
                    <path fill-rule="evenodd" d="M4.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                </svg>
            </a>
            <a href="#">
                <svg width="1.4em" height="1.4em" viewBox="0 0 16 16" class="bi bi-bar-chart-steps" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M.5 0a.5.5 0 0 1 .5.5v15a.5.5 0 0 1-1 0V.5A.5.5 0 0 1 .5 0z" />
                    <rect width="5" height="2" x="2" y="1" rx=".5" />
                    <rect width="8" height="2" x="4" y="5" rx=".5" />
                    <path
                        d="M6 9.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1z" />
                </svg>
            </a>
            <br>
            <br>

            <!-- single accordian area -->
            <div class="panel single-accordion">
                <h6>
                    <a role="button" class="collapsed" aria-expanded="true" aria-controls="collapseTwo"
                        data-parent="#accordion" data-toggle="collapse" href="#collapseTwo">Add Poll
                        <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
                        <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
                    </a>
                </h6>
                <div id="collapseTwo" class="accordion-content collapse">
                    <label>
                        {{ Form::text('text', '', ['name' => 'poll_1', 'class' => 'form-control', 'placeholder' => "Parameter 1", 'oninput' => 'inputPara2()']) }}
                    </label>
                    <label id='para-2'></label>
                    <label id='para-3'></label>
                    <label id='para-4'></label>
                    <label id='para-5'></label>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-sm-4"></div>
</div>
@endsection
