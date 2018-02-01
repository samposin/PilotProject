<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class ValidatorExtended extends Validator
{

	/*
    |--------------------------------------------------------------------------
    | ValidatorExtended Service
    |--------------------------------------------------------------------------
    |
    | This service used to extend laravel validator with custom rules
    |
    */


	//default custom messages for rules

	private $_custom_messages = array(
		"alpha_dash_spaces" => "The :attribute may only contain letters, spaces, and dashes.",
		"alpha_num_spaces" => "The :attribute may only contain letters, numbers, and spaces.",
		"alpha_spaces" =>"The :attribute may only contain letters and spaces.",
		"start_alpha_numeric_underscore" =>"The :attribute must start with letter and only contain letters, numbers and underscore.",
		"old_password" =>"The password you entered doesn't match the :attribute."
	);


	public function __construct( $translator, $data, $rules, $messages = array(), $customAttributes = array() ) {
		parent::__construct( $translator, $data, $rules, $messages, $customAttributes );

		$this->_set_custom_stuff();
	}


	/**
	 * Setup any customizations etc
	 *
	 * @return void
	 */

	protected function _set_custom_stuff() {
		//setup our custom error messages
		$this->setCustomMessages( $this->_custom_messages );
	}


	/**
	 * Allow only alphabets, spaces and dashes (hyphens and underscores)
	 *
	 * @param string $attribute
	 * @param mixed $value
	 * @return bool
	 */

	protected function validateAlphaDashSpaces( $attribute, $value ) {
		return (bool) preg_match( "/^[A-Za-z\s-_]+$/", $value );
	}


	/**
	 * Allow only alphabets, numbers, and spaces
	 *
	 * @param string $attribute
	 * @param mixed $value
	 * @return bool
	 */

	protected function validateAlphaNumSpaces( $attribute, $value ) {
		return (bool) preg_match( "/^[A-Za-z0-9\s]+$/", $value );
	}


	/**
	 * Allow only alphabets and spaces
	 *
	 * @param $attribute
	 * @param $value
	 *
	 * @return bool
	 */

	protected function validateAlphaSpaces( $attribute, $value ) {
	    return (bool) preg_match('/^[\pL\s]+$/u', $value);
	}


	/**
	 * Allow only starting with alphabets and alphabets, numbers and underscore
	 *
	 * @param $attribute
	 * @param $value
	 *
	 * @return bool
	 */

	protected function validateStartAlphaNumericUnderscore( $attribute, $value ) {
	    return (bool) preg_match('/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/', $value);
	}


	/**
	 * Check user old password in db
	 *
	 * @param $attribute
	 * @param $value
	 *
	 * @return bool
	 */

	protected function validateOldPassword( $attribute, $value ) {
	    return Hash::check($value, Auth::user()->password);
	}

}