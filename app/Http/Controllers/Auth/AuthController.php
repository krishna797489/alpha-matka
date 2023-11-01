<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;



// use Illuminate\Mail\Mailable;
class AuthController extends Controller
{
   
    public function index()
    {
      if (Auth::check()) {

        return redirect()->route('dashboard');
    }

        return view('authui.login');
    } 
  
    public function dashboard()
    {
        return view('dashboard.home');
    }
    public function login(Request $request)
    {
        
      if (Auth::check()) {
        return redirect()->route('dashboard');
    }
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        if ($user = User::where('name',$request->name)->first()){
          if ($request->password) {
              if ($user->status != 0){
                  return back()->with('danger','User account is disable.')->onlyInput('email');
              }
              if($user->isDeleted == 1){
                return back()->with('danger','User account  is delete.')->onlyInput('email');
            }
            }
          }
        //   echo Hash::make('Test@123');
        //   var_dump(Hash::check($request->password,$user->password));
        //  echo"<pre>";print_r($user);exit;
        $credentials = [
            'name' => $request->name,
            'password' => $request->password,
        ];
        // echo"<pre>";print_r($credentials);exit;

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard')
                        ->with('success','You have Successfully loggedin');
        }
  
        return back()->with('danger','username or password are wrong.')->onlyInput('email');
    }

    public function forgot(){
        return view('authui.forgot');
    }
    public function sendforgetlink(Request $request){


        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
        ],[
            'email.required' => 'The email field is required.',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);
         
          $mail = Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
           
            $message->to($request->email);
            $message->subject('User Forgot password link');
            
        });

        return redirect()->route('login')->with('success', 'We have e-mailed your password reset link!');
    }

    public function showResetPasswordForm($token) { 
        
        return view('authui.forgetPasswordLink', ['token' => $token]);
     }

      public function submitResetPasswordForm(Request $request)
      {
        
        $request->validate([
            // 'email' => 'required|email|exists:users',
            'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d!@#$%^&*+_-]{8,}$/|confirmed',
            'password_confirmation' => 'required'
        ],[
            'password.regex'=> 'The password  must be have at least 8 characters long 1 uppercase & 1 lowercase character 1 number..'
        ]);

        $updatePassword = DB::table('password_resets')
                            ->where(
                              'token', $request->token, 
                            )
                            ->first();
                            // $decoded_traces=json_encode($updatePassword, true);
                            // echo"<pre>";print_r($updatePassword);exit;
                            
        if(!($updatePassword)){
            // echo"<pre>";print_r($decoded_traces);exit;
            return back()->with('danger', 'Invalid token!');

        }
        // $user = User::find($authToken->id);
        // if (!empty($user)) {
        //     $user->password = Hash::make($request->password);
        //     $user->password_token = '';
        //     if($user->save()){
        //         return redirect()->route('login')->with('success', 'Your password has been changed!');
        //     }
        // }
        $user = User::where('email', $updatePassword->email)
                    ->update(['password' => Hash::make($request->password)]);
                    // echo"<pre>";print_r($user);exit;
        DB::table('password_resets')->where(['email'=> $request->email])->delete();
   
        return redirect()->route('login')->with('success', 'Your password has been changed!');
    }
    public function logout() {
      
        Auth::logout();
  
        return Redirect('login');
    }
  
}