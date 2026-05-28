<!DOCTYPE html>
<html>
<head>

    <title>Invoice Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

     <div class="card shadow-lg">
                @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

        @endif

        <div class="card-body">

            <h1 class="text-center text-success mb-4">

                Invoice Page

            </h1>
           <a href={{ route('invoice.Pdf') }} class="btn btn-danger mb-3">
                    Download pdf</a>
            <table class="table table-bordered">

                <thead class="table-dark">

                    <tr>

                        <th>Product</th>

                        <th>Price</th>

                        <th>Qty</th>

                        <th>Total</th>

                    </tr>

                </thead>

                <tbody>

                @php
                    $grandTotal = 0;
                @endphp

                @foreach($orders as $order)

                @php
                    $total = $order->product_price * $order->product_qty;

                    $grandTotal += $total;
                @endphp

                <tr>

                    <td>
                        {{ $order->product->name }}
                    </td>

                    <td>
                        ₹{{ $order->product_price }}
                    </td>

                    <td>
                        {{ $order->product_qty }}
                    </td>

                    <td>
                        ₹{{ $total }}
                    </td>

                </tr>

                @endforeach

                </tbody>

            </table>

            <div class="text-end">

                <h3 class="text-primary">

                    Grand Total:
                    ₹{{ $grandTotal }}

                </h3>

            </div>

            <div class="mt-4">

                <a href="{{ route('product.index') }}"
                   class="btn btn-primary">

                    Continue Shopping

                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>