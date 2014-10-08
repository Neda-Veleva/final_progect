@extends('layouts.master')

@section('head')
    @parent
    <title>{{ $post->title }} Page</title>
@stop

@section('content')
<article>
    <header>
        <h2>
            {{ e($post->title) }}
        </h2>
    </header>        
        <p>
        published by {{ ucwords($post->user->name) }} before 
        {{ $post->created_at->diffForHumans() }}
        </p>
        <br />
        <p>
            {{ $post->body }}
        </p>  
    <footer>
        <p>            
            {{ Str::plural("Tag", count($post->tags)) }}:                        
            @foreach($post->tags as $tag)
                {{ HTML::Link("tag/{$tag->id}", $tag->tag_name, array($tag->id)) }}
            @endforeach
        </p>
    </footer>
</article>

<!-- Display form comments-->

<div>
    <h2>Leave a Comment</h2>
    <div>
        @if($errors->has())
        <ul>
            @foreach ($errors->all() as $error)
            <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
        @endif
    </div>
    
        {{ Form::open(['url' => "/post/{$post->id}/comment"]) }} 
        @if(Auth::check())
            <div>
                {{ Form::label('name', 'Name: ') }}     
                <br/>
                {{ Form::text('name', $post->user->name) }}                  
            </div>   
            <div>
                {{ Form::label('email', 'Email: ') }}
                <br/>
                {{ Form::text('email', $post->user->email) }}                  
            </div> 
        @else
            <div>
                {{ Form::label('name', 'Name: ') }} 
                <br />
                {{ Form::text('name', Input::old('name')) }}                  
            </div>
            <div>
                {{ Form::label('email', 'Email: ') }}
                <br />
                {{ Form::text('email', Input::old('email')) }}                  
            </div> 
        @endif
            <div>
                {{ Form::label('body', 'Body: ') }}
                <br />
                {{ Form::textarea('body', Input::old('body')) }}            
            </div>
            <br/>
            {{ Form::hidden('post_id', $post->id) }}
            {{ Form::submit('Submit Comment')}}
        {{ Form::close()}}     

</div>

<!-- Display comments-->
<div>
    @if(!$post->comments->count())
        <h2>No comments</h2>        
    @else
        <h2>{{ $post->comments->count() }} {{ Str::plural("Comment", count($post->comments)) }}:</h2>
        <ul>
            @foreach($post->comments as $comment)
            <li>
                
                <article>
                    <header>
                        <h2>
                            {{ e($comment->name) }}
                        </h2>
                       
                    </header> 
                        <p>
                            published before {{ $comment->created_at->diffForHumans() }} 
                        </p>
                        <br />
                        <p>
                            {{ e( $comment->body) }}
                        </p>  
                </article>
                
            </li>
                
            @endforeach
        </ul>
    @endif
</div>

@stop