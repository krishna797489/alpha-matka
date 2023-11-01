<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Customer;
use Mail;


use Illuminate\Http\Request;

class CustomerApiController extends Controller
{
    public function custstore(Request $request)
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
        return response()->json(['error' => $validator->errors(),'status'=>false], 400);
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
        // $cust->save();
        if ($cust->save()) {
  
            return response()->json(['message' => 'Customer created successfully'], 201);
     }

    }

    public function custupdate(Request $request)
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
        return response()->json(['error' => $validator->errors(),'status'=>false], 400);
    }
    // Retrieve the old customer data
    $cust = Customer::where('id', $request->id)->first();

    // Handle the image upload
    if ($request->hasFile('image')) {
        // Generate a unique filename for the new image
        $fileName = time() . '.' . $request->image->getClientOriginalName();

        // Move the new image to the upload directory
        $request->image->move(public_path('upload/image'), $fileName);

        // Check if an old image exists and unlink it
        if (file_exists(public_path('upload/image/' . $cust->image)) && $cust->image != $fileName) {
            unlink(public_path('upload/image/' . $cust->image));
        }

        // Update customer information with the new image filename
        $cust->image = $fileName;
    }

    // Update other customer information
    $cust->name = $request->name;
    $cust->email = $request->email;
    $cust->phone = $request->phone;
    if (!empty($request->password)) {
        $cust->password = Hash::make($request->password);
    }

    // Save the updated customer information
    if ($cust->save()) {
        return response()->json(['message' => 'customer updated successfully'], 201);
    }
}

public function destroy($id)
{
    // Find the record by ID
    $model = Customer::find($id);

    // Check if the record exists
    if (!$model) {
        return response()->json(['message' => 'Record not found'], 404);
    }

    // Delete the record
    $model->delete();

    // Return a response indicating success
    return response()->json(['message' => 'Record deleted successfully'], 200);
}


public function showcust($id)
{
    // Find the record by ID
    $model = Customer::find($id);

    // Check if the record exists
    if (!$model) {
        return response()->json(['message' => 'Record not found'], 404);
    }

    // Return the retrieved record as JSON response
    return response()->json($model, 200);
}

public function index()
{
    $gm = Customer::all();
    return response()->json(['data' => $gm]);
}
}