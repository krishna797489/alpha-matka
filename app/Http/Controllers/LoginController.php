<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation Error..', "errros" =>  $validator->errors()]);
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                if ($request->fcmtoken) {
                    $user->fcmtoken = $request->fcmtoken;
                    $user->save();
                }

                return [
                    'data' => $user,
                    'status' => true,
                    'message' => 'Successfully Log in'
                ];
            }
            return [
                'data' => '',
                'status' => false,
                'message' => 'Invalid Password'
            ];
        }
        return [
            'data' => '',
            'status' => false,
            'message' => 'Invalid Email'
        ];
    }
}
