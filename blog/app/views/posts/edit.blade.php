@extends('layouts.master')

@section('head')
    @parent
    <title>Edit post {{ $post->title }}</title>
@stop

@section('content')
{{ Form::model($post, array('method' => 'PUT', 'url' => array('post', $post->id))) }} 
        <div>
            {{ Form::label('title', 'Title: ') }}
            <br />
            @foreach ($errors->get('title') as $error)
                <span>{{ $error }}</span>
                <br />
            @endforeach
            {{ Form::text('title', $post->title) }}                  
        </div>   
        <div>
            {{ Form::label('body', 'Body: ') }}
            <br />
            @if ($errors->get('body'))
                <span>{{ $errors->first('body') }}</span>
                <br />
            @endif
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
            {{ Form::text('tags', $outputTags) }}
        </div>
        {{ Form::hidden('id', $post->id) }}
        {{ Form::submit('Edit') }}
    {{ Form::close()}} 
@stop