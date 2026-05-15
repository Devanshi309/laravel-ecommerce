<!DOCTYPE html>
<html>
<head>
    <title>Category List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f4f4f4;
            font-family:Arial, sans-serif;
        }

        .page-wrapper{
            width:100%;
            min-height:100vh;
            padding:40px 20px;
        }

        .card-box{
            background:white;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
        }

        .table th{
            background:#212529;
            color:white;
        }

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
<div class="container page-wrapper">

    <div class="card-box">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h1 class="mb-0">
                Category List
            </h1>

            <a href="{{ route('categories.create') }}"
               class="btn btn-primary">

                Add Category

            </a>

        </div>

        <table class="table table-bordered table-hover text-center align-middle">

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Name</th>

                    <th>Slug</th>

                </tr>

            </thead>

            <tbody>

                @foreach($categories as $category)

                    <tr>

                        <td>{{ $category->id }}</td>

                        <td>{{ $category->name }}</td>

                        <td>{{ $category->slug }}</td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>