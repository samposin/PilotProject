<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class MyAccountController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | MyAccount Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles displaying logged in user information
    | updating logged in user information in database
	|
	| Also handles displaying change password form, updating password
    |
    */

	/**
	 * Display my account page
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function index()
	{

		$user = Auth::user();
		return view('pages.admin.my-account',compact('user'));
	}


	/**
	 * This function validates and updates logged in user detail
	 *
	 * @param Request $request
	 *
	 * @return $this|array|\Illuminate\Http\RedirectResponse
	 */

	public function update(Request $request)
    {

		$user=Auth::user();

         //get posted values
        $input=$request->except(['username','_token','hdn_user_id']);

		//validation messages
        $messages = [
            'firstname.required'  => 'Please provide firstname.',
            'email.required'  => 'Please provide email.',
            'email.unique'  => 'This email has already been taken.',
        ];

		//Validate posted values
		//bail rule - to stop running validation rules on an attribute after the first validation failure.
        $validator = Validator::make($input, [
			'firstname' => 'bail|required|min:2|alpha_spaces|max:25',
			'lastname'  => 'bail|min:2|alpha_spaces|max:25',
			'email'     => 'bail|required|min:2|email|unique:users,email,'.$user->id.'|max:50'
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
            flash()->Success("Account updated successfully.")->important();
            return redirect()->back();
        }
    }


	/**
	 * This function display change password page
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function changePasswordShow()
	{

		$user = Auth::user();
		return view('pages.admin.change-password',compact('user'));
	}


	/**
	 * This function validates and updates password.
	 *
	 * @param Request $request
	 *
	 * @return $this|array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

	public function changePasswordUpdate(Request $request)
    {

		$user=Auth::user();

         //get posted values
        $input=$request->except(['username','_token','hdn_user_id']);

        $messages = [

        ];

		//Validate posted values
		//bail rule - to stop running validation rules on an attribute after the first validation failure.
        $validator = Validator::make($input, [
			"current_password"=>"min:6|old_password",
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
            flash()->Success("Password changed successfully.")->important();
            return redirect('admin/my-account');
        }
    }
}