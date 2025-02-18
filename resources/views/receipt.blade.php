<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
    <style>
        /* Add any styling for your PDF receipt here */
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
        }
        .items-table {
            width: 100%;
            margin-top: 20px;
        }
        .items-table th, .items-table td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .total {
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Receipt</h1>
        <p>Order ID: {{ $order_id }}</p>
        <p>Customer: {{ $customer_name }}</p>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ number_format($item['price'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <p>Total: ${{ number_format($total, 2) }}</p>
    </div>
</body>
</html>
