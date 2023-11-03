<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Games;
use App\singlepanna;
use App\typegames;
use App\UserOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $validator = Validator::make($request->all(), [
            'phone' => 'required|unique:users',
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
        ], [
           
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(),'status'=>false], 400);
        }
        // Retrieve the old customer data
        $cust = User::where('id', $request->id)->first();
    
    
    
        // Update other customer information
        $cust->name = $request->name;
        $cust->email = $request->email;
        $cust->phone = $request->phone;
     
    
        // Save the updated customer information
        if ($cust->save()) {
            return response()->json(['message' => 'customer updated successfully'], 201);
        }
    }

   

    // public function generate(Request $request)
    // {
    //     /* Validate Data */
    //     $request->validate([
    //         'phone' => 'required|exists:users,phone',
    //     ]);

    //     /* Generate an OTP (Random 6-digit OTP) */
    //     $otp = rand(100000, 999999); // Generate a random 6-digit OTP

    //     /* Send the OTP via SMS (you need to implement this function) */
    //     // Implement the code to send SMS with the OTP

    //     /* Return a JSON response */
    //     return response()->json([
    //         'message' => 'OTP has been sent to your mobile number.',
    //         'otp' => $otp
    //     ]);
    // }
    
    // public function generateOtp(Request $request)
    // {
    //     $phone = $request->input('phone');
    //     $user = User::where('phone', $phone)->first();

    //     if (!$user) {
    //         return response()->json(['error' => 'User not found'], 404);
    //     }

    //     $userOtp = UserOtp::where('id', $user->id)->latest()->first();
    //     $now = now();

    //     if ($userOtp && $now->isBefore($userOtp->expire_at)) {
    //         return response()->json(['otp' => $userOtp->otp, 'message' => 'Existing OTP found'], 200);
    //     }

    //     // Generate a new OTP
    //     $otp = rand(123456, 999999);
    //     $expireAt = $now->addMinutes(10);

    //     // Create a new OTP record
    //     $userOtp = UserOtp::create([
    //         'id' => $user->id,
    //         'otp' => $otp,
    //         'expire_at' => $expireAt
    //     ]);

    //     return response()->json(['otp' => $userOtp->otp, 'message' => 'New OTP generated'], 201);
    // }


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

// public function passwordUpdate(Request $request)
// {
//     $user = User::get(); // Get the currently authenticated user
// echo"<pre>";print_r($user);exit;
//     $validator = Validator::make($request->all(), [
//         'current_password' => [
//             'required',
//             function ($attribute, $value, $fail) use ($user) {
//                 if (!(Hash::check($value, $user->password))) {
//                     $fail('Current password is wrong.');
//                 }
//             }
//         ],
//         'new_password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d!@#$%^&*+_-]{8,}$/',
//         'confirm_password' => 'required|same:new_password',
//     ]);

//     if ($validator->fails()) {
//         return response()->json(['errors' => $validator->errors()], 400);
//     }

//     // Update the password
//     $user->password = Hash::make($request->new_password);
//     $user->save();

//     return response()->json(['message' => 'Password successfully updated', 'status' => true], 200);
// }


//type games api singledigit
public function singledigit(Request $request){
        $validator=Validator::make($request->all(),[
            'date'=>'required|date',
            'open_digit'=>'required',
            'points'=>'required|numeric',
            'time_session'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(),'status'=>false], 400);
        }
        $gms=typegames::create([
            'date' => $request->input('date'),
            'open_digit' => $request->input('open_digit'),
            'points' => $request->input('points'),
            'time_session' => $request->input('time_session'),

        ]);
        return response()->json(['message' => ' successfully added','status'=>true]);

}
//single panna 
public function singlepanna(Request $request){
    $validator=Validator::make($request->all(),[
        'date'=>'required|date',
        'digit'=>'required',
        'point'=>'required|numeric',
        
    ]);
    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors(),'status'=>false], 400);
    }
    $gms=singlepanna::create([
        'date' => $request->input('date'),
        'digit' => $request->input('digit'),
        'point' => $request->input('point'),

    ]);
    return response()->json(['message' => ' successfully added','status'=>true]);

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


