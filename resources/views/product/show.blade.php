<!DOCTYPE html>
<html>
<head>

    <title>Product Details</title>

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body{
            background:#f4f6f9;
        }

        .product-card{
            background:white;
            border-radius:15px;
            padding:30px;
            box-shadow:0 0 20px rgba(0,0,0,0.08);
        }

        .main-image{
            width:100%;
            height:400px;
            object-fit:cover;
            border-radius:12px;
        }

        .gallery img{
            width:100%;
            height:120px;
            object-fit:cover;
            border-radius:10px;
            transition:0.3s;
        }

        .gallery img:hover{
            transform:scale(1.05);
        }

        .price{
            color:#0d6efd;
            font-size:28px;
            font-weight:bold;
        }

        .category{
            font-size:18px;
            color:#666;
        }

        .description{
            line-height:1.8;
            color:#444;
        }

    </style>

</head>

<body>

<div class="container mt-5 mb-5">

    <div class="product-card">

        <div class="row">

            <!-- Left Side -->

            <div class="col-md-6">

                <img src="{{ asset('storage/products/'.$product->image) }}"
                     class="main-image">

            </div>

            <!-- Right Side -->

            <div class="col-md-6">

                <h1 class="mb-3">

                    {{ $product->name }}

                </h1>

                <p class="price mb-3">

                    ₹{{ $product->price }}

                </p>

                <p class="category mb-3">

                    <strong>Category:</strong>

                    {{ $product->category->name }}

                </p>

                <p class="description">

                    {{ $product->description }}

                </p>

                <!-- Add To Cart -->

                <form action="{{ route('add.to.cart',$product->id) }}"
                      method="POST"
                      class="mt-4">

                    @csrf

                    <div class="row g-3 align-items-center">

                        <div class="col-auto">

                            <input type="number"
                                   name="qty"
                                   value="1"
                                   min="1"
                                   class="form-control">

                        </div>

                        <div class="col-auto">

                            <button type="submit"
                                    class="btn btn-primary px-4">

                                Add To Cart

                            </button>

                        </div>

                    </div>

                </form>

                <!-- Back Button -->

                <a href="{{ url()->previous() }}"
                   class="btn btn-secondary mt-3">

                    ← Back

                </a>

            </div>

        </div>

        <!-- Gallery -->

        <div class="mt-5">

            <h3 class="mb-4">

                More Images

            </h3>

            <div class="row gallery">

                @foreach($product->images as $img)

                    <div class="col-md-3 col-6 mb-4">

                        <img src="{{ asset('storage/products/'.$img->image) }}">

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</div>

</body>
</html>