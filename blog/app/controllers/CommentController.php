<?php

class CommentController extends \BaseController {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{         
            $data = Input::all();
            $post_id = Input::get('post_id');
            
            $validator = Comment::validate($data);
                    
            if($validator->fails()){
                return Redirect::to("/post/{$post_id}")->withErrors($validator)->withInput();
            } else {
                Comment::saveComment($data);
                
            }
            return Redirect::to("/post/{$post_id}")->with('correct', 'Записът е успешен!');
	}

}
