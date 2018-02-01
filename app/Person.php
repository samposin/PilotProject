<?php

namespace App;

use App\Helpers\DateHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Person extends Model
{

    protected $table = 'persons';


	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable=[
        'prefix',
        'firstname',
        'middlename',
        'lastname',
        'suffix',
        'email',
        'nickname',
        'pronounced',
        'gender',
        'birth_date',
        'street1',
        'street2',
        'city',
        'state',
        'county',
        'zip',
        'zip_ext',
        'phone1',
        'phone1_ext',
        'phone1_type',
        'phone2',
        'phone2_ext',
        'phone2_type',
        'phone3',
        'phone3_ext',
        'phone3_type',
        'image',
        'is_active',
        'created_userid',
        'updated_userid',
        'deleted_userid',
        'deleted_at'
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
	 * This function gives complete address in string format to display in person detail
	 *
	 * @return string
	 */

	public function getAddressDisplayAttribute()
	{
		$address="";

	    if($this->street1!=null)
	        $address.=$this->street1;

		if($this->street2!=null)
	        $address.=' '.$this->street2;

		if($this->city!=null)
	        $address.=' '.$this->city;

		if($this->state!=null)
	        $address.=' '.$this->state;

		if($this->zip!=null)
	        $address.=' '.$this->zip;

		if($this->zip_ext!=null)
	        $address.=' '.$this->zip_ext;

	    return $address;

	}


	/**
	 * This function gives birth date value in 'm-d-Y' string format to display in person detail
	 *
	 * @return string
	 */

	public function getBirthDateDisplayAttribute()
	{
	    if($this->birth_date!=null)
	    {
	        if(DateHelper::validateDate($this->birth_date,'Y-m-d'))
	        {
		        $birth_date_carbon_obj = Carbon::createFromFormat('Y-m-d', $this->birth_date);
		        return $birth_date_carbon_obj->format('m-d-Y');

	        }
	    }

	    return "";

	}


	/**
	 * This function gives full name value in string format to display in person detail
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
	 * This function gives zip related values in string format to display in person detail
	 *
	 * @return mixed|string
	 */

	public function getZipDisplayAttribute()
	{
		$zip="";
		if($this->zip!=null)
		{
			$zip=$this->zip;

			if($this->zip_ext!=null)
				$zip.=' - '.$this->zip_ext;

		}

	    return $zip;
	}


	/**
	 * This function gives phone 1 related values in string format to display in person detail
	 *
	 * @return mixed|string
	 */

	public function getPhone1DisplayAttribute()
	{
		$phone="";
		if($this->phone1!=null)
		{
			$phone=$this->format_phone($this->phone1);

			if($this->phone1_ext!=null)
				$phone.=' '.$this->phone1_ext;

			if($this->phone1_type!=null)
				$phone.=' ['.$this->phone1_type.']';
		}

	    return $phone;
	}


	/**
	 * This function gives phone 2 related values in string format to display in person detail
	 *
	 * @return mixed|string
	 */

	public function getPhone2DisplayAttribute()
	{
		$phone="";
		if($this->phone2!=null)
		{
			$phone=$this->format_phone($this->phone2);

			if($this->phone2_ext!=null)
				$phone.=' '.$this->phone2_ext;

			if($this->phone2_type!=null)
				$phone.=' ['.$this->phone2_type.']';
		}

	    return $phone;
	}


	/**
	 * This function gives phone 3 related values in string format to display in person detail
	 *
	 * @return mixed|string
	 */

	public function getPhone3DisplayAttribute()
	{
		$phone="";
		if($this->phone3!=null)
		{
			$phone=$this->format_phone($this->phone3);

			if($this->phone3_ext!=null)
				$phone.=' '.$this->phone3_ext;

			if($this->phone3_type!=null)
				$phone.=' ['.$this->phone3_type.']';
		}

	    return $phone;
	}


	/**
	 * This function changes phone format '1234567890' from db as '(123) 456-7890'
	 *
	 * @param $phone
	 *
	 * @return mixed
	 */

	function format_phone($phone)
	{

	    if(strlen($phone) == 7)
	        return preg_replace("/(\d{3})(\d{4})/", "$1-$2", $phone);
	    elseif(strlen($phone) == 10)
	        return preg_replace("/(\d{3})(\d{3})(\d{4})/", "($1) $2-$3", $phone);
	    else
	        return $phone;
	}


	/**
	 * This function saves current person info viewed by logged in user in cache
	 *
	 * @param $user_id
	 */

	public function saveLastViewedPersonInfoByUser($user_id)
	{

		$recent_viewed_persons_arr=array();
		$recent_viewed_persons_arr_new=array();

		if(Cache::has('recent_viewed_persons_' . $user_id))
		{
			$recent_viewed_persons_arr=Cache::get('recent_viewed_persons_' . $user_id);
		}

		$recent_viewed_persons_arr_new[]=array('id'=>$this->id,'name'=>$this->name);

		$j=1;
		for($i=0;$i<count($recent_viewed_persons_arr);$i++)
		{
			if($j>4 || $recent_viewed_persons_arr[$i]['id']==$this->id)
			{
			}
			else
			{
				$recent_viewed_persons_arr_new[]=array('id'=>$recent_viewed_persons_arr[$i]['id'],'name'=>$recent_viewed_persons_arr[$i]['name']);
				$j++;
			}
		}

		Cache::forever('recent_viewed_persons_'. $user_id,$recent_viewed_persons_arr_new);

	}


	/**
	 * This function saves current person id viewed by logged in user in cache
	 *
	 * @param $user_id
	 */

	public function saveLastViewedPersonIdByUser($user_id)
	{
		$recent_viewed_persons_arr=array();

		if(Cache::has('recent_viewed_persons_' . $user_id))
		{
			$recent_viewed_persons_arr=Cache::get('recent_viewed_persons_' . $user_id);
		}

		array_unshift($recent_viewed_persons_arr,$this->id);

		if(count($recent_viewed_persons_arr)>5)
			array_pop($recent_viewed_persons_arr);

		Cache::forever('recent_viewed_persons_'. $user_id,$recent_viewed_persons_arr);

	}
}