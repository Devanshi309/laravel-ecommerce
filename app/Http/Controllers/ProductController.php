<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Product List
    public function index()
    {
   $products = Product::with('categories')
            ->paginate(5);
    //  $products = Product::paginate(5);

    return view('product.index', compact('products'));
    }
    /*  return view('product.index'); */
   
    

   public function show(Product $product)
{
    $product->load('images','categories');

    return view(
        'product.show',
        compact('product')
    );
}
public function edit(Product $product)
{
    $categories = Category::all();

    return view(
        'product.edit',
        compact('product','categories')
    );
}
   public function update(Request $request, Product $product)
{
    $data = [

        'name' => $request->name,

        'slug' => Str::slug($request->name).'-'.rand(1000,9999),

        'price' => $request->price,

        'description' => $request->description,

     
    ];

    // Single Image Update
    if($request->hasFile('image'))
    {
        $productName = Str::slug($request->name);

        $randomNumber = rand(1000,9999);

        $imageName = $productName.'-'.$randomNumber.'.'.$request->image->getClientOriginalExtension();

        $request->image->storeAs(
            'products',
            $imageName,
            'public'
        );

        $data['image'] = $imageName;
    }

    $product->update($data);
    $product->categories()->sync(
    $request->categories
);

    // Multiple Images Upload
    if($request->hasFile('images'))
    {
        foreach($request->file('images') as $img)
        {
            $productName = Str::slug($request->name);

            $randomNumber = rand(1000,9999);

            $extension = $img->getClientOriginalExtension();

            $multiImage = $productName.'-'.$randomNumber.'.'.$extension;

            $img->storeAs(
                'products',
                $multiImage,
                'public'
            );

            ProductImage::create([
                'product_id' => $product->id,
                'image' => $multiImage
            ]);
        }
    }

    return redirect()->route('product.index');
}
    public function destroy(Product $product)
    {
         $product->delete();

         return redirect()->route('product.index');
    }
    // Create Form
    public function create()
    {
        $categories = Category::all();

    return view(
        'product.create',
        compact('categories')
    );
    }

    // Save Product
    public function store(Request $request)
    {
          $request->validate([

    'name' => 'required',

    'price' => 'required',

    'description' => 'required',

    'categories' => 'required',

    'image' => 'required|image',
]);
    

    // Single Image Upload
   $productName = Str::slug($request->name);

$randomNumber = rand(1000,9999);

$imageName = $productName.'-'.$randomNumber.'.'.$request->image->extension();

$request->image->storeAs(
    'products',
    $imageName,
    'public'
);

    // Insert Product
    $product = Product::create([

        'image' => $imageName,

        'name' => $request->name,

          'slug' => Str::slug($request->name).'-'.rand(1000,9999),

        'price' => $request->price,

        'description' => $request->description,

    ]);
    
     $product->categories()->attach(
        $request->categories
    );

    // Multiple Images Upload
    // Multiple Images Upload
if($request->hasFile('images'))
{
    foreach($request->file('images') as $img)
    {
        $productName = Str::slug($request->name);

        $randomNumber = rand(1000,9999);

        $extension = $img->getClientOriginalExtension();

        $multiImage = $productName.'-'.$randomNumber.'.'.$extension;

        $img->storeAs(
            'products',
            $multiImage,
            'public'
        );

        ProductImage::create([
            'product_id' => $product->id,
            'image' => $multiImage
        ]);
    }
}

    return redirect()->route('product.index');
    }

    public function getProducts(Request $request)
    {
     if($request->ajax())
     {
          $data =Product::with('categories')
                ->select('products.*');

          return DataTables::of($data)

            ->addIndexColumn()

            ->addColumn('image', function($row){

                return '
                    <img 
                        src="'.asset('storage/products/'.$row->image).'" 
                        width="70"
                    >
                ';
            })

            ->addColumn('category', function($row){

                return $row->categories->pluck('name')->implode(', ');
            })

            ->rawColumns(['image'])

            ->make(true);
    }
}
}