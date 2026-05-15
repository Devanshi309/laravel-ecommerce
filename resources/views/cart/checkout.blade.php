<!DOCTYPE html>
<html>
<head>

    <title>Checkout Page</title>

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow-lg border-0">

        <div class="card-body p-4">

            <!-- Heading -->

            <h1 class="text-center text-primary mb-4">
                Checkout Page
            </h1>

            <!-- Table -->

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>

                    </thead>

                    <tbody>

                    @php
                        $grandTotal = 0;
                    @endphp

                    @foreach($cart as $item)

                    @php
                        $total = $item['price'] * $item['qty'];

                        $grandTotal += $total;
                    @endphp

                    <tr>

                        <td>
                            {{ $item['name'] }}
                        </td>

                        <td>
                            ₹{{ $item['price'] }}
                        </td>

                        <td>
                            {{ $item['qty'] }}
                        </td>

                        <td>
                            ₹{{ $total }}
                        </td>

                    </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

            <!-- Grand Total -->

            <div class="text-end mt-4">

                <h3 class="text-success">

                    Total Amount:
                    ₹{{ $grandTotal }}

                </h3>

            </div>

            <!-- Buttons -->

            <div class="d-flex justify-content-between mt-4">

                <a href="{{ route('cart.index') }}"
                   class="btn btn-secondary">

                    ← Back To Cart

                </a>

                <button class="btn btn-success">

                    Place Order

                </button>

            </div>

        </div>

    </div>

</div>

</body>
</html>