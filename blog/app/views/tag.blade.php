@extends('layouts.master')

@section('head')
    @parent
    <title>Tag Page</title>
@stop

@section('content')
<h1>Tag: {{$tag->tag_name}}</h1>

@foreach($tag->posts as $post)

<article>
    <header>
        {{HTML::Link("post/{$post->id}", e($post->title), array($post->id)) }}
    </header>
    <p>
        {{ substr($post->body, 0, 1000). ' [...]' }}
    </p>  
    <p>
        {{HTML::Link("post/{$post->id}", 'Read more &rarr;', array($post->id))}} 
    </p>
    <footer>
        <p>
            published by {{ ucwords($post->user->name) }}
            <br/>
            on {{ $post->created_at->format('l jS \\of F Y') }}
            <br/>
            {{ $post->comments->count() }} {{ Str::plural("Comment", count($post->comments)) }}
        </p>
    </footer>
</article>

@endforeach

@stop