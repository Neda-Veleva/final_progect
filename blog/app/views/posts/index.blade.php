@extends('layouts.master')

@section('head')
    @parent
    <title>View All Posts</title>
@stop

@section('content')

<div>
    @if($posts->count())
        <h1>These are your current posts</h1>
        {{ $posts->links() }}
        <table>
            <thead>
                <tr>
                    <th>View Post</th>
                    <th>Edit Post</th>
                    <th>Delete Post</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>
                            {{HTML::Link("post/{$post->id}", $post->title, array($post->id)) }}
                        </td>
                        
                        <td>
                            {{ Form::model($post, array('method' => 'PUT', 'url' => array('post', $post->id))) }} 
                                {{ Form::hidden('id', $post->id) }}
                                {{ Form::submit('Edit', array('class' =>  'specialBtn')) }}
                            {{ Form::close() }}
                        </td>
                        <td>
                            {{ Form::model($post, array('method' => 'DELETE', 'url' => array('post', $post->id))) }} 
                                {{ Form::hidden('id', $post->id) }}
                                {{ Form::submit('Delete', array('class' => 'specialBtn')) }}
                            {{ Form::close() }}
                        </td>
                        <td>
                            {{ $post->created_at->format('jS \\of F Y') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        {{ $posts->links() }}
    @else
        <h1>You currently have no posts</h1>
    @endif
</div>


@stop