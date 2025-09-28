<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    
    public function index(Category $category)
    {                
        $data = Post::where('category_id', $category->id)->with('category:id,name')->orderBy('id', 'desc')->get();

        return view('post.index', compact('data', 'category'));

    }

    public function editpost(Category $category, Post $post)
    {
        $post->job_image = json_decode($post->job_image) ?? null;
        if($post->job_image){
            $post->job_image = implode(',', $post->job_image);
        }
        $post->job_post_faq = json_decode($post->job_post_faq) ?? null;        
        return view('post.edit', compact('post', 'category'));
    }

    public function savepost(Category $category, Post $post, Request $request)
    {
        // dd($request->all());
        $request->validate([
            'job_image' => 'nullable',
            'description' => 'required|string|max:5000',            
            'organisation_name' => 'nullable|string|max:500',
            'total_vacancies' => 'required|numeric',
            'application_mode' => 'required|in:0,1,2',
            'job_location' => 'nullable|string|max:500',
            'important_dates' => 'required|string|max:10000',
            'application_fee_points' => 'required|string|max:10000',
            'age_header' => 'required|string|max:5000',
            'age_points' => 'required|string',
            'job_post_datails' => 'required|string',
            'job_post_useful_links' => 'required|string',
            'faq' => 'required|array',
            'meta_title' => 'required|string',
            'meta_description' => 'required|string',
            'meta_keywords' => 'required|string',
            'page_header_script' => 'required|string',
            'page_footer_script' => 'required|string',
            'is_active' => 'required|in:0,1,2'
        ]);
        
        $imagePaths = null;
        if ($request->hasFile('job_image')) {
            foreach ($request->file('job_image') as $image) {
                $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/posts');
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }
                $image->move($destinationPath, $imageName);
                $imagePaths[] = 'uploads/posts/' . $imageName; 
            }
        }

        if($imagePaths){
            $post->job_image = json_encode($imagePaths);
        }

        $post->description = $request->description ?? null;
        $post->organisation_name = $request->organisation_name ?? null;
        $post->total_vacancies = $request->total_vacancies ?? null;
        $post->application_mode = $request->application_mode ?? null;
        $post->job_location = $request->job_location ?? null;
        $post->important_dates = $request->important_dates ?? null;
        $post->application_fee_points = $request->application_fee_points ?? null;
        $post->age_header = $request->age_header ?? null;
        $post->age_points = $request->age_points ?? null;
        $post->job_post_datails = $request->job_post_datails ?? null;
        $post->job_post_useful_links = $request->job_post_useful_links ?? null;

        $post->meta_title = $request->meta_title ?? null;
        $post->meta_description = $request->meta_description ?? null;
        $post->meta_keywords = $request->meta_keywords ?? null;
        $post->page_header_script = $request->page_header_script ?? null;
        $post->page_footer_script = $request->page_footer_script ?? null;        

        $post->job_post_faq = json_encode($request->faq) ?? null;
        $post->is_active = $request->is_active;

        if($post->save()){
            return response()->json([
                'status' => true,
                'message' => 'Post Published successfully',                
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Something went wrong',                
        ]);

    }

    public function deletepost(Request $request)
    {
        $post = Post::where('id', $request->id)->first();
        $category_id = $post->category_id;
        if($post){
            $post->delete();
            return response()->json([
                'status' => true,
                'message' => 'Post deleted successfully',
                'redirect_url' => url("/".$category_id)
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Something Went Wrong'
        ]);

    }

}
