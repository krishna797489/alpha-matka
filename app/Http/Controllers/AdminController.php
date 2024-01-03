<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use App\Customer;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function adminuserlist(Request $request)
{
    return view('customer.admin');
}

public function listUserType0(Request $request)
{
    if (!$request->ajax()) {
        return response()->json([
            "status" => "fail",
            "message" => "Bad Request."
        ], 401);
    }

    $list = Customer::where('usertype', 0)->get();

    return datatables($list)
        ->addIndexColumn()
        ->addColumn('usertype', function ($row) {
            return $row->usertype == 0 ? 'Admin' : 'Normal';
        })
        ->addColumn('email', function ($row) {
            return $row->email ? $row->email : 'No Email';
        })
        ->addColumn('phone', function ($row) {
            return $row->phone ? $row->phone : 'No Phone no';
        })
        ->addColumn('mpin', function ($row) {
            return $row->mpin ? $row->mpin : 'No Mpin';
        })

        // ->addColumn('usertype', function ($row) {
        //     // Your action button code
        // })


        ->rawColumns([''])
        ->make(true);
}
public function store(Request $request)
{
    $validator = Validator::make($request->all(), [

        'name' => 'required|string|max:255|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'required|numeric|digits_between:6,14|unique:users',
        'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d!@#$%^&*+_-]{8,}$/',

    ]);
    $user = User::create([

        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
        'password' => Hash::make($request->input('password')),
        'mpin' => $request->input('mpin'),
        'usertype'=>0,


    ]);

    return redirect()->back()->with('success', 'Admin added successfully.');
}


    }

