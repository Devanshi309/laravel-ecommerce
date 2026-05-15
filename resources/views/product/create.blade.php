<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:Arial, sans-serif;
    }

    body{
        background:#f4f4f4;
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:center;
        min-height:100vh;
    }

    .form-container{
        width:400px;
        background:#fff;
        padding:30px;
        border-radius:10px;
        box-shadow:0 0 10px rgba(0,0,0,0.1);
    }

    .form-container h2{
        text-align:center;
        margin-bottom:20px;
        color:#333;
    }

    .form-group{
        margin-bottom:15px;
    }

    .form-group label{
        display:block;
        margin-bottom:5px;
        font-weight:bold;
        color:#555;
    }

    .form-group input,
    .form-group textarea,
    .form-group select{
        width:100%;
        padding:10px;
        border:1px solid #ccc;
        border-radius:5px;
        outline:none;
        transition:0.3s;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus{
        border-color:#007bff;
    }

    .form-group textarea{
        resize:none;
        height:100px;
    }

    .btn{
        width:100%;
        padding:12px;
        border:none;
        background:#007bff;
        color:white;
        font-size:16px;
        border-radius:5px;
        cursor:pointer;
        transition:0.3s;
    }

    .btn:hover{
        background:#0056b3;
    }
</style>
<h1>Create Product</h1>

<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

     <div class="form-group">
            <label>Product Name</label>
    <input type="text" name="name" placeholder="Product Name"></div>

     <div class="form-group">
            <label>Price</label>
    <input type="text" name="price" placeholder="Price"></div>

         <div class="form-group">
            <label>Description</label>
    <textarea name="description"></textarea></div>

     <div class="form-group">
            <label>Category</label>
    <select name="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </select></div>

    <!-- Single Image -->
     <div class="form-group">
            <label>Image</label>
    <input type="file" name="image"></div>

    <!-- Multiple Images -->
      <div class="form-group">
            <label>Multiple Image</label>
    <input type="file" name="images[]" multiple></div>

    <button type="submit" class="btn">
        Save Product
    </button><br>
</form>