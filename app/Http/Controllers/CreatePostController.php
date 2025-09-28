<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CreatePostController extends Controller
{
    
    public function index()
    {
        $categories = Category::all();
        return view('post.new.create', compact('categories'));
    }

    public function create(Request $request)
    {
        // dd($request->all());
        $post = new Post();

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;

        if($post->save()){
            return response()->json([
                'status' => true,
                'message' => 'Successfully post created',
                'post_id' => $post->id
            ]);
        }else {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create post',
                'post_id' => ''
            ]);
        }

    }

    public function editnew(Post $post)
    {
        $post->load('category');
        return view('post.new.index', compact('post'));
    }

    public function savenewpost(Post $post, Request $request)
    {
        
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
        $post->job_post_faq = json_encode($request->faq) ?? null;

        $post->meta_title = $request->meta_title ?? null;
        $post->meta_description = $request->meta_description ?? null;
        $post->meta_keywords = $request->meta_keywords ?? null;
        $post->page_header_script = $request->page_header_script ?? null;
        $post->page_footer_script = $request->page_footer_script ?? null;   

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

}
