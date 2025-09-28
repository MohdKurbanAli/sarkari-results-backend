<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Special;
use Illuminate\Http\Request;

class HomeSpecialPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        $data = Special::orderBy('id', 'desc')->get();
        return view('special.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('special.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'post_id' => 'required|numeric|exists:posts,id',            
            'is_active' => 'required|in:0,1',
        ]);

        $is_created = Special::create($request->all());

        if($is_created){
            return response()->json([
                'status' => true,
                'message' => 'Successfully saved post',                
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Failed to save post',                
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Special $special)
    {
        $categories = Category::all();
        $special->load('post');        
        return view('special.edit', compact('special', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Special $special)
    {
        $request->validate([
            'name' => 'required|string|max:255', 
            'post_id' => 'required|numeric|exists:posts,id',              
            'is_active' => 'required|in:0,1',
        ]);

        $is_updated = $special->update($request->all());
        if($is_updated){
            return response()->json([
                'status' => true,
                'message' => 'Successfully updated post',                
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Failed to update post',                
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $special = Special::find($request->id);
        if($special){
            $special->delete();
            return response()->json([
                'status' => true,
                'message' => 'Special deleted successfully',
                'redirect_url' => route('special.index')
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Special not found',
                'redirect_url' => ''
            ]);
        }
    }

    public function fetch_category_post(Request $request)
    {
        
        $posts = Post::where('category_id', $request->category_id)->orderBy('id', 'desc')->get();

        if($posts->isNotEmpty()){
            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $posts
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'post not found',
                'data' => null
            ]);
        }


    }

}
