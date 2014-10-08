@extends('layouts.master')

@section('head')
    @parent
    <title>Login in your blog</title>
@stop

@section('content')
    <div>
    @if($errors->has())    
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
    </div>
    <div id="login_form_container">
        <h2>Login Form</h2>  
    {{ Form::open(['url' => 'login']) }} 
        <div>
            {{ Form::label('name', 'Username: ') }}
            {{ Form::text('name', Input::old('name')) }}
        </div>    
            {{ Form::label('password', 'Password: ') }}
            {{ Form::password('password') }}
        <div>
            {{ Form::checkbox('remember') }}
            {{ Form::label('remember', 'Remember: ') }}                                
        </div>
        <div>
            {{ Form::submit('Login')}}
        </div>
    {{ Form::close()}} 
    </div>
@stop