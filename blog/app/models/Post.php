<?php

class Post extends Eloquent {
    
    protected $table = 'posts';
    protected $comments;
    protected $tags;


    //Relationship One To Many
    public function user() {
        return $this->belongsTo('User');
    }
    
    //Relationship One To Many
    public function comments() {
        return $this->hasMany('Comment');
    }    
    
    //Relationship Many To Many
    public function tags() {
        return $this->belongsToMany('Tag');
    }
    
    //Validation 
    public static $rules = array(
        'title' => 'required|min:6',
        'body' => 'required',
        'tags' => 'required',
    );
    
    
    public static function validate($data) {
        
        return Validator::make($data, static::$rules);        
    }
    
    //Save new post and tags
    public static function savePost($data) {

        $post = new Post;
        $post->user_id = Auth::user()->id;
        $post->title = ucwords(Input::get('title'));
        $post->body  = Input::get('body');

        if ($post->save()) {
            $input = Input::get('tags');
            $keyWords = array_map('trim',explode(',', $input));
            foreach($keyWords as $word) {
                $updateTag = Tag::where('tag_name', '=', $word)->get();

                if($updateTag->count()) {
                        foreach ($updateTag as $tag) {
                        $id = $tag->id;
                        $save = Tag::find($id);                                    
                    }
                }
                else {
                    $save = Tag::create(array('tag_name' => $word));
                }
                $post->tags()->attach($save);
            }
        }
    }
    //Update post
    
    public static function updatePost($data) {
        
        $id = Input::get('id');
        $post = Post::find($id);
        $post->user_id = Auth::user()->id;
        $post->title = ucwords(Input::get('title'));
        $post->body  = Input::get('body');

        if ($post->save()) {
            $input = Input::get('tags');
            $keyWords = array_map('trim',explode(',', $input));
            foreach($keyWords as $word) {
                $updateTag = Tag::where('tag_name', '=', $word)->get();

                if($updateTag->count()) {
                        foreach ($updateTag as $tag) {
                        $id = $tag->id;
                        $update = Tag::find($id);                                    
                    }
                }
                else {
                    $update = Tag::create(array('tag_name' => $word));
                }
                $post->tags()->attach($update);
            }
        }
    }
    
    
    //Pagination
    public static function page($user_id = 1) {         
        return static::where('user_id', '=', $user_id)->orderBy('created_at', 'DESC')->paginate(5);
    }
}
