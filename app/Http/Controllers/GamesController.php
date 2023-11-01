<?php

namespace App\Http\Controllers;
use App\Games;
use Illuminate\Support\Facades\Validator;
use DataTables;


use Illuminate\Http\Request;

class GamesController extends Controller
{
 public function index(){

  $uicongfig = [
    'title' => "Games",
    'header' => "Games",
    'active' => "games",
];  
    return view('games.index',compact('uicongfig'));
 }


 public function get(Request $request)
 {
  //echo"<pre>";print_r($request->All());exit;
     return Games::where('id',$request->id)->first();
 }

 public function list(Request $request)
 {
 // echo"<pre>";print_r($request->All());exit;
     if (!$request->ajax()) {
         return response()->json([
           "status" => "fail",
           "message" => "Bad Request."
         ], 401);
       }
   
       $list = Games::where('isDeleted',0)->get();
       return datatables($list)
         ->addIndexColumn()
         ->addColumn('action', function ($row) {          
           return '<button type="button"  onclick="edit(' . ($row->id) . ')" class="btn btn-outline-info btn-sm mr-p5"><i class="fa fa-edit" aria-hidden="true"></i></button>
           <button type="button" onclick="gamedeleted(' . ($row->id) . ')"class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt" aria-hidden="true"></i></button>';
         })
         ->rawColumns(['action'])
         ->make(true); 
  //echo"<pre>";print_r($list);exit;


 }


 public function store(Request $request)
 {
  //echo"<pre>";print_r($request->All());exit;

  $validator = Validator::make($request->all(), [
    'name' => 'required|max:255',
    'start_time' => 'required',
    'end_time' => 'required|after:start_time',
], [
    'name.required' => 'The name field is required.',
    'start_time.required' => 'The start time field is required.',
    'end_time.required' => 'The end time field is required.',
    'end_time.after' => 'The end time must be after the start time.', 
]);
     if ($validator->fails()) {
         return response()->json(array(
           'error' => 1,
           'vderror' => 1,
           'errors' => $validator->getMessageBag()->toArray(),
         ), 200);
       }

       $games = new Games();
       $games->name = $request->name;
       $games->start_time = $request->start_time;
       $games->end_time = $request->end_time;
       if($games->save()){
         return response()->json(array(
             'error' => 0,
             'msg' => "games has been created successfully."
           ), 200);
         } else {
           return response()->json(array(
             'error' => 1,
             'msg' => "games failed to create."
           ), 200);
         }
        // echo"<pre>";print_r($games);exit;
       
 }


 public function edit(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'start_time' => 'required',
        'end_time' => 'required|after:start_time',
    ], [
        'name.required' => 'The name field is required.',
        'start_time.required' => 'The start time field is required.',
        'end_time.required' => 'The end time field is required.',
        'end_time.after' => 'The end time must be after the start time.', 
    ]);
        if ($validator->fails()) {
            return response()->json(array(
              'error' => 1,
              'vderror' => 1,
              'errors' => $validator->getMessageBag()->toArray(),
            ), 200);
          }
          $games =Games::where('id',$request->id)->first();
          $games->name = $request->name;
          $games->start_time = $request->start_time;
          $games->end_time = $request->end_time;
          if($games->save()){
            return response()->json(array(
                'error' => 0,
                'msg' => "games has been created successfully."
              ), 200);
            } else {
              return response()->json(array(
                'error' => 1,
                'msg' => "games failed to create."
              ), 200);
            }
    }


    public function delete(Request $request)
    {
      if(Games::softDelete(['id'=>$request->id]))
      {
        return response()->json(array(
          'error' => 0,
          'msg' => "Games has been deleted successfully."
        ), 200);
      } else {
        return response()->json(array(
          'error' => 1,
          'msg' => "Games failed to update."
        ), 200);
      }
    }
}

 
