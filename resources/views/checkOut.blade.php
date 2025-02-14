<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/form.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <!-- Boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>A-Store</title>
</head>

<body>
    <section class="cart checkOut">
        <h1>checkOut</h1>

        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>Img</th>
                        <th>Name</th>
                        <th>Item Price</th>
                        <th>Quantity</th>
                        <th>Total Item Price</th>

                    </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                    @php $totalPrice = 0; @endphp
                    @foreach ($cart_items as $cart_item)
                        @php
                            $itemTotal = $cart_item->product->price * $cart_item->quantity;
                            $totalPrice += $itemTotal;
                        @endphp
                        <tr data-id="{{ $cart_item->id }}" data-price="{{ $cart_item->product->price }}">
                            <td>
                                @if ($cart_item->product && $cart_item->product->photos->isNotEmpty())
                                    <img src="{{ asset($cart_item->product->photos[0]->photo_path) }}" alt="">
                                @else
                                    <img src="{{ asset('assets/images/default.png') }}" alt="No Image Available">
                                @endif
                            </td>
                            <td>{{ $cart_item->product->name }}</td>
                            <td>{{ $cart_item->product->price }}</td>
                            <td>
                                <span class="quantity" style="margin: 0 10px;">{{ $cart_item->quantity }}</span>
                            </td>
                            <td class="item-total">${{ number_format($itemTotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="checkOut-footer">
            <span id="checkOut-total">
                <h5>Total Amount: <span id="grand-total">${{ number_format($totalPrice, 2) }}</span></h5>
            </span>
            <form id="checkOut-form" class="checkOut-form" action="{{ route('placeOrder') }}" method="POST">
                @csrf

                <!-- الحقول المخفية لإرسال بيانات الدفع -->
                <input type="hidden" name="stripe_payment_id" id="stripe-payment-id">
                <input type="hidden" name="card_last4" id="card-last4">
                <input type="hidden" name="card_brand" id="card-brand">

                <div class="input_field">
                    <i class='bx bxs-phone'></i>
                    <input type="text" placeholder="Phone" name="phone" required>
                </div>
                <div class="input_field">
                    <i class='bx bx-map'></i>
                    <input type="text" placeholder="Shipping Address" name="shipping_address" required>
                </div>
                <div class="input_field">
                    <i class='bx bx-map'></i>
                    <input type="text" placeholder="Postal Code" name="postal_code" required>
                </div>

                <div id="card-element"></div>
                <div id="card-errors" style="color: red; margin-top: 10px;"></div>

                <div class="btns">
                    <a href="{{ route('cart') }}" class="btn btn-sec">Go back</a>
                    <input type="submit" class="btn btn-primary" value="Place an Order">
                </div>
            </form>


        </div>

    </section>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const stripe = Stripe(
                'pk_test_51ONXM0DCnvSZulvvRJCUdzqajOBsSoeP1o25GSQctKDvEYf7dgTPJn6XlIGu4aLqjU8mKByPfK4UcCL673wCDwpX00bVUfXybD'
            );
            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');

            const form = document.getElementById('checkOut-form');
            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const {
                    token,
                    error
                } = await stripe.createToken(cardElement);

                if (error) {
                    document.getElementById('card-errors').textContent = error.message;
                } else {
                    const formData = new FormData(form);
                    formData.append('stripe_payment_id', token.id); // تغيير الاسم هنا
                    formData.append('_token', '{{ csrf_token() }}');

                    fetch('{{ route('placeOrder') }}', {
                            method: 'POST',
                            body: formData,
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('تم الدفع بنجاح!');
                                window.location.href = '{{ url('/') }}';
                            } else {
                                alert(data.error || 'حدث خطأ أثناء معالجة الطلب.');
                            }
                        })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('حدث خطأ أثناء الاتصال بالخادم.');
                    });
                }
            });
        });
    </script>


</body>

</html>
