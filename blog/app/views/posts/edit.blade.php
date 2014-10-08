@extends('layouts.master')

@section('head')
    @parent
    <title>Edit Post {{ $post->title }}</title>
@stop

@section('content')
<h2>Edit Post</h2>
    <div>
        @if($errors->has())
        <ul>
            @foreach ($errors->all() as $error)
            <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
        @endif
    </div>
{{ Form::model($post, array('method' => 'PUT', 'url' => array('post', $post->id))) }} 
        <div>
            {{ Form::label('title', 'Title: ') }}
            <br />
            {{ Form::text('title', $post->title) }}                  
        </div>   
        <div>
            {{ Form::label('body', 'Body: ') }}
            <br />
            {{ Form::textarea('body', $post->body, array('id' => 'editor1')) }}
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
            <br />
            {{ Form::text('tags', '', array('placeholder' => 'Enter your tags seperated by commas...')) }}
        </div>
        {{ Form::hidden('id', $post->id) }}
        {{ Form::submit('Edit') }}
    {{ Form::close()}} 
@stop