<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

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

	/**
	 * This function is taking the userId 
	 * and updating the user's last login time.
	 */
	public function updateLastLoggedIn($userId)
	{
		// set the default time zone, hard coded for now.
		date_default_timezone_set('Asia/Kolkata');
		
		DB::table('users')->where('id', $userId)->update(array(
			'last_login' => date('Y-m-d h:m:s', time())
		));
	}

}
