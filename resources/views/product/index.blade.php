<!DOCTYPE html>
<html>
<head>
    <title>Products</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:Arial, sans-serif;
    }

    body{
        background:#f4f4f4;
        padding:30px;
    }

    .container{
        max-width:1200px;
        margin:auto;
    }

    .top-bar{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:25px;
    }

    .top-bar h1{
        color:#333;
    }

    .add-btn{
        text-decoration:none;
        background:#007bff;
        color:white;
        padding:10px 18px;
        border-radius:5px;
        transition:0.3s;
    }

    .add-btn:hover{
        background:#0056b3;
    }

    .product-grid{
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
        gap:20px;
    }

    .product-card{
        background:white;
        border-radius:10px;
        padding:15px;
        box-shadow:0 0 10px rgba(0,0,0,0.1);
        text-align:center;
        transition:0.3s;
    }

    .product-card:hover{
        transform:translateY(-5px);
    }

    .product-card img{
        width:100%;
        height:200px;
        object-fit:cover;
        border-radius:8px;
        margin-bottom:15px;
    }

    .product-card h3{
        color:#333;
        margin-bottom:10px;
    }

    .price{
        color:#007bff;
        font-size:18px;
        font-weight:bold;
        margin-bottom:8px;
    }

    .category{
        color:#777;
        margin-bottom:15px;
    }

    .btn-group{
        display:flex;
        justify-content:center;
        gap:10px;
        margin-bottom:10px;
    }

    .btn{
        text-decoration:none;
        padding:8px 14px;
        border-radius:5px;
        color:white;
        font-size:14px;
        border:none;
        cursor:pointer;
    }

    .view-btn{
        background:#28a745;
    }

    .edit-btn{
        background:#ffc107;
        color:black;
    }

    .delete-btn{
        background:#dc3545;
        width:100%;
    }
/* 
    .pagination{
        margin-top:10px;
        display:flex;
        flex-direction:column;
        justify-content:center;
    } */
</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">
            Laravel CRUD
        </a>

        <div>

            <a href="{{ route('product.index') }}"
               class="btn btn-outline-light me-2">

                Products

            </a>
            <a href="{{ route('categories.store') }}"
                class="btn btn-outline-info">
                         Categories
            </a>

            <a href="{{ route('product.create') }}"
               class="btn btn-primary">

                Add Product

            </a>

        </div>

    </div>
</nav>
<div class="container">

    <div class="top-bar">

        <h1>Product List</h1>

    </div>

  <div class="product-grid">

        @foreach($products as $product)

            <div class="product-card">

                <img src="{{ asset('storage/products/'.$product->image) }}">

                <h3>{{ $product->name }}</h3>

                <p class="price">
                    ₹{{ $product->price }}
                </p>

                <p class="category">
                  {{ $product->categories->pluck('name')->implode(', ') }}
                </p>

                <div class="btn-group">

                    <a href="{{ route('product.show',$product->id) }}"
                       class="btn view-btn">

                        View

                    </a>

                    <a href="{{ route('product.edit',$product->id) }}"
                       class="btn edit-btn">

                        Edit

                    </a>

                </div>

                <form action="{{ route('product.destroy',$product->id) }}"
                      method="POST">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn delete-btn">

                        Delete

                    </button>

                </form>

            </div>

        @endforeach

    </div> 

    <div class="mt-4">
        {{ $products->links() }}
    </div>  
{{-- 
    <table id="productTable" class="display">

    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
        </tr>
    </thead>
      

</table>


<script>

$(document).ready(function(){

    $('#productTable').DataTable({

        processing: true,

        serverSide: true,

        ajax: "{{ route('product.data') }}",

        columns: [

            {
                data: 'id',
                name: 'id'
            },

            {
                data: 'image',
                name: 'image',
                orderable: false,
                searchable: false
            },

            {
                data: 'name',
                name: 'name'
            },

            {
                data: 'price',
                name: 'price'
            },

            {
                data: 'category',
                name: 'category'
            }

        ]
    });

}); --}}

</script>
</div>
</body>