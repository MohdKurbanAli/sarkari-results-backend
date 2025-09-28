<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Tag::orderBy('id', 'desc')->get();
        return view('tag.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',            
            'is_active' => 'required|in:0,1',
        ]);

        $is_created = Tag::create($request->all());

        if($is_created){
            return 1;
        }else{
            return 0;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string|max:255',            
            'is_active' => 'required|in:0,1',
        ]);

        $is_updated = $tag->update($request->all());
        if($is_updated){
            return 1;
        }else{
            return 0;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $tag = Tag::find($request->id);
        if($tag){
            $tag->delete();
            return response()->json([
                'status' => true,
                'message' => 'Tag deleted successfully',
                'redirect_url' => route('tag.index')
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Tag not found',
                'redirect_url' => ''
            ]);
        }
    }
}
