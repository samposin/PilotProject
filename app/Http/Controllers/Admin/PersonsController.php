<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\DateHelper;
use App\Person;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class PersonsController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | Person Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles displaying person list, storing new person
    | in database, displaying single person detail, updating existing person
    | and deleting of person.
    |
    */

	public function __construct()
    {

    }


	/**
	 * Display Person list page with add person form
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function index()
    {
        //getting person list which has active=1
        $query = Person::active();
        $query->orderBy('id', 'asc');
        $persons=$query->get();

		// getting us states from config/us_states.php file
        $states= \Config::get('us_states');

		return view('pages.admin.persons.index',compact('persons','states'));

    }


	/**
	 * This function validates and inserts new person information into db
	 *
	 * @param Request $request
	 *
	 * @return mixed
	 */

	public function store(Request $request)
    {
		//validation messages
		$messages = [

            'firstname.required'  => 'Please provide firstname.',
            'lastname.required'  => 'Please provide lastname.',
            'gender.required'  => 'Please select gender.',
            'birth_date.required'  => 'Please provide birth date.',
            'street1.required'  => 'Please provide street.',
            'city.required'  => 'Please provide city.',
            'state.required'  => 'Please select state.',
            'zip.required'  => 'Please provide zip.'
        ];

		//Validate posted values
		//bail rule - to stop running validation rules on an attribute after the first validation failure.
        $validator = Validator::make($request->all(), [
			'firstname' => 'bail|required|min:2|alpha_spaces|max:25',
			'lastname'  => 'bail|required|min:2|alpha_spaces|max:25',
			'gender'    => 'bail|required',
			'birth_date'=> 'bail|required|date_format:m-d-Y|before:"now"',
			'email'     => 'bail|min:2|email|max:50',
			'street1'   => 'bail|required',
			'city'      => 'bail|required',
			'state'     => 'bail|required',
			'zip'       => 'bail|required'
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

		//setting birth date into db date format
		$input['birth_date']=DateHelper::dateStringToDbFormat($input['birth_date'],'m-d-Y');
		$input['created_userid']=Auth::user()->id;
        $input['created_at']=Carbon::now();

		// insert into db
		$person= Person::create($input);

		//setting successful message in session
		flash('Person added successfully.', 'success')->important();

		//return json with success information
		return Response::json(array(
	        'success' => true,
	        'message' => "Person added successfully."
	    ), 200);

    }


	/**
	 * Display person edit page
	 *
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function show($id)
    {
		$person = Person::find($id);

        if ($person == null)
        {
            Flash::error('That person doesn\'t exist.')->important();
            return Redirect::route('users-home');
        }

		//saving this person viewed by current user into cache
        $person->saveLastViewedPersonInfoByUser(Auth::user()->id);

		// getting us states from config/us_states.php file
        $states= \Config::get('us_states');

        return view('pages.admin.persons.detail',compact('person','states'));

    }


	/**
	 * This function validates and updates person information into db
	 *
	 * @param $id
	 * @param Request $request
	 *
	 * @return array
	 */

	public function update($id, Request $request)
    {
	    $person = Person::find($id);

        if ($person == null)
        {
            Flash::error('That person doesn\'t exist.')->important();
            return Redirect::back();
        }

         //get posted values
        $input=$request->except(['_token']);

		//validation messages
        $messages = [

            'firstname.required'  => 'Please provide firstname.',
            'lastname.required'  => 'Please provide lastname.',
            'gender.required'  => 'Please select gender.',
            'birth_date.required'  => 'Please provide birth date.',
            'street1.required'  => 'Please provide street.',
            'city.required'  => 'Please provide city.',
            'state.required'  => 'Please select state.',
            'zip.required'  => 'Please provide zip.'
        ];

		//Validate posted values
        //bail rule - to stop running validation rules on an attribute after the first validation failure.
        $validator = Validator::make($request->all(), [
			'firstname' => 'bail|required|min:2|alpha_spaces|max:25',
			'lastname'  => 'bail|required|min:2|alpha_spaces|max:25',
			'gender'    => 'bail|required',
			'birth_date'=> 'bail|required|date_format:m-d-Y|before:"now"',
			'email'     => 'bail|min:2|email|max:50',
			'street1'   => 'bail|required',
			'city'      => 'bail|required',
			'state'     => 'bail|required',
			'zip'       => 'bail|required',
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

		//setting birth date into db date format
		$input['birth_date']=DateHelper::dateStringToDbFormat($input['birth_date'],'m-d-Y');
        $input['updated_userid'] = Auth::user()->id;
        $input['updated_at'] = Carbon::now();

        // update into db
        $person->fill($input)->save();

        if( $request->ajax())
        {
            return array(
                'success' => true,
            );
        }
        else
        {
            flash()->Success("Person updated successfully.")->important();
            return redirect()->back();
        }

    }


	/**
	 * This function update active field as 0 on delete in person table
	 *
	 * @param Request $request
	 *
	 * @return array
	 */

	public function delete(Request $request)
    {

		$id=$request->get('hdn_person_id');

        $person = Person::find($id);
        if ($person == null)
        {
            Flash::error('That person doesn\'t exist.')->important();
            return Redirect::route('persons-home');
        }

        $input['is_active'] = 0;
        $input['deleted_userid'] = Auth::user()->id;
        $input['deleted_at'] = Carbon::now();

        // update into db
        $person->fill($input)->save();

        if( $request->ajax())
        {
            return array(
                'success' => true,
            );
        }
        else
        {
            flash()->Success("Person deleted successfully.")->important();
            return redirect()->back();
        }

    }
}
