<?php

namespace App\Helpers;

use Carbon\Carbon;
use DateTime;
use Exception;

class DateHelper {

	/*
    |--------------------------------------------------------------------------
    | DateHelper
    |--------------------------------------------------------------------------
    |
    | This class contains helper functions for dates
    |
    */

	/**
	 * This function converts date  into date with 'm/d/y' format
	 *
	 * @param $date
	 *
	 * @return string
	 */

	public static function dateFormat1($date) {
        if ($date) {
            $dt = new DateTime($date);
            return $dt->format("m/d/y"); // 10/27/2014
        }
    }


	/**
	 * This function converts date with given format into carbon date object
	 *
	 * @param string $date
	 * @param string $format
	 *
	 * @return null|carbon date object
	 */

	public static function dateStringToCarbon($date, $format = 'm/d/Y')
    {
        if(!$date instanceof Carbon) {
            $validDate = false;
            try
            {
                $date = Carbon::createFromFormat($format, $date);
                $validDate = true;

            } catch(Exception $e) { }

            if(!$validDate) {
                try
                {
                    $date = Carbon::parse($date);
                    $validDate = true;

                } catch(Exception $e) { }
            }

            if(!$validDate) {
                $date = NULL;
            }
        }
        return $date;
    }


	/**
	 * This function converts date with given format into database date format i.e 'Y-m-d'
	 *
	 * @param string $date
	 * @param string $format
	 *
	 * @return null|string
	 */

	public static function dateStringToDbFormat($date, $format = 'm/d/Y')
    {
        if(!$date instanceof Carbon)
        {
            $validDate = false;
            try
            {
                $date_carbon_obj = Carbon::createFromFormat($format, $date);
                $date=$date_carbon_obj->format('Y-m-d');
                $validDate = true;

            } catch(Exception $e) { }

            if(!$validDate) {
                try
                {
                    $date_carbon_obj = Carbon::parse($date);
                    $date=$date_carbon_obj->format('Y-m-d');
                    $validDate = true;

                } catch(Exception $e) { }
            }

            if(!$validDate) {
                $date = NULL;
            }
        }
        return $date;
    }
    

	/**
	 * A helper function to determine if date input is valid or not
	 *
	 * @param $date
	 * @param string $format
	 *
	 * @return bool
	 */

	public static function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

}