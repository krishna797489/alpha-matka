<?php

namespace App\Http\Controllers;
use  App\Customer;
use App\Games;
use Illuminate\Http\Request;



class DashboardController extends Controller
{

    public function dashboard()
    {
        $uicongfig = [
            'title' => "Dashboard",
            'header' => "Dashboard",
            'active' => "dashboard",
        ];
        return view('dashboard.home',compact('uicongfig'));
    }


    public function get(Request $request)
    {

        $count['customers'] = Customer::where('usertype', 1)->count();

        $count['games'] =Games::count();

        // echo"<pre>";print_r($count['teacher']);exit;
        return $count;
    }

}
