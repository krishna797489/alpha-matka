<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Games;
use App\history;
use App\Log;
use App\singlepanna;
use App\typegames;
use App\UserOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            return response()->json(['status' => false, 'message' => 'Validation Error..', "errors" =>  $validator->errors()]);
        }

        $user = User::where('phone', $request->phone)->first();

        if ($user) {
            if ($user->status == 0) {
                // User status is 0 (active)
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
                } else {
                    return [
                        'data' => '',
                        'status' => false,
                        'message' => 'Invalid Password'
                    ];
                }
            } else {
                // User status is 1 (disabled)
                return [
                    'data' => '',
                    'status' => false,
                    'message' => 'User is disabled. Please contact support.'
                ];
            }
        } else {
            return [
                'data' => '',
                'status' => false,
                'message' => 'Invalid phone'
            ];
        }
    }
    //register api

    public function register(Request $request)
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
    // Validation rules for name and email, excluding the 'phone' field
    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:users,name,' . $request->id,
        'email' => 'required|email|unique:users,email,' . $request->id,
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors(), 'status' => false], 400);
    }

    // Retrieve the old customer data
    $cust = User::where('id', $request->id)->first();

    // Update customer information
    $cust->name = $request->name;
    $cust->email = $request->email;

    // Save the updated customer information
    if ($cust->save()) {
        return response()->json(['message' => 'Customer updated successfully'], 201);
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
public function changePassword(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|different:current_password|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d!@#$%^&*+_-]{8,}$/',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Verify the current password
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'Current password is incorrect'], 401);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password changed successfully'], 200);
    }

//types games
public function participate(Request $request ,$id)
{
    $data = $request->all();

     {
        // Find the user by their id in the users table
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }


        $participation = typegames::create([

            'game_id' => $request->input('game_id'),
             'type' => $request->input('type','Empty'),
            'date' => $request->input('date'),
            'digit' =>$request->input('digit'),
            'close_digit' =>$request->input('close_digit','Empty'),
            'session_type' => $request->input('session_type','Empty'),
            'point' => $request->input('point'),
            'user_id' => $user->id,
        ]);
        return response()->json(['message' => 'Registration successful','status'=>true], 201);
    }
}
//wallet se related

public function addpoint(Request $request,$id){
    $validator = Validator::make($request->all(), [
        'payment_type' => 'required',
        'point' => 'required|numeric|min:0', // Adjust the validation rules as needed
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        return response()->json(['message' => $validator->errors()->first(), 'status' => false], 400);
    }

    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found', 'status' => false], 404);
    }

    // If user is found and validation passes, proceed with creating the history record
    $transaction = history::create([
        'user_id' => $user->id,
        'payment_type' => $request->input('payment_type'),
        'point' => $request->input('point'),
        'time' => Carbon::now(),
        'status' => 1,
    ]);

    return response()->json(['message' => 'New point successfully added', 'status' => true], 201);
    }

    public function getPointSum($user_id) {
        $result = DB::select("SELECT (SELECT SUM(point) FROM history WHERE user_id = ?) - (SELECT SUM(debit) FROM history WHERE user_id = ?) AS difference", [$user_id, $user_id]);

        if (!empty($result)) {
            $difference = $result[0]->difference;
            return response()->json(['difference' => $difference], 200);
        } else {
            return response()->json(['message' => 'User not found or no data available', 'status' => false], 404);
        }
    }

//add point history

public function addPointsForhistory($userId) {
    $points = DB::table('history')
        ->select('point', 'type', 'time')
        ->where('user_id', $userId)
        ->where('type', 0)
        ->whereNotNull('point')  // Exclude rows with null 'point' values
        ->get();
    return response()->json(['points' => $points], 200);
}

//withdraw point
public function pointWithdraw(Request $request)
{
    $validator = Validator::make($request->all(), [
        'user' => 'required|exists:users,id',
        'point' => 'required|numeric|min:0',
    ]);

      echo"<pre>";print_r($validator);exit;
    $user = User::find($request->input('user'));
    // Check validation results
    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()->first()], 400);
    }

    $user = User::find($request->input('user'));

    // Check if the user exists
    if (!$user) {
        return response()->json(['error' => 'User not found.'], 404);
    }

    // Calculate available balance
    $availableBalance = $user->histories()
        ->where('status', 1) // Only consider added points
        ->sum('point');

    // Check if the user has enough points
    if ($request->input('point') > $availableBalance) {
        return response()->json(['error' => 'Insufficient points available for withdrawal.'], 400);
    }

    // Create withdrawal transaction
    $transaction = History::create([
        'user_id' => $user->id,
        'point' => $request->input('point'),
        'status' => 0,
        'time' => now(),
    ]);

    return response()->json(['success' => 'Points withdrawn successfully.'], 200);

}


//withdraw point history

// public function withdrawPointsForhistory($userId){
//     $points = DB::table('history')
//     ->select('debit', 'type', 'time')
//     ->where('user_id', $userId)
//     ->where('type', 1)
//     ->whereNotNull('debit')  // Exclude rows with null 'point' values
//     ->get();
//     return response()->json(['points' => $points], 200);
// }

public function history(Request $request, $id)
{
    try {
        // Find the user by their id in the users table
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Retrieve history records for the specified user
        $history = History::where('user_id', $user->id)->get();

        return response()->json(['data' => $history, 'status' => true], 200);
    } catch (\Exception $e) {
        // Handle exceptions if any
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function bidHistory(Request $request, $id)
    {
        try {
            // Validate the user ID
            $validator = Validator::make(['id' => $id], [
                'id' => 'exists:users,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 404);
            }

            // Find the user by their id in the users table
            $user = User::find($id);

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            // Retrieve bid history records for the specified user
            $bidHistory = Typegames::where('user_id', $user->id)->get();

            return response()->json(['data' => $bidHistory, 'status' => true], 200);
        } catch (\Exception $e) {
            // Handle exceptions if any
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
        $games = Games::where('status', 1)->paginate(5);

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


