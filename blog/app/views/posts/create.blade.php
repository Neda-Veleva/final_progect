@extends('layouts.master')

@section('head')
    @parent
    <title>Create New Post</title>
@stop

@section('content')
    {{ Form::open(['url' => '/post']) }} 
        <div>
            @foreach ($errors->get('title') as $error)
                <span class="error">{{ $error }}</span>
            @endforeach
            <br/>
            {{ Form::label('title', 'Title: ') }}
            <br/>
            {{ Form::text('title', Input::old('title')) }}                  
        </div>   
        <div>
            @if ($errors->get('body'))
                <span class="error">{{ $errors->first('body') }}</span>                
            @endif
            <br/>
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
            @if ($errors->get('tags'))
                <span class="error">{{ $errors->first('tags') }}</span>                
            @endif
            <br/>   
            {{ Form::label('tags', 'Tags: ') }}
            <br/>
            {{ Form::text('tags', '', array('placeholder' => 'Enter your tags seperated by commas...'), Input::old('tags')) }}
        </div>
        <br/>
        {{ Form::submit('Create ')}}
    {{ Form::close()}} 
@stop