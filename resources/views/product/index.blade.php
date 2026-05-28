<!DOCTYPE html>
<html>

<head>
    <title>Products</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f4f4;
            padding: 30px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .top-bar h1 {
            color: #333;
        }

        .add-btn {
            text-decoration: none;
            background: #007bff;
            color: white;
            padding: 10px 18px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .add-btn:hover {
            background: #0056b3;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .product-card h3 {
            color: #333;
            margin-bottom: 10px;
        }

        .price {
            color: #007bff;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .category {
            color: #777;
            margin-bottom: 15px;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .btn {
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 5px;
            color: white;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }

        .view-btn {
            background: #28a745;
        }

        .edit-btn {
            background: #ffc107;
            color: black;
        }

        .delete-btn {
            background: #dc3545;
            width: 100%;
        }

        .modal {
            z-index: 1055 !important;
        }

        .modal-dialog {
            max-width: 600px;
        }

        .modal-body {
            text-align: left;
            word-wrap: break-word;
        }

        /* 
    .pagination{
        margin-top:10px;
        display:flex;
        flex-direction:column;
        justify-content:center;
    } */
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
     @include('product.nav')
    <div class="container">
      
        @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert">
            </button>

        </div>

        @endif
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

                    <a href="{{ route('product.show',$product->id) }}" class="btn view-btn">

                        View

                    </a>

                    <a href="{{ route('product.edit',$product->id) }}" class="btn edit-btn">
                        Edit
                    </a>

                </div>

                <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#descModal{{$product->id}}">
                    Description

                </button>
                <button class="btn delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{$product->id}}">
                    Delete
                </button>

            </div>
            <!-- Description Modal -->

            <div class="modal fade" id="descModal{{$product->id}}" tabindex="-1">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title">

                                {{ $product->name }}

                            </h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>

                        </div>

                        <div class="modal-body">

                            <p>

                                {{ $product->description }}

                            </p>

                        </div>

                        <div class="modal-footer">

                            <button class="btn btn-secondary" data-bs-dismiss="modal">

                                Close

                            </button>

                        </div>

                    </div>

                </div>

            </div>
            <!--delete modal-->
            <!-- Delete Modal -->

            <div class="modal fade" id="deleteModal{{$product->id}}" tabindex="-1">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title">

                                Delete Product

                            </h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal">

                            </button>

                        </div>

                        <div class="modal-body">

                            <p>

                                Are you sure you want to delete

                                <strong>{{$product->name}}</strong> ?

                            </p>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                                Cancel

                            </button>

                            <form action="{{ route('product.destroy',$product->id)}}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">

                                    Yes Delete

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

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