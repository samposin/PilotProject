<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class UsersController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | User Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles displaying user list, storing new user
    | in database, displaying single user detail, updating existing user
    | and deleting of user.
	|
	| Also handles checking availability of provided user email or username.
    |
    */

	public function __construct()
	{

	}


	/**
	 * Display user list page with add user form
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function index()
    {
		//getting user list which has active=1
        $query = User::active();
        $query->orderBy('username', 'asc');
        $users=$query->get();

		return view('pages.admin.users.index',compact('users'));

    }


	/**
	 * This function checks the username provided if it is available or not
	 *
	 * @param Request $request
	 *
	 * @return mixed
	 */

	public function postCheckUsernameAvailability(Request $request)
	{
	    $count = User::where('username', $request->get('username'))->count();

        if($count) {
            return Response::json(array('msg' => 'true'));
        }

        return Response::json(array('msg' => 'false'));

    }


	/**
	 * This function checks the email provided if it is available or not
	 *
	 * @param Request $request
	 *
	 * @return mixed
	 */

	public function postCheckEmailAvailability(Request $request)
	{
	    $query = User::where('email', $request->get('email'));
	    if($request->has('user_id'))
	        $query->where('id','!=',$request->get('user_id'));

		$count=$query->count();

        if($count) {
            return Response::json(array('msg' => 'true'));
        }

        return Response::json(array('msg' => 'false'));

    }


	/**
	 * This function validates and inserts new user information into db
	 *
	 * @param Request $request
	 *
	 * @return mixed
	 */
	public function store(Request $request)
    {
		//validation messages
		$messages = [
            'username.required'  => 'Please provide username.',
            'username.unique'  => 'This username has already been taken.',
            'firstname.required'  => 'Please provide firstname.',
            'email.required'  => 'Please provide email.',
            'email.unique'  => 'This email has already been taken.',

        ];

		//Validate posted values
		//bail rule - to stop running validation rules on an attribute after the first validation failure.
        $validator = Validator::make($request->all(), [
            'username'  => 'bail|required|min:3|start_alpha_numeric_underscore|unique:users|max:50',
			'firstname' => 'bail|required|min:2|alpha_spaces|max:25',
			'lastname'  => 'bail|min:2|alpha_spaces|max:25',
			'email'     => 'bail|required|min:2|email|unique:users|max:50',
			'password'  => 'bail|required|min:6|confirmed'
        ],$messages);

		//if any validation error return json with error if ajax request
		//otherwise redirect with errors
        if ($validator->fails())
        {
            if($request->ajax())
            {
	            return Response::json(array(
			        'success' => false,
			        'errors' => $validator->getMessageBag()->toArray()
			    ), 200); //422
            }

			return Redirect::back()->withErrors($validator)->withInput();

        }

        //get all posted values
        $input = $request->all();

		//setting user info into object for inserting into db.
        $user = new User ();
        $user->username = $request->get('username');
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->email = $request->get('email');
        $user->password = Hash::make ($request->get('password'));
        $user->remember_token = $request->get('_token');
        $user->created_userid=Auth::user()->id;
        $user->created_at=Carbon::now();
        $user->save ();

		//setting successful message in session
		flash('User added successfully.', 'success')->important();

		//return json with success information
		return Response::json(array(
	        'success' => true,
	        'message' => "User added successfully."
	    ), 200);

    }


	/**
	 * Display user edit page
	 *
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function show($id)
    {
		$user = User::find($id);

        if ($user == null)
        {
            Flash::error('That user doesn\'t exist.')->important();
            return Redirect::route('users-home');
        }

        return view('pages.admin.users.detail',compact('user'));

    }


	/**
	 * This function validates and updates user information into db
	 *
	 * @param $id
	 * @param Request $request
	 *
	 * @return array
	 */

	public function update($id, Request $request)
    {
	    $user = User::find($id);

        if ($user == null)
        {
            Flash::error('That user doesn\'t exist.')->important();
            return Redirect::back();
        }

         //get posted values
        $input=$request->except(['username','_token','hdn_user_id']);

		//validation messages
        $messages = [
            'firstname.required'  => 'Please provide firstname.',
            'email.required'  => 'Please provide email.',
            'email.unique'  => 'This email has already been taken.'
        ];

		//Validate posted values
		//bail rule - to stop running validation rules on an attribute after the first validation failure.
        $validator = Validator::make($input, [
			'firstname' => 'bail|required|min:2|alpha_spaces|max:25',
			'lastname'  => 'bail|min:2|alpha_spaces|max:25',
			'email'     => 'bail|required|min:2|email|unique:users,email,'.$id.'|max:50' ,
			'password'  => 'bail|min:6|confirmed'
        ],$messages);

		//if any validation error return json with error if ajax request
		//otherwise redirect with errors
        if ($validator->fails())
        {
            if($request->ajax())
            {
	            return Response::json(array(
			        'success' => false,
			        'errors' => $validator->getMessageBag()->toArray()
			    ), 200); //422
            }

			return redirect()->back()->withErrors($validator)->withInput();

        }

        if($request->has('password'))
        {
            //setting logged in user id and current time for updating user password
            $input['password'] = Hash::make ($request->get('password'));
			$input['password_updated_userid'] = Auth::user()->id;
            $input['password_updated_at'] = Carbon::now();
        }

		//setting logged in user id and current time for updating user detail
        $input['updated_userid'] = Auth::user()->id;
        $input['updated_at'] = Carbon::now();

        // update into db
        $user->fill($input)->save();

        if( $request->ajax())
        {
            return array(
                'success' => true,
            );
        }
        else
        {
            flash()->Success("User updated successfully.")->important();
            return redirect()->back();
        }

    }


	/**
	 * This function update active field as 0 on delete in user table
	 *
	 * @param Request $request
	 *
	 * @return array
	 */

	public function delete(Request $request)
    {

		$id=$request->get('hdn_user_id');

        $user = User::find($id);
        if ($user == null)
        {
            Flash::error('That user doesn\'t exist.')->important();
            return Redirect::route('users-home');
        }

        $input['is_active'] = 0;
        $input['deleted_userid'] = Auth::user()->id;
        $input['deleted_at'] = Carbon::now();

        // update into db
        $user->fill($input)->save();

        if( $request->ajax())
        {
            return array(
                'success' => true,
            );
        }
        else
        {
            flash()->Success("User deleted successfully.")->important();
            return redirect()->back();
        }

    }
}
