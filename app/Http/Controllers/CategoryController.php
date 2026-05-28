<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Mpdels\Product;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $categories = Category::all();
    $all=Category::with('Products')->get();
   
    // return response()->json([
    //     'data'=>$all
    // ]);
    return view(
        'categories.index',
        compact('categories')
    );
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //  return view('categories.create');
          $parents = Category::whereNull('parent_id')->get();
        return view(
        'categories.create',
        compact('parents')
            );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|unique:categories'
    ]);

    $imageName = null;

    // Upload Image
    if($request->hasFile('image'))
    {
        $imageName = time().'.'.$request->image->extension();

        $request->image->storeAs(
            'categories',
            $imageName,
            'public'
        );
    }

    Category::create([

       
        'parent_id' => $request->parent_id,

        'name' => $request->name,

        // 'slug' => Str::slug($request->name),

        'image' => $imageName

    ]);

     return redirect()->route('categories.index')
         ->with('success', 'Category added successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
