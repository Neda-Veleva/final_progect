<!DOCTYPE html>
<html>
    <head>
        @section('head')
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="/styles/style.css">        
        @show
        {{ HTML::script('/ckeditor/ckeditor.js')}}
    </head>
    <body>
        <div class="content">
            <header>
                <div id="header-container">
                    <div id="login_form_container">
                        @if(Auth::check())
                            <p>
                                {{ HTML::Link('user/logout', 'Logout (' . Auth::user()->name .')') }}
                            </p>
                        @else
                            {{ Form::open(['url' => 'login']) }} 
                                <div>
                                    {{ Form::label('name', 'Username: ') }}
                                    {{ Form::text('name') }}
                                </div>
                                <div>
                                    {{ Form::label('password', 'Password: ') }}
                                    {{ Form::password('password') }}
                                </div>
                                <div>
                                    {{ Form::checkbox('remember') }}
                                    {{ Form::label('remember', 'Remember: ') }}                                
                                </div>
                                <div>
                                    {{ Form::submit('Login')}}
                                </div>
                            {{ Form::close()}} 
                        @endif
                    </div>

                    <div id="logo-container">

                            <a href="/">
                                {{ HTML::image('images/welcome.png','Logo')}}
                            </a>

                    </div>
                
                    <nav>
                        <ul id="main-nav-list" class="nav-list">
                            <li>
                                {{ HTML::Link('/', 'Home Page') }}
                            </li>
                            @if(Auth::check())
                                <li>
                                    {{ HTML::Link('post/create', 'Create New Post') }}
                                </li>
                                <li>
                                    {{ HTML::Link('post', 'View all posts') }}
                                </li>
                            @else
                                <li>
                                    {{ HTML::Link('user/create', 'Create your blog') }}
                                </li>
                            @endif

                        </ul>
                    </nav>
                </div>
            </header>
            <div class="wrapper">
                <div id="sidebar">

                    @include('sidebar')

                </div>
                <div class="section">

                    <div>
                        @if(Session::has('error'))
                        <h3 class="error"> {{ Session::get('error') }} </h3>
                        @elseif(Session::has('correct'))
                            <h3 class="correct"> {{ Session::get('correct') }} </h3>
                        @endif
                    </div>
                    <section>
                        @yield('content')
                    </section>
                </div>

            </div>
        </div>
    </body>
</html>
