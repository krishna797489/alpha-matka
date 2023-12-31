<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use App\Customer;
use App\Games;
use App\history;
use App\Notification;
use App\Result;
use App\typegames;
use App\User;
use Carbon\Carbon;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;



class CustomerController extends Controller
{
    public function index(){
      $uicongfig = [
        'title' => "Customer",
        'header' => "Customer",
        'active' => "customer",
    ];
        return view('customer.index',compact('uicongfig'));
     }
     public function get($id){
        $cust = Customer::find($id);
        return view('customer.update',compact('cust'));
      }

      public function viewdetail(Request $request ,$id){
//echo"<pre>";print_r($id);exit;
        $item =Customer::where('id',$request->id)->first();
//echo"<pre>";print_r($employee);exit;

    //    / $employee = Customer::where('usertype', 1)->find($id )->first();
       return view('customer.customer_view',compact('item'));

      }
    //   public function History(Request $request,$id){
    //     // $user_id=User::Find($id);
    //     $userHistory = History::where('user_id', $id)->get();

    //     // Calculate total points withdrawn
    //     $totalPointsWithdrawn = $userHistory->where('status', 0)->sum('point');

    //     // Calculate total points added
    //     $totalPointsAdded = $userHistory->where('status', 1)->sum('point');

    //     // Calculate available balance
    //     $availableBalance = $totalPointsAdded-$totalPointsWithdrawn;

    //     return view('customer.history', compact('userHistory', 'totalPointsWithdrawn', 'totalPointsAdded', 'availableBalance'));
    //   }
//     public function history(Request $request, $id)
// {
//     $userHistory = History::where('user_id', $id)->get();

//     // Calculate total points withdrawn
//     $totalPointsWithdrawn = $userHistory->where('status', 0)->sum('point');

//     // Calculate total points added
//     $totalPointsAdded = $userHistory->where('status', 1)->sum('point');

//     // Calculate available balance
//     $availableBalance = $totalPointsAdded - $totalPointsWithdrawn;

//     return view('customer.history', compact('userHistory', 'totalPointsWithdrawn', 'totalPointsAdded', 'availableBalance'));
// }

public function history(Request $request, $id)
{
    $userHistory = History::where('user_id', $id)->get();

    // Calculate total points withdrawn
    $totalPointsWithdrawn = $userHistory->where('status', 0)->sum('point');

    // Calculate total points added
    $totalPointsAdded = $userHistory->where('status', 1)->sum('point');
//echo"<pre>";print_r($totalPointsAdded);exit;
    // Calculate available balance
    $availableBalance = $totalPointsAdded - $totalPointsWithdrawn;

    // Check if available balance is less than total points withdrawn


    return view('customer.history', compact('userHistory', 'totalPointsWithdrawn', 'totalPointsAdded', 'availableBalance'));
}


public function bidhistory(Request $request, $id)
{
    // Fetch records from the typegames table for the specified user_id
    $items = typegames::where('user_id', $id)->get();

    // Fetch game names based on the g_id from the games table
    foreach ($items as $item) {
        $game = Games::find($item->g_id);
        // echo"<pre>";print_r($game);exit;
        // Assuming the games table has a column named 'name'
        $item->game_name = $game->name ?? 'N/A';
        // echo"<pre>";print_r($item);exit;
    }

    return view('customer.bid_history', compact('items',));
}


//     public function History(Request $request, $id)
// {
//     // $user_id = User::Find($id);
//     $userHistory = History::where('user_id', $id)->get();

//     // Calculate total points withdrawn
//     $totalPointsWithdrawn = $userHistory->where('status', 0)->sum('point');

//     // Calculate total points added
//     $totalPointsAdded = $userHistory->where('status', 1)->sum('point');

//     // Calculate available balance
//     $availableBalance = max(0, $totalPointsAdded - $totalPointsWithdrawn);

//     return view('customer.history', compact('userHistory', 'totalPointsWithdrawn', 'totalPointsAdded', 'availableBalance'));
// }



      public function showUserInfo()
    {
        $users = User::all();

    // Pass the user data to the view
    return view('customer.add_fund_user', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required|exists:users,id',
            'point' => 'required|numeric|min:0',
        ]);

        $user = User::find($request->input('user'));

        $transaction = history::create([
            'user_id' => $user->id,
            'point' => $request->input('point'),
            'status' => 1,
            'time' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Transaction added successfully.');
    }

    public function withdrawadmin(){
        $users = User::all();
    // Pass the user data to the view
    return view('customer.debit_fund_user', ['users' => $users]);
    }


 public function withdrabyadmin(Request $request)
 {
     $request->validate([
         'user'  => 'required|exists:users,id',
         'point' => 'required|numeric|min:0',
     ]);

     $user = User::find($request->input('user'));

     if (!$user) {
         return redirect()->back()->with('error', 'User not found.');
     }


     // Calculate available balance
    // Calculate available balance by subtracting the sum of points with status = 0
        $availableBalance = $user->histories()
        ->where('status', 1) // Only consider added points
        ->sum('point')
        - $user->histories()
            ->where('status', 0) // Subtract the sum of points with status = 0
            ->sum('point');

     $withdrawalAmount = $request->input('point');
     //echo"<pre>";print_r($withdrawalAmount);exit;
     // Ensure withdrawal amount does not exceed available balance
     if ($withdrawalAmount > $availableBalance ) {
         return redirect()->back()->with('error', 'Insufficient points available for withdrawal.');
     }

     // Create withdrawal transaction
     $transaction = History::create([
         'user_id' => $user->id,
         'point'   => $withdrawalAmount, // Use positive value for withdrawal
         'status'  => 0,
         'time'    => now(), // Carbon::now() is equivalent to now()
     ]);

     // Perform any other actions here, if needed

     // Redirect or return a response with the updated balance
    //  $updatedBalance = $availableBalance - $withdrawalAmount;
     return redirect()->back()->with('success', 'Points withdrawal successful. Updated balance: ' );
 }



    public function contactmanagemnt(){
        return view('customer.contact_man');
    }

    public function contact(Request $request)
{
    if (!$request->ajax()) {
        return response()->json([
            "status" => "fail",
            "message" => "Bad Request."
        ], 401);
    }

    $list = Contact::select(['id', 'mobile', 'whatsApp', 'email'])->get();

    return datatables($list)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            return '<button type="button" onclick="edit(' . $row->id . ')" class="btn btn-outline-info btn-sm mr-p5"><i class="fa fa-edit" aria-hidden="true"></i></button>';
        })
        ->rawColumns(['action'])
        ->make(true);
}

    public function contactedit(Request $request) {
    $validator = Validator::make($request->all(), [
        'mobile' => 'required|max:12',
        'whatsApp' => 'required|max:12',
        'email' => 'required|email',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'error' => 1,
            'vderror' => 1,
            'errors' => $validator->getMessageBag()->toArray(),
        ], 200);
    }

    $contact = Contact::find($request->id);

    if (!$contact) {
        return response()->json([
            'error' => 1,
            'msg' => 'Contact not found.',
        ], 200);
    }

    $contact->mobile = $request->mobile;
    $contact->whatsApp = $request->whatsApp;
    $contact->email = $request->email;

    if ($contact->save()) {
        return response()->json([
            'error' => 0,
            'msg' => 'Contact has been updated successfully.',
        ], 200);
    } else {
        return response()->json([
            'error' => 1,
            'msg' => 'Contact failed to update.',
        ], 200);
    }
}

 public function contactget(Request $request)
 {
  //echo"<pre>";print_r($request->All());exit;
     return Contact::where('id',$request->id)->first();
 }
      public function list(Request $request)
      {
          if (!$request->ajax()) {
              return response()->json([
                  "status" => "fail",
                  "message" => "Bad Request."
              ], 401);
          }

          $list = Customer::where('usertype', 1)->get();

          return datatables($list)
              ->addIndexColumn()
              ->addColumn('status', function ($row) {
                  if ($row->status) {
                      return '<button type="button" class="btn btn-block btn-danger btn-sm" onclick="changestatus(' . $row->id . ')">Disable</button>';
                  } else {
                      return '<button type="button" class="btn btn-block btn-success btn-sm" onclick="changestatus(' . $row->id . ')">Enable</button>';
                  }
              })
              ->addColumn('action', function ($row) {
                  // Add "History" button to view customer history
                  $historyButton = '<a href="History/' . $row->id . '" type="button" class="btn btn-outline-primary btn-sm m-1" onclick="viewHistory(' . $row->id . ')">History</a>';
                  $BIDhistory = '<a href="bidhistory/' . $row->id . '" type="button" class="btn btn-outline-primary btn-sm m-1" onclick="viewHistory(' . $row->id . ')">BID</a>';

                  // View button for customer details
                  $viewButton = '<a href="employees/' . $row->id . '" type="button" class="btn btn-outline-info btn-sm m-1" onclick="viewCustomer(' . $row->id . ')">View</a>';

                  return $historyButton . $viewButton.$BIDhistory;
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
              ->rawColumns(['status', 'action'])
              ->make(true);
      }

    public function customerDetail(){
        return view('customer.customer_view');

    }



// Route definition




 public  function status(Request $request)
 {
   $user = Customer::where('id',$request->id)->first();
   if ($user) {
     if ($user->status) {
       $user->status = 0;
     } else {
       $user->status = 1;
     }
     $user->save();
     return response()->json(array(
       'error' => 0,
       'msg' => "Groups status has been changed successfully."
     ), 200);
   } else {
     return response()->json(array(
       'error' => 1,
       'msg' => "Groups status failed to change."
     ), 200);
   }
 }


 public function add(){

    return view('customer.add');
  }

  public function create(Request $request)
  {

      $validator = Validator::make($request->all(), [
          'name' => 'required',
          // 'username' => 'required|unique:users',
          'image' => ['required','file',function ($attribute, $value, $fail) {
            $ext = pathinfo($value->getClientOriginalName(), PATHINFO_EXTENSION);
            if (!in_array(strtolower($ext),['jpeg','png','jpg','gif','svg'])) {
                $fail('Only jpeg,png,jpg,gif,svg file supported.');
            }}],
          'email' => 'required|max:50|regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/i',
          'phone' => 'required|numeric|digits_between:6,14|',
          'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d!@#$%^&*+_-]{8,}$/',
      ], [

      'password.regex' => 'The password  must be have at least 8 characters long 1 uppercase & 1 lowercase character 1 number. . ',
      'phone.required' => 'The phone no field is required.',
      'phone.numeric' => 'The phone no must be a number.',
      'phone.digits_between' => 'The phone no must be between 6 and 14 digits.',
    ]);
    if ($validator->fails()) {
      return redirect()
      ->back()
      ->withErrors($validator)
      ->withInput();
  }
     //echo "<pre>"; print_r($request->all()); exit;
      $data = $request->all();


      // $ext = ($request->filename->getClientOriginalName());

      $fileName = time().'.'.$request->image->getClientOriginalName();
      //echo "<pre>"; print_r($fileName); exit;
      // $filename =$request->id.rand(1000,9999).'t'.time().'.'.$ext;
      move_uploaded_file($request->image->getPathName(),public_path('upload/image/'.$fileName));


      $cust = new Customer();
      $cust->name = $request->name;
      $cust->image =  $fileName;
      $cust->email = $request->email;
      $cust->phone = $request->phone;
      $cust->password = Hash::make($request->password);
       //echo"<pre>";print_r($cust->toArray());exit;
      if ($cust->save()) {

        return redirect()->route('customer.index')->with('success','customer has been created successfully.');
      }else{
          return redirect()->route('customer.index')->with('danger','customer failed to create.');
      }

      }



public function update(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'image' => ['required', 'file', function ($attribute, $value, $fail) {
            $ext = pathinfo($value->getClientOriginalName(), PATHINFO_EXTENSION);
            if (!in_array(strtolower($ext), ['jpeg', 'png', 'jpg', 'gif', 'svg'])) {
                $fail('Only jpeg, png, jpg, gif, svg files are supported.');
            }
        }],
        'email' => 'required|max:50|regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/i',
        'phone' => 'required|numeric|digits_between:6,14|',
    ], [
        'password.regex' => 'The password must have at least 8 characters, 1 uppercase letter, 1 lowercase letter, and 1 number.',
        'phone.required' => 'The phone number field is required.',
        'phone.numeric' => 'The phone number must be a number.',
        'phone.digits_between' => 'The phone number must be between 6 and 14 digits.',
    ]);

    if ($validator->fails()) {
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }

    $cust = Customer::where('id', $request->id)->first();

    if ($request->hasFile('image')) {
        $fileName = time() . '.' . $request->image->getClientOriginalName();

        $request->image->move(public_path('upload/image'), $fileName);

        if (file_exists(public_path('upload/image/' . $cust->image)) && $cust->image != $fileName) {
            unlink(public_path('upload/image/' . $cust->image));
        }

        $cust->image = $fileName;
    }


    $cust->name = $request->name;
    $cust->email = $request->email;
    $cust->phone = $request->phone;
    if (!empty($request->password)) {
        $cust->password = Hash::make($request->password);
    }


    if ($cust->save()) {
        return redirect()->route('customer.index')->with('success', 'Customer has been updated successfully.');
    } else {
        return redirect()->route('customer.index')->with('danger', 'Customer failed to update.');
    }
}


      public function delete(Request $request)
      {
        if(Customer::softDelete(['id'=>$request->id]))
        {
          return response()->json(array(
            'error' => 0,
            'msg' => "Customer has been deleted successfully."
          ), 200);
        } else {
          return response()->json(array(
            'error' => 1,
            'msg' => "Customer failed to update."
          ), 200);
        }
      }


      public function addpoint(Request $request,$id){
        $user = User::find($id);


        if (!$user) {
            return response()->json(['message' => 'User not found', 'status' => false], 404);
        }
        $time =Carbon::now();
        if ($user) {
            // Agar user_id ke sath ek record mil gaya, to use update karein
            history::create([
                'user_id' => $user->id,
                'payment_type' => $request->input('payment_type','admin'),
                'point' => $request->input('point'),
                'time' =>Carbon::now(),
                'type' => $request->input('type','0'),

            ]);
            return response()->json(['message' => 'new point successfully added', 'status' => true], 201);
        }

        }

        //result decleare related
        public function selectgame(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'result_date' =>'required|date',


        ]);

        Result::create([
            'user_id' => $request->input('user'),
            'result_date' => $request->input('result_date'),
            'Odigit' => $request->input('Odigit'),
            'Cdigit' => $request->input('Cdigit'),

        ]);

        return redirect()->back()->with('success', 'Result Declear Successfully');
    }

    public function resulthistory(Request $request)
    {
        $history = Result::orderBy('created_at', 'desc')->get();


        if ($request->ajax()) {
            return datatables($history)
                ->addIndexColumn()
                ->addColumn('games', function ($result) {
                    $games = $result->games->pluck('name')->toArray();
                    $lastGame = end($games);
                    array_pop($games);
                    array_unshift($games, $lastGame); 
                    return implode(', ', $games);
                })
                ->make(true);
        }

        return view('customer.result_history', ['history' => $history]);
    }




    public function notification(){
        return view('customer.notification');
    }
    public function notificationstore(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'tittle' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = Notification::create([

            'tittle' => $request->input('tittle'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('notification')->with('success', 'Notification Sent successfully');
    }

}
