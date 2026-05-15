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
        justify-content:center;
        align-items:center;
        min-height:100vh;
    }

    .form-container{
        width:450px;
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

    .form-group input,
    .form-group textarea,
    .form-group select{
        width:100%;
        padding:10px;
        border:1px solid #ccc;
        border-radius:5px;
        outline:none;
        font-size:15px;
    }

    .form-group textarea{
        height:100px;
        resize:none;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus{
        border-color:#007bff;
    }

    .btn{
        width:100%;
        padding:12px;
        background:#007bff;
        border:none;
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

<div class="form-container">

    <h2>Update Product</h2>

    <form action="{{ route('product.update',$product->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="form-group">
            <input type="text"
                   name="name"
                   value="{{ $product->name }}"
                   placeholder="Product Name">
        </div>

        <div class="form-group">
            <input type="text"
                   name="price"
                   value="{{ $product->price }}"
                   placeholder="Price">
        </div>

        <div class="form-group">
            <textarea name="description"
                      placeholder="Description">{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <select name="category_id">

                @foreach($categories as $category)

                    <option value="{{ $category->id }}"
                        {{ $product->category_id == $category->id ? 'selected' : '' }}>

                        {{ $category->name }}

                    </option>

                @endforeach

            </select>
        </div>

        <div class="form-group">
            <input type="file" name="images[]" multiple >
        </div>

        <button type="submit" class="btn">
            Update Product
        </button>

    </form>

</div>