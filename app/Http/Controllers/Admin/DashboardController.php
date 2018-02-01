<?php

namespace App\Http\Controllers\Admin;

use App\Person;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    /**
     * Display admin dashboard with total number of users and persons
     *
     * @return mixed
     */

    public function index()
    {
		$total_users= User::active()->count();
        $total_persons = Person::active()->count();
        return view('pages.admin.dashboard')->with('total_users',$total_users)->with('total_persons',$total_persons);
    }

}