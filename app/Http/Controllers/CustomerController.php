<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
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
     public function list(Request $request)
 {
     if (!$request->ajax()) {
         return response()->json([
           "status" => "fail",
           "message" => "Bad Request."
         ], 401);
       }
   
       $list = Customer::where('isDeleted',0)->get();
       return datatables($list)
         ->addIndexColumn()
         ->addColumn('action', function ($row) {          
            return '<a href="'.route('customer.get',($row->id)).'" class="btn btn-outline-info btn-sm mr-p5"><i class="fa fa-edit" aria-hidden="true"></i></a>
            <button type="button" onclick="customerdeleted(' . ($row->id) . ')" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt" aria-hidden="true"></i></button>';
          })
         ->addColumn('image', function (Customer $image) {
            return '<img src="' . asset('upload/image/' . $image->image) . '" alt="Image" width="100">';
        })
         ->rawColumns(['action','image'])
         ->make(true); 
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
      // $cust->save();
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
   
     
}
