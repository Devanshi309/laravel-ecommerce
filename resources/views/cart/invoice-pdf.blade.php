<!DOCTYPE html>
<html>
<head>

    <title>Invoice PDF</title>

    <style>

        body{
            font-family:Arial,sans-serif;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        th,td{
            border:1px solid black;
            padding:10px;
            text-align:center;
        }

        th{
            background:#f2f2f2;
        }

        h1{
            text-align:center;
        }

    </style>

</head>

<body>

<h1>Invoice</h1>

<table>

    <tr>

        <th>Product</th>

        <th>Price</th>

        <th>Qty</th>

        <th>Total</th>

    </tr>

@php
$grandTotal = 0;
@endphp

@foreach($orders as $order)

@php

$total =
$order->product_price
*
$order->product_qty;

$grandTotal += $total;

@endphp

<tr>

    <td>
        {{ $order->product->name }}
    </td>
    <td>
        {{ $order->product_price }}
    </td>
    <td>
        {{ $order->product_qty }}
    </td>
    <td>
        {{ $total }}
    </td>

</tr>

@endforeach

</table>

<h2>

Grand Total:
{{ $grandTotal }}
</h2>

</body>
</html>