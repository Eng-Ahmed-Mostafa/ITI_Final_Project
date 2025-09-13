<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(5);
        return view("Categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => "required|string|max:255",
        ]);

        Category::create($validated);

        return redirect()
            ->route("categories", ['lang' => app()->getLocale()])
            ->with("success", "Category created successfully!");
    }


    /**
     * Display the specified resource.
     */
    public function show(string $lang,Category $category)
    {


        return view("Categories.show", compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $lang,Category $category)
    {
        // dd($category);
        return view("Categories.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $lang, Category $category)
    {
        $validated = $request->validate([
            "title" => "required",
        ]);


        $category->update($validated);

        return redirect()->route("categories", $lang)->with("success", "Updated successfully!");
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $lang,Category $category)
    {
        // dd($lang);
        // dd($category);
        $category->delete();
        return redirect()->route("categories",$lang)->with("success","delete successifly!");
    }
}
