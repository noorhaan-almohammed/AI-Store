<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user-dashbord.css') }}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <!-- Boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>A-Store</title>
</head>

<body>

    <!-- Items -->
    <section class="sidbar-section Items active">
        <div class="header">
            <h5>Your Orders</h5>
            <button id="addItem" class="btn-primary ">
                <a href="{{ route('home') }}" style="color: #fff">
                Home
                </a>
            </button>
        </div>

        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Shipping Address</th>
                        <th>Postal Code</th>
                        <th>Phone</th>
                        <th>Total Price</th>
                        <th>Payment Status</th>
                        <th>Status</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->shipping_address }}</td>
                        <td>{{ $order->postal_code }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->total_price }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </section>

</body>

</html>
