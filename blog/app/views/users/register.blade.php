@extends('layouts.master')

@section('head')
    @parent
    <title>Create Your Blog</title>
@stop

@section('content')
    <div>
    @if($errors->has())
    <ul>
        @foreach ($errors->all() as $error)
        <li class="error">{{ $error }}</li>
        @endforeach
    </ul>
    @endif
    </div>
<h2>Registration Form</h2>
    <div id="register_form_container">
    {{ Form::open(['url' => '/user']) }} 
        <div>
            {{ Form::label('name', 'Username: ') }}
            {{ Form::text('name', Input::old('name')) }}
        </div>
        <div>
            {{ Form::label('emai', 'Email: ') }}
            {{ Form::email('email', Input::old('email')) }}
        </div>
        <div>
            {{ Form::label('password', 'Password: ') }}
            {{ Form::password('password') }}
        </div>
        <div>
            {{ Form::label('password', 'Confirm password: ') }}
            {{ Form::password('confirm_password') }}
        </div>
        <div>
            {{ Form::submit('Register')}}
        </div>
    {{ Form::close()}} 
    </div>
@stop