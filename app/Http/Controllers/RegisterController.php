<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPUnit\TextUI\XmlConfiguration\Groups;

class RegisterController extends Controller
{


    public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'required',
       
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors(),'status'=>false], 400);
    }

    $user = User::create([
       
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
        
    ]);
    return response()->json(['message' => 'Registration successful','status'=>true], 201);

}

}
