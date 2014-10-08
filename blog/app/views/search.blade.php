@extends('layouts.master')

@section('head')
    @parent
    <title>Search Page</title>
@stop

@section('content')

@if($results->count())
    <p>Hамерени резултати: {{$results->count()}}</p>
    <ul>
    @foreach($results as $result)
    
    <article>
        <header>
            <h2>
                {{HTML::Link("post/{$result->id}", e($result->title), array($result->id)) }}
            </h2>
        </header>                    
            <p>
                {{ substr($result->body, 0, 300). ' [...]' }}

            </p>  
            <p>
                {{HTML::Link("post/{$result->id}", 'Read more &rarr;', array($result->id))}} 
            </p>
        <footer>
            <p>
                published by
                <a href="#">{{ $result->user->name }}</a> 
                <br/>
                on <time>{{ $result->created_at->format('l jS \\of F Y') }}</time> 
                <br/>
                <span>{{ $result->comments->count() }} {{ Str::plural("Comment", count($result->comments)) }}</span>
            </p>
        </footer>
    </article>
    @endforeach
    </ul>
@else 
    <p>Съжаляваме, но няма намерени резултати за Вашето търсене: 
        <br/>
        {{$search}}</p>
    {{ Form::open(array('url' => 'search')) }}
        {{ Form::label('search', 'Search: ') }} 
        {{ Form::text('search') }} 
        {{ Form::submit('Search') }} 
    {{ Form::close() }}
@endif
@stop