<!DOCTYPE html>
<html>
<head>

    <title>Cart Page</title>

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

                Cart Page

            </h1>

            <!-- Buttons -->

            <div class="d-flex justify-content-between mb-4">

                <a href="{{ route('product.index') }}"
                class="btn btn-secondary">
                    ← Back
                </a>
                <a href="{{ route('checkout') }}"
                   class="btn btn-success">

                    Checkout

                </a>

            </div>

            <!-- Table -->

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th width="180">Qty</th>
                            <th>Total</th>
                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                    @php
                        $grandTotal = 0;
                    @endphp

                    @foreach($cart as $item)

                    @php
                        $itemTotal = $item['price'] * $item['qty'];

                        $grandTotal += $itemTotal;
                    @endphp

                    <tr>

                        <!-- Image -->

                        <td>

                            <img src="{{ asset('storage/products/'.$item['image']) }}"
                                 width="150" height="100"
                                 class="rounded shadow-sm">

                        </td>

                        <!-- Name -->

                        <td>

                            {{ $item['name'] }}

                        </td>

                        <!-- Price -->

                        <td>

                            ₹{{ $item['price'] }}

                        </td>

                        <!-- Quantity -->

                       <td>

    <div class="d-flex align-items-center gap-2">

        <!-- Minus Button -->

        <form action="{{ route('update.cart',$item['id']) }}"
              method="POST">

            @csrf

            <input type="hidden"
                   name="qty"
                   value="{{ $item['qty'] - 1 }}">

            <button type="submit"
                    class="btn btn-danger btn-sm"
                    {{ $item['qty'] <= 1 ? 'disabled' : '' }}>

                -

            </button>

        </form>

        <!-- Quantity -->

        <span class="fw-bold">

            {{ $item['qty'] }}

        </span>

        <!-- Plus Button -->

        <form action="{{ route('update.cart',$item['id']) }}"
              method="POST">

            @csrf

            <input type="hidden"
                   name="qty"
                   value="{{ $item['qty'] + 1 }}">

            <button type="submit"
                    class="btn btn-success btn-sm">

                +

            </button>

        </form>

    </div>

</td>
                        <!-- Total -->

                        <td>

                            ₹{{ $itemTotal }}

                        </td>

                        <!-- Remove -->

                        <td>

                            <form action="{{ route('remove.cart',$item['id']) }}"
                                  method="POST">

                                @csrf

                                <button type="submit"
                                        class="btn btn-danger btn-sm">

                                    Remove

                                </button>

                            </form>

                        </td>

                    </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

            <!-- Grand Total -->

            <div class="text-end mt-4">

                <h3 class="text-success">

                    Grand Total:
                    ₹{{ $grandTotal }}

                </h3>

            </div>

        </div>

    </div>

</div>

</body>
</html>