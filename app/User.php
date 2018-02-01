<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{

	protected $appends = array('name','last_logged_in_at_display');


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'username',
        'email',
        'password',
        'firstname',
        'lastname',
        'is_active',
        'created_userid',
        'updated_userid',
        'password_updated_userid',
        'deleted_userid',
		'password_updated_at',
        'deleted_at'

    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];


	/**
	 * Setting condition in query where active=1
	 *
	 * @param $query
	 *
	 * @return mixed
	 */

	public function scopeActive($query) {
        return $query->where('is_active', 1);
    }


	/**
	 * This function gives full name value in string format to display in user detail
	 *
	 * @return mixed|string
	 */

	public function getNameAttribute()
	{
	    $name=$this->firstname;
	    if($this->lastname!=null)
	        $name=$this->lastname .", ".$name;

	    return $name;
	}


	/**
	 * This function gives last activity time in string format to display in user detail
	 *
	 * @return string
	 */

	public function getLastLoggedInAtDisplayAttribute()
	{

		return $this->getLastSessionActivityTime();

	}


	/**
	 * This function gives last activity time in html format to display in user detail
	 *
	 * @return string
	 */

	public function getLastLoggedInAtDisplayHtmlAttribute()
	{

		$last_session_activity_time=$this->getLastSessionActivityTime();

		if($last_session_activity_time=='Currently logged in')
		{
			return "<span class='label label-success'>".$last_session_activity_time."</span>";
		}
		else if($last_session_activity_time=='N/A')
		{
			return "<span class='label label-warning'>".$last_session_activity_time."</span>";
		}
		else
		{
			return "<span class='label label-info'>".$last_session_activity_time."</span>";
		}

	}


	/**
	 * Setting condition in query for searching firstname or lastname
	 *
	 * @param $query
	 * @param $name
	 *
	 * @return mixed
	 */

	public function scopeSearchFirstNameLastName($query, $name)
	{

		$searchValues = preg_split('/\s+/', $name); // split on 1+ whitespace

		$final_query=$query->where(function ($q) use ($searchValues) {

			foreach ($searchValues as $value) {

				$q->orWhere('firstname', 'like', "%{$value}%");
				$q->orWhere('lastname', 'like', "%{$value}%");

			}
		});

		return $final_query;
	}


	/**
	 * This function checks in cache if there is entry for last activity of current user
	 *
	 * @return mixed
	 */

	public function isOnline()
	{
	    return Cache::has('user-is-online-' . $this->id);
	}


	/**
	 * This function gives last user activity by checking in cache,
	 * gives last logged in time from db if not available.
	 *
	 * @return string
	 */

	public function getLastSessionActivityTime()
	{
		if($this->isOnline())
		{
			return "Currently logged in";
		}

		if(Cache::has('last_session_activity_time_' . $this->id))
		{

			$last_session_activity_time=Cache::get('last_session_activity_time_' . $this->id);

			if($last_session_activity_time == date("Y-m-d H:i:s", strtotime($last_session_activity_time)))
			{
				$last_session_activity_time_carbon_obj = Carbon::createFromFormat('Y-m-d H:i:s', $last_session_activity_time);
				return $last_session_activity_time_carbon_obj->diffForHumans();
			}

		}

		if($this->last_logged_in_at!=null)
		{
			$last_logged_in_time=$this->last_logged_in_at;

			if($last_logged_in_time == date("Y-m-d H:i:s", strtotime($last_logged_in_time)))
			{
				$last_logged_in_time_carbon_obj = Carbon::createFromFormat('Y-m-d H:i:s', $last_logged_in_time);
				return $last_logged_in_time_carbon_obj->diffForHumans();
			}
		}

	    return "N/A";

	}
}
