<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(5);
        return view("Posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();  
        return view("Posts.create",compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => "required|string|max:255",
            "body" => "required|string",
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            "published_at" => "required|date",
            "category_id" => 'required'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public'); 
            $validated['image'] = $path;
        }

        Post::create($validated);

        return redirect()
            ->route("posts", ['lang' => app()->getLocale()])
            ->with("success", "Post created successfully!");
    }


    /**
     * Display the specified resource.
     */
    public function show(string $lang,Post $post)
    {


        return view("Posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $lang,Post $post)
    {
        $categories = Category::all();
        // dd($post);
        return view("Posts.edit", compact("post","categories"));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $lang, Post $post)
    {
        $validated = $request->validate([
            "title" => "required",
            "body" => "required",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "published_at"=> "required|date",
            "category_id" => 'required'
        ]);

        
        if ($request->hasFile("image")) {
            // dd($post->image);
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }

            $path = $request->file('image')->store('images', 'public');
            $validated['image'] = $path;
        }


        $post->update($validated);

        return redirect()->route("posts", $lang)->with("success", "Updated successfully!");
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $lang,Post $post)
    {
        // dd($lang);
        // dd($post);
        $post->delete();
        return redirect()->route("posts",$lang)->with("success","delete successifly!");
    }
}
