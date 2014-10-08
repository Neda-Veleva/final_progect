@extends('layouts.master')

@section('head')
    @parent
    <title>{{ $post->title }}</title>
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
    @if(Auth::check())
        {{ Form::open(['url' => "/post/{$post->id}/comment"]) }} 
            <div>
                @foreach ($errors->get('name') as $error)
                    <span class="error">{{ $error }}</span>
                @endforeach
                <br />
                {{ Form::label('name', 'Name: ') }}            
                {{ Form::text('name', $post->user->name) }}                  
            </div>   
            <div>
                @foreach ($errors->get('email') as $error)
                    <span class="error">{{ $error }}</span>                
                @endforeach
                <br />
                {{ Form::label('email', 'Email: ') }}
                {{ Form::text('email', $post->user->email) }}                  
            </div> 
            <div>
                @if ($errors->get('body'))
                <span class="error">{{ $errors->first('body') }}</span>
                @endif
                <br/>
                {{ Form::label('body', 'Body: ') }}
                <br />
                {{ Form::textarea('body', Input::old('body')) }}            
            </div>
            <br/>
            {{ Form::hidden('post_id', $post->id) }}
            {{ Form::submit('Submit Comment')}}
        {{ Form::close()}} 
    
    @else
        {{ Form::open(['url' => "/post/{$post->id}/comment"]) }} 
            <div>
                @foreach ($errors->get('name') as $error)
                    <span class="error">{{ $error }}</span>
                @endforeach
                <br />
                {{ Form::label('name', 'Name: ') }} 
                <br />
                {{ Form::text('name', Input::old('name')) }}                  
            </div>   
            <div>
                @foreach ($errors->get('email') as $error)
                    <span class="error">{{ $error }}</span>                
                @endforeach
                <br />
                {{ Form::label('email', 'Email: ') }}
                <br />
                {{ Form::text('email', Input::old('email')) }}                  
            </div> 
            <div>
                @if ($errors->get('body'))
                <span class="error">{{ $errors->first('body') }}</span>
                @endif
                <br/>
                {{ Form::label('body', 'Body: ') }}
                <br />
                {{ Form::textarea('body', Input::old('body')) }}            
            </div>
            <br/>
            {{ Form::hidden('post_id', $post->id) }}
            {{ Form::submit('Submit Comment')}}
        {{ Form::close()}} 
    @endif

</div>

<!-- Display comments-->
<div>
    @if($post->comments->count() <= 0)
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