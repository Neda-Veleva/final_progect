<?php

class Comment extends Eloquent {
    
    protected $table = 'comments';
    
    //Validation 
    public static $rules = array(
        'name' => 'required|alpha_dash|min:4',
        'email' => 'required|email',
        'body' => 'required',
    );
    
    public static function validate($data) {
        
        return Validator::make($data, static::$rules);        
    }
    
    //Save new comment
    public static function saveComment($data) {
        $comment = new Comment();
        $comment->name = Input::get('name');
        $comment->email = Input::get('email');
        $comment->body = Input::get('body');
        $comment->post_id = Input::get('post_id');       
        $comment->save();
    }
    
    //Relationship One To Many
    public function post() {
        return $this->belongsTo('Post');
    }
    
    
}