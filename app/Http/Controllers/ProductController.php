<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\order;
use App\Models\Users;
use App\Models\student;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
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
   
    

   public function show(Product $product,Request $request)
{
        //  $count=User::get();
        // $new=product::latest()->limit(10)->get();
       // $id3=product::find(2);
    //    $order=product::OrderBy('name','ASC')->get();
    // $price=product::where('price','>=',50000)->get();
    // $gmail=User::where('email','LIKE','%gmail.%')->get();
    // $name=User::select('name','email')->get();
    // $city=order::select('user_id',DB::raw('count(*) as total'))->groupBy('user_id')->get();
    
    // $update=User::where('id',2)->update(['email'=>'lucky@gmail.com']);
      //  $delete=User::where('id',2)->delete();
     //dd($delete);
        // $usernew=User::find(2);

        // $user=User::where('email','bhavy@gmail.com')->get(); 
       //$delete=student::where('id',2)->delete();
       // dd($delete);
    //    $deleted=User::onlytrashed()->get();
    //    $deleted=User::WithTrashed()->find(1)->restore();
    //    $deleted=User::onlyTrashed()->forceDelete();
    // $json=product::take(5)->get();
    // return response()->json([
    //          'product'=>$json
    // ]);
  //  $product=Order::with('user','product')->latest()->first();
    // dd($product);
   // $array=[];
//    foreach($product as $prd)
//     {
//             $array[] =[
//         $prd->product->name ?? 'xyz',
//         $prd->user->name,
//         $prd->product_price,

//         ];
//     }
// $prd = [];
// $prd[] = [
// $product->product->name ?? 'xyz',
// $product->user->name,
// $product->user_id,
// $product->product_price,
// $product->created_at->format('d-m-y')
// ];       
//   //  $new=$array->latest()->find(1);
//     return response()->json([
//         'array'=>$prd
//     ]);
//dd(Carbon:now()->endOfMonth());
// $new = Product::where('price','>',5000)

//               ->Where('name','ac_lg')

//               ->get();
//               dump($new);
            //   $insert=User::insert('bhavy','bhavy@gmail.com');
            //   $insert=DB::insert();

//     $validator =   $request->validate([

//     'email' => 'required|email' 
// ]);
// dd($validator);
// if($validator){
//        return response()->json([
//             'error' => $validator
//        ]);
// }

//               $user= new User();
//               $user->name='avantika';
//               $user->email='av@gmail.com';
//               $user->password=Hash::Make('123456');
//               $user->save();
//               return $user;


// $select=DB::table('users')->get();
// dd($select);
// public function comment()
// {
//     Post::belongsTo('post');
// }
// public function post()
// {
//     Comment::hastoMany('comment');
// }

// $data = DB::table('product_category')
//         ->select(
//             'category_id',
//             DB::raw('COUNT(*) as total')
//         )
//         ->groupBy('category_id')
//         ->get();
// $data=Order::with('product')->latest()->take(2)->get();

//$user=DB::table('orders')->join('users','orders.user_id','users.id')->get();
// return response()->json([
//     'data'=>$data
// ]);



   

       
   
    $product->load('images','categories');
    $user=User::all();
    return view(
        'product.show',
        compact('user','product')
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

    return redirect()->route('product.index')
         ->with('success', 'Product Updated Successfully!');
}
    public function destroy(Product $product)
    {
         $product->delete();

         return redirect()->route('product.index');
    }
    // Create Form
    public function create()
    {
            //dd('route working');
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

    return redirect()->route('product.index')
          ->with('success','Product Added Successfully!');
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