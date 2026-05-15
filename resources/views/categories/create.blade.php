<!DOCTYPE html>
<html>
<head>
    <title>Create Category</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f4f4f4;
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            font-family:Arial, sans-serif;
        }

        .form-card{
            width:100%;
            max-width:450px;
            background:white;
            padding:30px;
            border-radius:12px;
            box-shadow:0 0 15px rgba(0,0,0,0.1);
        }

        .form-title{
            text-align:center;
            margin-bottom:25px;
            font-weight:bold;
            color:#333;
        }

    </style>

</head>
<body>

<div class="form-card">

    <h2 class="form-title">
        Create Category
    </h2>

    <form action="{{ route('categories.store') }}"
          method="POST">

        @csrf

        <div class="mb-3">

            <label class="form-label fw-bold">
                Category Name
            </label>

            <input type="text"
                   name="name"
                   class="form-control"
                   placeholder="Enter Category Name">

        </div>

        <button type="submit"
                class="btn btn-primary w-100">

            Save Category

        </button>

        <a href="{{ route('categories.index') }}"
           class="btn btn-dark w-100 mt-3">

            Back

        </a>

    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>