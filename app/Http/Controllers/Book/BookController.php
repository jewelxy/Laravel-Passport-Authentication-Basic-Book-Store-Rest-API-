<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book\BookModel;
use Illuminate\Http\Request;
use Auth;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            if(Auth::guard('api')->check()){$result = BookModel::all();
                $data = [];
                foreach($result as $res){
                    $data[] = [
                                'id'=>$res->id,
                                'name'=>$res->name,
                                'description'=>$res->description,
                                'image'=>$res->image,
                                'created_by'=>$res->created_by, 
                                'updated_by'=>$res->updated_by, 
                                'created_at'=>$res->created_at, 
                                'updated_at'=>$res->updated_at
                    ];
                }
    
                return response()->json($data);
            }else{
                    return Response(['data' => 'Unauthorized'],401);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     if (Auth::guard('api')->user()->usertype === 'admin') {
    //         $result = BookModel::create([
    //             "name" => $request->input('name'),
    //             "description" => $request->input('description'),
    //             "image" => $request->input('image'),
    //         ]);
    //         return response()->json($result, 201);
    //     } else {
    //         return response()->json(['data' => 'Unauthorized user submission'], 401);
    //     }
    // }

    public function store(Request $request)
{
    if (Auth::guard('api')->user()->usertype === 'admin') {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // adjust max size as needed
        ]);

        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->storeAs('public/images', $imageName);

        $result = BookModel::create([
            "name" => $validatedData['name'],
            "description" => $validatedData['description'],
            "image" => $imageName,
        ]);
        
        return response()->json($result, 201);
    } else {
        return response()->json(['data' => 'Unauthorized user submission'], 401);
    }
}
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $result = BookModel::where('id', $id)->get();
        $data = [];
        foreach ($result as $res) {
            $data[] = [
                'id'=>$res->id,
                'name'=>$res->name,
                'description'=>$res->description,
                'image'=>$res->image,
                'created_by'=>$res->created_by, 
                'updated_by'=>$res->updated_by, 
                'created_at'=>$res->created_at, 
                'updated_at'=>$res->updated_at
            ];
        }
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    if (Auth::guard('api')->check()) {
        $user = Auth::guard('api')->user();
        
        if ($user->usertype === 'admin') {
            $bookdetails = BookModel::find($id);
    
            if (!$bookdetails) {
                return response()->json(['Status' => 'Failed', 'message' => 'Book details not found'], 404);
            }
            
            $bookdetails->update([
                "name" => $request->input('name'),
                "description" => $request->input('description'),
                "image" => $request->input('image'),
            ]);
    
            return response()->json(['Status' => 'Success', 'message' => 'Book details updated successfully'], 200);
        } else {
            return response()->json(['Status' => 'Failed', 'message' => 'Unauthorized'], 401);
        }
    } else {
        return response()->json(['Status' => 'Failed', 'message' => 'Unauthorized'], 401);
    }
}

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Auth::guard('api')->check()) {
            $user = Auth::guard('api')->user();
            
            if ($user->usertype === 'admin') {
                $book = BookModel::find($id);
        
                if (!$book) {
                    return response()->json(['Status' => 'Failed', 'message' => 'Book not found'], 404);
                }
                
                $book->delete();
        
                return response()->json(['Status' => 'Success', 'message' => 'Book deleted successfully'], 200);
            } else {
                return response()->json(['Status' => 'Failed', 'message' => 'Unauthorized'], 401);
            }
        } else {
            return response()->json(['Status' => 'Failed', 'message' => 'Unauthorized'], 401);
        }
    }
    
}
