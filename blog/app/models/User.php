<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
        
        //Relationship one to many
        public function posts() {
            return $this->hasMany('Post');
        }    
        
        //Validation 
        public static $rules = array(
            'name' => 'required|unique:users|alpha_dash|min:4',
            'email' => 'required|email',
            'password' => 'required|alpha_num|between:6,10',
            'confirm_password' => 'same:password'
        );


        public static function validate($data) {

            return Validator::make($data, static::$rules);        
        }

        
        public static function saveUser($data) {
        $user = new User;
        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $user->password = Hash::make(Input::get('password'));
        $user->save();
    }

}
