<?php

class PostController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{            
            $user_id = Auth::user()->id;
            return View::make('posts.index')->with('posts', Post::page($user_id));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            return View::make('posts.create');
	}


	/**
	 * Store a newly created resource in storage.
	 * 
	 * @return Response
	 */
	public function store()
	{
            $data = Input::all();
            $post = new Post;
            $validator = Post::validate($data);
                    
            if($validator->fails()){
                return Redirect::to('/post/create')->withErrors($validator)->withInput();
            } else {
                Post::savePost($data);                                    
            }
            return Redirect::to('/post/')->with('correct', 'Записът е успешен!');
	}

        
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{           
            $post = Post::find($id);
            
            return View::make('posts.show')->with('post', $post);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
            $post = Post::find($id);
                        
            foreach($post->tags as $tag){
                $tagNames[] = $tag->tag_name;
            }
            $outputTags = implode(', ', $tagNames);
            
            return View::make('posts.edit')->with('post', $post)->with('outputTags', $outputTags);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
            $rules = array(
                'title' => 'required|min:6',
                'body' => 'required',
            );
	    $data = Input::all();
            $validator = Validator::make($data, $rules); 
                    
            if($validator->fails()){
                return Redirect::to("/post/{$id}/edit")->withErrors($validator)->withInput()->with('error', 'Некоректно въведени данни!');
            } else {
                
                Post::updatePost($data);
            }
            return Redirect::to('/post/')->with('correct', 'Обновяването е успешно!');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
            Post::find(Input::get('id'))->delete();
            return Redirect::to('/post/')->with('error', 'Успешно изтриване!');
	}


}
