<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{                
            if(Auth::check()) {
                $user_id = Auth::user()->id;                
            } else {
                $user_id = 1;
            }
		return View::make('index')->with('posts', Post::page($user_id));
	}
        
        public function sidebarSearch() {
            $search = Input::get('search');           
            $results = Post::where('body', 'LIKE', '%'.$search.'%')->get();
            return View::make('search')->with('results', $results)->with('search', $search);
        }
        
        public function searchByTags() {   
            $input = Input::get('tagSearch');
            if($input > 0){
                $tag = Tag::find($input);
                return View::make('tag')->with('tag', $tag);
            } else {
                $tag = Tag::find(1);
                return View::make('tag')->with('tag', $tag);;
            }
            
        }
        
        public function showTags($id) {
            $tag = Tag::find($id);
            return View::make('tag')->with('tag', $tag);
        }
        
}
