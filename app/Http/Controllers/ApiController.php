<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Support\Facades\Hash;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Games;
use App\history;
use App\Log;
use App\Notification;
use App\Result;
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
        return response()->json(['message' => 'Registration successful', 'status' => true], 201);
    }

    public function logout(Request $request)
    {

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
            ], 401);
        }
    }


    public function updateprofile(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users,name,' . $request->id,
            'email' => 'required|email|unique:users,email,' . $request->id,
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false], 400);
        }


        $cust = User::where('id', $request->id)->first();


        $cust->name = $request->name;
        $cust->email = $request->email;


        if ($cust->save()) {
            return response()->json(['message' => 'Customer updated successfully'], 201);
        }
    }






    //get profile api
    public function myprofile($id)
    {

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
    public function participate(Request $request, $id)
    {




        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $availableBalance = $user->histories()
            ->where('status', 1)
            ->sum('point')
            - $user->histories()
            ->where('status', 0)
            ->sum('point');

        $withdrawalAmount = $request->input('point');

        if ($withdrawalAmount > $availableBalance) {
            return response()->json(['message' => 'Insufficient points available for Games Play', 'status' => false], 400);
        }


        $participation = typegames::create([
            'game_id' => $request->input('game_id'),
            'g_id' => $request->input('g_id'),
            'type' => $request->input('type', 'Empty'),
            'date' => $request->input('date'),
            'digit' => $request->input('digit'),
            'close_digit' => $request->input('close_digit', 'Empty'),
            'session_type' => $request->input('session_type', 'Empty'),
            'point' => $request->input('point'),
            'user_id' => $user->id,
        ]);


        $user->histories()->create([
            'point' => $withdrawalAmount,
            'status' => 0,
            'payment_type' => 4,
            'time' => Carbon::now(),
        ]);

        return response()->json(['message' => 'Registration successful', 'status' => true], 201);
    }

    //wallet se related

    public function addpoint(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'payment_type' => 'required',
            'point' => 'required|numeric|min:0',
        ]);


        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => false], 400);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found', 'status' => false], 404);
        }


        $transaction = history::create([
            'user_id' => $user->id,
            'payment_type' => $request->input('payment_type'),
            'point' => $request->input('point'),
            'time' => Carbon::now(),
            'status' => 1,
        ]);

        return response()->json(['message' => 'New point successfully added', 'status' => true], 201);
    }

    public function getPointSum($id)
    {

        $userHistory = History::where('user_id', $id)->get();


        $totalPointsWithdrawn = $userHistory->where('status', 0)->sum('point');


        $totalPointsAdded = $userHistory->where('status', 1)->sum('point');

        $availableBalance = $totalPointsAdded - $totalPointsWithdrawn;

        return response()->json([
            'totalPointsWithdrawn' => $totalPointsWithdrawn,
            'totalPointsAdded'     => $totalPointsAdded,
            'availableBalance'     => $availableBalance,
        ]);

    }

    //add point history

    public function addPointsForhistory($userId)
    {
        $points = DB::table('history')
            ->select('point', 'type', 'time')
            ->where('user_id', $userId)
            ->where('type', 0)
            ->whereNotNull('point')
            ->get();
        return response()->json(['points' => $points], 200);
    }

    //withdraw point
    public function pointWithdraw(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'payment_type' => 'required',
            'point' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => false], 400);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found', 'status' => false], 404);
        }

        $availableBalance = $user->histories()
            ->where('status', 1)
            ->sum('point')
            - $user->histories()
            ->where('status', 0)
            ->sum('point');

        $withdrawalAmount = $request->input('point');
        if ($withdrawalAmount > $availableBalance) {
            return response()->json(['message' => 'Insufficient points available for withdrawal', 'status' => false], 400);
        }


        $transaction = History::create([
            'user_id'      => $user->id,
            'point'        => $request->input('point'),
            'payment_type' => $request->input('payment_type'),
            'status'       => 0,
            'time'         => Carbon::now(),
        ]);

        return response()->json(['message' => 'Points withdrawal successful', 'status' => true], 200);
    }





    public function history(Request $request, $id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

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
            'code' => 'required|unique:games',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false], 400);
        }

        $gm = Games::create([

            'name' => $request->input('name'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'code' => $request->input('code'),

        ]);
        return response()->json(['message' => 'Games successfully added', 'status' => true], 200);
    }


    public function getAllGames()
    {
        $games = Games::where('status', 1)->paginate(5);

        if ($games->isEmpty()) {
            return response()->json(['message' => 'No games found']);
        }

        return response()->json($games);
    }

    public function getContact()
    {
        $games = Contact::get();

        if ($games->isEmpty()) {
            return response()->json(['message' => 'Contact detail Not found']);
        }

        return response()->json($games);
    }



    public function destroy($id)
    {
        // Find the record by ID
        $model = Games::find($id);

        if (!$model) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $model->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }


    public function showgames($id)
    {
        $model = Games::find($id);

        if (!$model) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        return response()->json($model, 200);
    }

    public function index()
    {
        $gm = Games::all();
        return response()->json(['data' => $gm]);
    }

    public function getHistory(Request $request, $id)
    {
        $userHistory = History::where('user_id', $id)->get();



        $totalPointsWithdrawn = $userHistory->where('status', 0)->sum('point');


        $totalPointsAdded = $userHistory->where('status', 1)->sum('point');
        //echo"<pre>";print_r($totalPointsAdded);exit;
        $availableBalance = $totalPointsAdded - $totalPointsWithdrawn;

        $response = [
            'userHistory' => $userHistory,
            'totalPointsWithdrawn' => $totalPointsWithdrawn,
            'totalPointsAdded' => $totalPointsAdded,
            'availableBalance' => $availableBalance,
        ];

        return response()->json($response);
    }

    public function getresulthistory()
    {
        $results = Result::select('Odigit')->get();

        $OdigitValues = $results->pluck('Odigit');

        $typesGameData = typegames::join('results', 'typegames.digit', '=', 'results.Odigit')
            ->join('games', 'typegames.g_id', '=', 'games.id')
            ->whereIn('typegames.digit', $OdigitValues)
            ->select('typegames.session_type', 'typegames.user_id', 'typegames.digit', 'results.created_at', 'games.name as game_name')
            ->get();
        return response()->json($typesGameData);
    }


    public function notificationget(){
        $notifications = Notification::select('tittle', 'content', 'created_at')
        ->orderBy('created_at', 'desc')->take(5) 
        ->get();
            return response()->json($notifications);
    }

}
