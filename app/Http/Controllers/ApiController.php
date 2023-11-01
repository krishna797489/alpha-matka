<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Games;


use Illuminate\Http\Request;

class ApiController extends Controller
{
    //login api
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation Error..', "errros" =>  $validator->errors()]);
        }

        $user = User::where('phone', $request->phone)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                if ($request->fcmtoken) {
                    $user->fcmtoken = $request->fcmtoken;
                    $user->save();
                }

                return [
                    'data' => $user,
                    'status' => true,
                    'message' => 'Successfully Login'
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
            'message' => 'Invalid phone'
        ];
    }

    //register api

    public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        
        'name' => 'required|string|max:255|unique:users',
        'email' => 'required|string|email|max:255',
        'phone' => 'required|numeric|digits_between:6,14|unique:users',
        'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d!@#$%^&*+_-]{8,}$/',
       
    ]);
  

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors(),'status'=>false], 400);
    }

    $user = User::create([
       
        'name' => $request->input('name'),
         'email' => $request->input('email'),
        'phone' => $request->input('phone'),
        'password' => Hash::make($request->input('password')),
        'mpin' => $request->input('mpin'),

        
    ]);
    return response()->json(['message' => 'Registration successful','status'=>true], 201);

}

public function logout(Request $request)
{
    // Check if the user is authenticated
    if ($request->user()) {
        $user = $request->user();
        // Revoke the user's token
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        return response()->json([
            'message' => 'Logged out successfully.',
            'status' => true
        ]);
    } else {
        return response()->json([
            'message' => 'User not authenticated.',
            'status' => false
        ], 401); // Return a 401 Unauthorized status
    }
}

    public function updateprofile(Request $request)
        {
        // Validate the request data, if necessary
        $request->validate([
            'phone' => 'required',
            'name' => 'required',
            'email' => 'required|email',
        ]);

        // Find the user by ID
        $user = User::find($request->id);

        if (!$user) {
            return response()->json(['message' => 'User not found'],404);
        }

        // Update the user's information
        $user->phone = $request->input('phone');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return response()->json(['message' => 'User updated successfully']);
    }

    public function verifyMobile(Request $request)
    {
        $mobile = $request->input('phone');

        // Retrieve the record associated with the mobile number
        $user = User::where('phone', $mobile)->first();

        if ($user) {
            // Perform your verification logic here

            // For simplicity, we'll just return a response indicating success
            return response()->json([
                'success' => true,
                'message' => 'Mobile verification successful'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Mobile number not found'
            ]);
        }
    }

//get profile api
public function myprofile($id)
{
    // Find the record and select only the desired fields
    $ragister = User::select('name', 'phone', 'email')->find($id);

    if (!$ragister) {
        return response()->json([
            'success' => false,
            'message' => 'Record not found'
        ]);
    }

    return response()->json([
        'success' => true,
        'data' => $ragister
    ]);
}

//old pass throw change password 
public function changePassword(Request $request)
{
    // Validations
    $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|string|min:8|confirmed',
    ]);

    // Get the authenticated user
    $user = auth()->user();

    // Check if the old password matches
    if (!Hash::check($request->old_password, $user->password)) {
        return response()->json(['message' => 'Old password is incorrect']);
    }

    // Update the user's password
    $user->update([
        'password' => Hash::make($request->new_password),
    ]);

    return response()->json(['message' => 'Password changed successfully']);
}

//otp varification
public function sendOtp(Request $request)
{
    // Generate a random OTP (e.g., 4-6 digits)
    $otp = mt_rand(1000, 9999);

    // Send OTP via SMS (Twilio example)
    $twilio = new Client(env('ACd297bb2d5e39ad3cb42ba0db3af871e6'), env('04df012cdbd82ccd684d9f374780b38b'));
    $twilio->messages->create(
        $request->input('phone'),
        [
            'from' => env('TWILIO_PHONE_NUMBER'),
            'body' => 'Your OTP: ' . $otp,
        ]
    );

    // You can save the OTP in the database or send it in the response
    return response()->json(['message' => 'OTP sent successfully', 'otp' => $otp]);
}
public function verifyOtp(Request $request)
{
    $user = auth()->user();
    $profile = $user->profile;

    if ($profile->otp == $request->input('otp')) {
        // OTP is correct, proceed with verification
        $profile->otp = null; // Clear the OTP
        $profile->save();
        return response()->json(['message' => 'OTP verified successfully']);
    }

    return response()->json(['message' => 'OTP verification failed']);
}

public function gamestore(Request $request)
{
    $validator = Validator::make($request->all(), [
        
        'name' => 'required|max:255|unique:games',
        'start_time' => 'required',
        'end_time' => 'required|',
        'code'=> 'required|unique:games',
        
    ]);
  
    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors(),'status'=>false], 400);
    }

    $gm = Games::create([
       
        'name' => $request->input('name'),
        'start_time' => $request->input('start_time'),
        'end_time' => $request->input('end_time'),
        'code' => $request->input('code'),
        
    ]);
    return response()->json(['message' => 'Games successfully added','status'=>true], 200);

}

public function getAllGames()
    {
        $games = Games::paginate(5);

        if ($games->isEmpty()) {
            return response()->json(['message' => 'No games found']);
        }

        return response()->json($games);
    }

// public function gamesupdate(Request $request, $id)
// {
//     // Validate the incoming request data
//     $request->validate([
//         'name' => 'required|max:255',
//         'start_time' => 'required',
//         'end_time' => 'required|after:start_time',

//     ]);

//     // Find the item by ID
//     $gm = Games::find($id);

//     if (!$gm) {
        
//         return response()->json(['message' => 'record not found'], 404);
//     }

//     // Update the gm with the new data
//     $gm->name = $request->input('name');
//     $gm->start_time = $request->input('start_time');
//     $gm->end_time = $request->input('end_time');

//     $gm->save();

//     return response()->json(['message' => 'record updated successfully']);
// }


public function destroy($id)
{
    // Find the record by ID
    $model = Games::find($id);

    // Check if the record exists
    if (!$model) {
        return response()->json(['message' => 'Record not found'], 404);
    }

    // Delete the record
    $model->delete();

    // Return a response indicating success
    return response()->json(['message' => 'Record deleted successfully'], 200);
}


public function showgames($id)
{
    // Find the record by ID
    $model = Games::find($id);

    // Check if the record exists
    if (!$model) {
        return response()->json(['message' => 'Record not found'], 404);
    }

    // Return the retrieved record as JSON response
    return response()->json($model, 200);
}

public function index()
{
    $gm = Games::all();
    return response()->json(['data' => $gm]);
}



}


