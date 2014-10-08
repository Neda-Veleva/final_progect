@extends('layouts.master')

@section('head')
    @parent
    <title>Home Page</title>
@stop


@section('content')

<div>
    @if($posts->count())
        <h1>These are your current posts</h1>
        {{ $posts->links() }}
        @foreach($posts as $post)
            <article>
                <header>
                    <h2>
                        {{HTML::Link("post/{$post->id}", e(ucwords($post->title)), array($post->id)) }}
                    </h2>
                    <p>
                        published by {{ ucwords($post->user->name) }}
                        on {{ $post->created_at->format('l, jS \\of F Y') }}
                    </p>
                </header>
                <br/>
                    <p>                    
                        {{ substr($post->body, 0, 500). ' [...]' }}                    
                        {{HTML::Link("post/{$post->id}", 'Read more &rarr;', array($post->id))}} 
                    
                    <br/>
                    <br/>
                        {{ Str::plural("Tag", count($post->tags)) }}:                        
                        @foreach($post->tags as $tag)
                            {{ HTML::Link("tag/{$tag->id}", $tag->tag_name, array($tag->id)) }}
                        @endforeach
                    </p>
                <footer>
                    <p>
                        {{ $post->comments->count() }} {{ Str::plural("Comment", count($post->comments)) }}                        
                    </p>                    
                </footer>
            </article>
            <hr />
        @endforeach
        {{ $posts->links() }}
    @else
        <h1>You currently have no posts</h1>
    @endif
</div>
@stop