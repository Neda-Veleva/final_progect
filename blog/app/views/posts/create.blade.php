@extends('layouts.master')

@section('head')
    @parent
    <title>Create New Post</title>
@stop

@section('content')
    <h2>Create Post</h2>
        <div>
            @if($errors->has())
            <ul>
                @foreach ($errors->all() as $error)
                <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
            @endif
        </div>
    {{ Form::open(['url' => '/post']) }} 
        <div>
            {{ Form::label('title', 'Title: ') }}
            <br/>
            {{ Form::text('title', Input::old('title')) }}                  
        </div>   
        <div>
            <div>
            {{ Form::label('body', 'Body: ') }} 
            </div>
            {{ Form::textarea('body', '', array('id' => 'editor1'), Input::old('body')) }}
            
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' , {
                    language: 'bg',
                    uiColor: '#9AB8F3'
                });
                CKEDITOR.config.width = 600;                
            </script>  
            
        </div>
        <div>
            {{ Form::label('tags', 'Tags: ') }}
            <br/>
            {{ Form::text('tags', '', array('placeholder' => 'Enter your tags seperated by commas...'), Input::old('tags')) }}
        </div>
        <br/>
        {{ Form::submit('Create ')}}
    {{ Form::close()}} 
@stop