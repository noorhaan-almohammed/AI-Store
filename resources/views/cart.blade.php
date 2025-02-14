<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>A-Store</title>
</head>

<body>
    <section class="cart">
        <!--for demo wrap-->
        <h1>Your Cart <i class='bx bxs-cart-download'></i></h1>
        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>Img</th>
                        <th>Name</th>
                        <th>Item Price</th>
                        <th>Quantity</th>
                        <th>Total Item Price</th>
                        <th>Remove it</th>

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
                                <form action="{{ route('update_quantity') }}" method="POST" class="quantity-form">
                                    @csrf
                                    <input type="hidden" name="cart_item_id" value="{{ $cart_item->id }}">

                                    <!-- زر تقليل الكمية -->
                                    <button class="quantity_btn decrease" type="button"
                                        {{ $cart_item->quantity == 1 ? 'disabled' : '' }}>-</button>

                                    <span class="quantity" style="margin: 0 10px;">{{ $cart_item->quantity }}</span>

                                    <!-- زر زيادة الكمية -->
                                    <button class="quantity_btn increase" type="button">+</button>
                                </form>
                            </td>
                            <td class="item-total">${{ number_format($itemTotal, 2) }}</td>
                            <td>
                                <button class="remove-item" data-id="{{ $cart_item->id }}">
                                    <i class='bx bxs-message-square-x'></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a id="go_back" href="{{ route('home') }}">Go back</a>
        <span id="total">
            <h5>Total Amount: <span id="grand-total">${{ number_format($totalPrice, 2) }}</span></h5>
        </span>
        <a id="chek_out" href="{{ route('checkout') }}">Go to chek out</a>

    </section>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const updateTotal = () => {
        let total = 0;
        document.querySelectorAll("tr[data-id]").forEach((row) => {
            const price = parseFloat(row.getAttribute("data-price"));
            const quantity = parseInt(row.querySelector(".quantity").textContent);
            const itemTotal = price * quantity;
            row.querySelector(".item-total").textContent = `$${itemTotal.toFixed(2)}`;
            total += itemTotal;
        });
        document.getElementById("grand-total").textContent = `$${total.toFixed(2)}`;
    };

    // تحديث الكمية بدون إعادة تحميل الصفحة
    document.querySelectorAll(".increase, .decrease").forEach((button) => {
        button.addEventListener("click", function() {
            let row = this.closest("tr");
            let quantityElement = row.querySelector(".quantity");
            let decreaseButton = row.querySelector(".decrease");
            let quantity = parseInt(quantityElement.textContent);
            let action = this.classList.contains("increase") ? "increase" : "decrease";
            let cartItemId = row.getAttribute("data-id");

            if (action === "increase") {
                quantity++;
            } else if (action === "decrease" && quantity > 1) {
                quantity--;
            }

            quantityElement.textContent = quantity;

            // تعطيل زر النقصان إذا كانت الكمية 1
            if (quantity === 1) {
                decreaseButton.setAttribute("disabled", "disabled");
            } else {
                decreaseButton.removeAttribute("disabled");
            }

            // إرسال الطلب إلى السيرفر بدون إعادة تحميل الصفحة
            fetch("{{ route('update_quantity') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    cart_item_id: cartItemId,
                    action: action
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateTotal(); // تحديث السعر الإجمالي بعد نجاح التحديث
                } else {
                    alert("Failed to update quantity.");
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });

    // تفعيل زر الحذف بدون إعادة تحميل الصفحة
    document.querySelectorAll(".remove-item").forEach(button => {
        button.addEventListener("click", function() {
            let row = this.closest("tr");
            let cartItemId = this.getAttribute("data-id");

            fetch("{{ route('remove_from_cart') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    cart_item_id: cartItemId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    row.remove(); // إزالة العنصر من الصفحة
                    updateTotal(); // تحديث السعر الإجمالي
                } else {
                    alert("Failed to remove item.");
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });
});

    </script>
</body>

</html>
