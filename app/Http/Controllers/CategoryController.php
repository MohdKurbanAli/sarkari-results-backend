<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::orderBy('id', 'desc')->get();
        return view('category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required|string',
            'meta_title' => 'required|string',
            'meta_description' => 'required|string',
            'meta_keywords' => 'required|string',
            'page_header_script' => 'nullable|string',
            'page_footer_script' => 'nullable|string',
            'is_active' => 'required|in:0,1',
        ]);

        $is_created = Category::create($request->all());

        if($is_created){
            return 1;
        }else{
            return 0;
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required|string',
            'meta_title' => 'required|string',
            'meta_description' => 'required|string',
            'meta_keywords' => 'required|string',
            'page_header_script' => 'nullable|string',
            'page_footer_script' => 'nullable|string',
            'is_active' => 'required|in:0,1',
        ]);

        $is_updated = $category->update($request->all());
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
        $category = Category::find($request->id);
        if($category){
            $category->delete();
            return response()->json([
                'status' => true,
                'message' => 'Category deleted successfully',
                'redirect_url' => route('category.index')
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Category not found',
                'redirect_url' => ''
            ]);
        }
    }
}
