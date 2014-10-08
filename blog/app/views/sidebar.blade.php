<aside>
    @if(Auth::check()) 
        <?php $user_id = Auth::user()->id; ?>
    @else 
        <?php $user_id = 1; ?>
    @endif
    <ul>
        <li>
            <h2>Searching in blog</h2>
            <div>
                {{ Form::open(array('url' => 'search')) }}
                       {{ Form::text('search') }} {{ Form::submit('Search') }} 
                {{ Form::close() }}
            </div>
        </li>
        <li>
            <h2>Searching by tag</h2>
            <div>
                {{ Form::open(array('url' => 'tag/{id}')) }}
                    <select name="tagSearch">
                        <option value="0">Searching by tags</option>
                        @foreach($tags as $tag)
                            @foreach($tag->posts as $post)
                                @if($post->user_id == $user_id)
                                    <option value="{{$tag->id}}">
                                        {{$tag->tag_name}}
                                    </option>
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                {{ Form::submit('Search') }}
                {{ Form::close() }}
            </div>
        </li>
        <li>
            <h2>Recent Posts</h2>
            <ul>
                @if(!$recentPosts->count())
                    <li>No posts</li>        
                @else
                    @foreach($recentPosts as $post)
                    <li>
                        {{ HTML::Link("post/{$post->id}", e($post->title), array($post->id)) }} 
                        <hr />
                    </li>
                    @endforeach 
                @endif
            </ul>
        </li>
        <li>
            <h2>Recent Comments</h2>
            <ul>
                @if(!$recentComments->count())
                    <li>No comments</li>        
                @else
                    @foreach($recentComments as $comment)
                        @if($comment->post->user_id == $user_id)      
                            <li>
                                {{$comment->name}} on

                                {{ HTML::Link("post/{$comment->post_id}", e($comment->post->title), array($comment->post_id)) }}: 
                                {{ e(substr($comment->body, 0, 50).' ...') }}
                                <hr />
                            </li>                        
                        @endif
                    @endforeach
                @endif
            </ul>
        </li>
        <li>
            <h2>Archives</h2>
            <ul>
                @if(!$posts_by_year->count())
                    <li>No archives</li>        
                @else
                    @foreach($posts_by_year as $date => $posts)
                        <li>
                            <a href="#">{{ $date }} ({{count($posts)}})</a>
                            
                            <ul class="archive">
                            @foreach ($posts as $post)
                                <li>
                                    {{ HTML::Link("post/{$post->id}", $post->title, array($post->id)) }}
                                    <hr />
                                </li>
                            @endforeach
                            </ul>
                        </li>
                    @endforeach
                @endif
            </ul>
        </li>
        <li>
            <h2>Tags</h2>
            <div>
                @if(!$tags->count())
                    <li>No tags</li>        
                @else
                <li class="tags">
                    @foreach($tags as $tag)
                        @foreach($tag->posts as $post)
                            @if($post->user_id == $user_id)
                               <span>    
                                  {{ HTML::Link("tag/{$tag->id}", $tag->tag_name, array($tag->id)) }}                             
                              </span>
                            @endif
                        @endforeach
                    @endforeach
                </li> 
                @endif
            </div>
        </li>
    </ul>

</aside>