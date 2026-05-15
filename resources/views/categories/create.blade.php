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
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <!-- Parent Category -->

    <label>Parent Category</label>

    <select name="parent_id">

        <option value="">
            Main Category
        </option>

        @foreach($parents as $parent)

            <option value="{{ $parent->id }}">

                {{ $parent->name }}

            </option>

        @endforeach

    </select>

    <br><br>

    <!-- Name -->

    <input type="text"
           name="name"
           placeholder="Category Name">

    <br><br>

    <!-- Image -->

    <input type="file" name="image">

    <br><br>

    <button type="submit">

        Save Category

    </button>

</form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>