<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/favicon-32x32.png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        @php
            use App\Notifications;
            use App\DecoNotifications;
            use App\FollowNotifications;
            use App\VideoNotifications;
            use App\CartVideos;
        @endphp
        @guest
            @php
                class topnavGuest {
                /* Guest properties */
                public $name = 'Guest';
                public $email;
                public $acc_type = 'normal';
                public $acc_type_2;
                public $pp = 'profile-pics/male_avatar.png';
                public $pb;
                public $bio;
                public $dob;
                }

                $user = new topnavGuest();
            @endphp
        @else
            @php
                $user = Auth::user();
            @endphp
        @endguest

        <!-- ***** Main Menu Area Start ***** -->
        <div class="mainMenu d-flex align-items-center justify-content-between">
            <!-- Close Icon -->
            <div class="closeIcon">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-x"
                    viewBox="0 0 16 16">
                    <path
                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg>
            </div>
            <!-- Logo Area -->
            <div class="logo-area">
                <a href="/posts">Black Campus</a>
            </div>
            <!-- Nav -->
            <div class="sonarNav wow fadeInUp" data-wow-delay="1s">
                <nav>
                    <ul style="list-style-type: none;">
                        <li class='nav-item active'>
                            <a href='/posts' class='nav-link'
                                style='color:<?php if(Route::is('posts.index')){echo 'gold';}?>;'>
                                <span style=' float: left; padding-right: 20px;'>
                                    <svg class="bi bi-house" width="1em" height="1em" viewBox="0 0 16 16"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                        <path fill-rule="evenodd"
                                            d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                                    </svg>
                                </span>
                                Home
                            </a>
                        </li>
                        <li class='nav-item active'>
                            <a href='/users' class='nav-link'
                                style='color:<?php if(Route::is('users.index')){echo 'gold';}?>;'>
                                <span style='float: left; padding-right: 20px;'>
                                    <svg class="bi bi-person" width="1em" height="1em" viewBox="0 0 16 16"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    </svg>
                                </span>
                                Leaders
                            </a>
                        </li>
                        <li class='nav-item active'>
                            <a href='/clubs' class='nav-link'
                                style='color:<?php if(Route::is('library.index')){echo 'gold;';}?>;'>
                                <span style='float: left; padding-right: 20px;'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-people" viewBox="0 0 16 16">
                                        <path
                                            d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                                    </svg>
                                </span>
                                Clubs
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <br>
        </div>
        <!-- ***** Main Menu Area End ***** -->

        <!-- ***** Header Area Start ***** -->
        <header style="background-color: #A51F26;" class="header-area">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-12" style="padding: 0;">
                        <div class="menu-area d-flex justify-content-between">
                            <!-- Logo Area  -->
                            <div class="logo-area">
                                <a href="/posts">Black Campus</a>
                            </div>

                            <div class="menu-content-area d-flex align-items-center">
                                <!-- Header Social Area -->
                                <div class="header-social-area d-flex align-items-center">

                                    <!-- Authentication Links -->
                                    @guest
                                        <a class="display-4"
                                            href="{{ route('login') }}">{{ __('Login') }}</a>
                                        @if(Route::has('register'))
                                            <a class="display-4"
                                                href="{{ route('register') }}">{{ __('Register') }}</a>
                                        @endif
                                    @else
                                        {{-- Admin --}}
                                        @if(auth()->user()->username
                                            == '@blackmusic')
                                            <a href="/admin" class="mr-2">
                                                <svg class="bi bi-person" width="1em" height="1em" viewBox="0 0 16 16"
                                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                                </svg>
                                            </a>
                                        @endif
                                        {{-- Avatar Dropdown --}}
                                        <div class="dropdown">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <img style='vertical-align: middle; width: 25px; height: 25px; border-radius: 50%;'
                                                    src='/storage/{{ $user->pp }}' alt='Avatar'>
                                            </a>
                                            <div style="border-radius: 0;"
                                                class="dropdown-menu dropdown-menu-right m-0 p-0"
                                                aria-labelledby="dropdownMenuButton">
                                                <a href="/home/{{ Auth::user()->email }}"
                                                    class="p-3 dropdown-item border-bottom">
                                                    <h5>{{ Auth::user()->name }}</h5>
                                                </a>
                                                <a href="/home/create" class="p-3 dropdown-item border-bottom">
                                                    <h6>Settings</h6>
                                                </a>
                                                <a href="help.php" class="p-3 dropdown-item border-bottom">
                                                    <h6>Help Centre</h6>
                                                </a>
                                                <a href="{{ route('logout') }}"
                                                    class="p-3 dropdown-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    <h6>{{ __('Sign out') }}</h6>
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    @endguest
                                </div>
                                <!-- Menu Icon -->
                                <a href="#" class="hidden" id="menuIcon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#fff"
                                        class="bi bi-list" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- bottom nav -->
        <div class="row" style="margin: 0px; padding: 0px;">
            <div class="col-sm-12" style="margin: 0px; padding: 0px;">
                <div class="bottomNav menu-content-area header-social-area">
                    <div class="container-fluid menu-area d-flex justify-content-between">
                        <a href="/posts" style="color:<?php if(Route::is('posts.index')){echo 'gold';}else{echo 'white';}?>; text-align:
                    center; font-size: 10px; font-weight: 100;">
                            <span style="font-size: 20px; margin: 0;" class="nav-link">
                                <svg class="bi bi-house" width="1em" height="1em" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                    <path fill-rule="evenodd"
                                        d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                                </svg>
                            </span>
                        </a>
                        <a href="/users" style="color: <?php if(Route::is('charts.index')){echo 'gold';}else{echo 'white';}?>; text-align:
                    center; font-size: 10px; font-weight: 100;">
                            <span style="font-size: 20px;" class="nav-link">
                                <svg class="bi bi-person" width="1em" height="1em" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                </svg>
                            </span>
                        </a>
                        <a href="#"
                            style="color: <?php if(Route::is('library.index')){echo 'gold';}else{echo 'white';}?>; text-align: center; font-size: 10px; font-weight: 100;">
                            <span style="font-size: 20px;" class="nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-people" viewBox="0 0 16 16">
                                    <path
                                        d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <br>
        <br>

        <main class="py-4">
            @yield('content')
        </main>

        <br>
        <br>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>
</body>

</html>
