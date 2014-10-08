<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getLogin()
	{
	    return View::make('users.login');
	}
        
        public function postLogin()
	{
            $validator = Validator::make(Input::all(), array(
            'name' => 'required',
            'password' => 'required'
            ));
            $message = 'Невалидено потребителско име или парола';
            if($validator->fails())
            {
                    return Redirect::to('login')->withInput()->with('error', $message);
            }
            else
            {
                $user = array(
                    'name'=>Input::get('name'),
                    'password'=>Input::get('password'),
                );
                $username = ucwords(Input::get('name'));

                $remember = (Input::has('remember')) ? true : false;

                if(Auth::attempt($user, $remember)){ 
                    return Redirect::to('/post/')->with('correct', "Добре дошъл, $username!");
                } else {
                    return Redirect::to('login')->withInput()->with('error', $message);                
                }
            }
	}
        
        public function logout() {
            $massage = 'Вие сте извън системата!';
            if(Auth::check()){
                Auth::logout();
                return Redirect::to('/')->with('error', $massage);
            } else {
                return Redirect::to('/login')->with('error', $massage);
            }
            
        }
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    return View::make('users.register');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            $data = Input::all();
            
            $validator = User::validate($data);
            
            if ($validator->fails()) {
                return Redirect::to('user/create')->withErrors($validator)->withInput()->with('error', 'Невалидни данни!');
            }
	    User::saveUser($data);
            return Redirect::to('login')->with('correct', 'Регистрацията е успешна! Моля влезте в системата!');
	}

}
