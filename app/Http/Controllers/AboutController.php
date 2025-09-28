<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    
    public function index()
    {
        $about = About::first();
        return view('about.index', compact('about'));
    }

    public function save(Request $request)
    {        
        $request->validate([
            'site_name' => 'required|string|max:255',
            'logo' => 'required',
            'favicon' => 'required',
            'email' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'main_header_scripts' => 'nullable|string',
            'main_footer_scripts' => 'nullable|string',
        ]);

        $logo = null;
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');            
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/about');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            $image->move($destinationPath, $imageName);
            $logo = 'uploads/about/' . $imageName; 
            
        }

        $favicon = null;
        if ($request->hasFile('favicon')) {
            $image = $request->file('favicon');            
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/about');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            $image->move($destinationPath, $imageName);
            $favicon = 'uploads/about/' . $imageName;             
        }

        $about = About::first();
        $about->site_name = $request->site_name;
        if($logo){
            $about->logo = $logo;
        }
        if($favicon)
        {
            $about->favicon = $favicon;
        }
        
        $about->email = $request->email ?? null;
        $about->number = $request->number ?? null;
        $about->address = $request->address ?? null;
        $about->meta_title = $request->meta_title ?? null;
        $about->meta_description = $request->meta_description ?? null;
        $about->meta_keywords = $request->meta_keywords ?? null;
        $about->main_header_scripts = $request->main_header_scripts ?? null;
        $about->main_footer_scripts = $request->main_footer_scripts ?? null;

        if($about->save()){
            return response()->json([
                'status' => true,
                'message' => 'success',
                'redirect_url' => route('about.index')
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Failed to save',
                'redirect_url' => ''
            ]);
        }        

    }

}
