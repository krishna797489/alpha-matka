<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Groups;
use Illuminate\Http\Request;

class groupsapiController extends Controller
{
    //ye post groups ki api
    public function addgroup(Request $request)
    {
        
        $user = new Groups;
        $user->name = $request->name;
        $user->link = $request->link;
        $user->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('public/image/', $filename);
            $user->image = $filename;
        }
        $user->category_id = $request->category_id;
        $user->is_link = $request->is_link;
        $user->save();
        return response()->json([
            'message' => "Successfully Add..",
            'status' => true

        ]);
    }

    //ye get groups ki api 
    public function index(Request $request)
{
    $groups = Groups::where('status', 0)->paginate(10); // Filter by status = 0

    return response()->json([
        'data' => $groups,
        'status' => true,
    ]);
}

    //get whatsapp ki api
    public function getwhatsapp(Request $request){
        $groups = Groups::where('is_link','=',0)->where('status','=',0)->orderBy('id', 'desc')->paginate(20);

            return response()->json([
                'data'=> $groups,
                'status'=> true,
            ]);
    }
    public function gettelegram(Request $request){
        $groups = Groups::where('is_link','=',1)->where('status','=',0)->orderBy('id', 'desc')->paginate(20);
            return response()->json([
                'data'=> $groups,
                'status'=> true,
            ]);
    }

   
            public function update(Request $request, $id)
            {
                $views = Groups::find($id);
        
                if (!$views) {
                    return response()->json(['message' => 'view not found'], 404);
                }
        
                $views->views = $request->input('views');
                $views->save();
                return response()->json([
                    'data' => $views, 
                    'status' => true
                ]);
            }
            public function count(Request $request, $id)
            {
                $count = Groups::find($id);
        
                if (!$count) {
                    return response()->json(['message' => 'count not found'], 404);
                }
                $count->count = $count->count+1;
                $count->save();
                return response()->json([
                    'data' => $count, 
                    'status' => true
                ]);
            }

    //category api

    //get api
    public function getcategory()
    {
        $categoroies = category::all();
        return response()->json([
            'data' => $categoroies,
            'status' => true
        ]);
    }

    //post api
    public function category(Request $request)
    {

        $category = new category;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('public/image/', $filename);
            $category->image = $filename;
        }
        $category->category = $request->category;
        $category->save();
        return response()->json([
            'message' => "Successfully Add..",
            'status' => true
        ]);
    }



//get category id api
    public function getGroupsByCategoryId($categoryId)
    {
        $groups = Groups::where('category_id', $categoryId)->get();
        if ($groups->isEmpty()) {
            return response()->json([
                'message' => 'No groups found for the specified category ID.',
            ]);
        }

        return response()->json([
            'groups' => $groups
        ]);
    }


    public function getGroupsByCategorywhatsapp($category_id)
    {
        $groups = Groups::where('category_id', $category_id)
                       ->where('is_link', 0)
                       ->get();
                       
    if ($groups->isEmpty()) {
        return response()->json([
            'message' => 'No any whataspp group.',
        ]);
    }


        return response()->json([
            'groups' => $groups
        ]);
    }

    
    public function getGroupsByCategorytelegram($category_id)
    {
        $groups = Groups::where('category_id', $category_id)
                       ->where('is_link', 1)
                       ->get();

                       if ($groups->isEmpty()) {
                        return response()->json([
                            'message' => 'No any telegram group.',
                        ]);
                    }

        return response()->json([
            'groups' => $groups
        ]);
    }

    // new add group show 
    public function newshow()

    {
        $groups = Groups::orderBy('id', 'desc')->limit(5)->get();
        return response()->json($groups);
    }
    
   

}

    
       
    
    
    

