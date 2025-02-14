<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>A-Store</title>
</head>

<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <div class="links">
                <div class="logo">
                    <i class='bx bxs-store'></i>
                    <div class="logo_name">A-Store</div>
                </div>
            </div>
            <div class="sec-item">
                @if (auth()->check())
                    <span>Welcome, {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-primary"
                            style="background: none; border: none; color: inherit; cursor: pointer;">
                            <i class='bx bx-user'></i>
                            <span>Logout</span>
                        </button>
                    </form>
                @else
                    <a class="btn-primary" href="{{ route('login') }}">
                        <i class='bx bx-user'></i>
                        <span>Login</span>
                    </a>
                @endif
                @if (auth()->check() && auth()->user()->role === "customer")
                <a href="{{ route('cart') }}">
                    <i class='bx bxs-cart'></i>
                </a>
                <a href="{{ route('checkout') }}">
                    <span>Checkout</span>
                </a>
                <a href="{{ route('dashbord') }}">
                    <span>Track Your Orders</span>
                </a>
                @elseif (auth()->check() && auth()->user()->role === "admin")
                <a href="{{ route('dashbord') }}">
                    <span>Dashboard</span>
                </a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="left">
            <img src="{{ asset('assets/images/hero.jpg') }}" alt="Hero Image">
            <hr>
        </div>
        <div class="right">
            <hr>
            <span>
                <h2>Shop from home with the best offers</h2>
            </span>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="container">
        <div class="header">
            <h5>All Categories</h5>
        </div>
        <div class="items-contener">
            <a href="{{ route('home') }}" class="btn-sec active">
                <i class='bx bxs-bowl-rice'></i>
                <span>All</span>
            </a>
            @foreach ($categories as $category)
                <a href="{{ route('home', ['category' => $category->id]) }}" class="btn-sec">
                    <i class='bx bxs-bowl-rice'></i>
                    <span>{{ $category->category_name }}</span>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Products Section -->
    <section class="container">
        <div class="header">
            <h5>Products</h5>
        </div>
        <div class="items-contener" id="products-container">
            <!-- Products will be dynamically loaded here -->
        </div>
        <div id="loader" style="display: none; text-align: center; padding: 20px;">Loading...</div>
    </section>

    <!-- Suggested Products Section -->
    <section class="container">
        <div class="header">
            <h5>Suggested Products</h5>
        </div>
        <div class="items-contener" id="suggested-products-container">
            <!-- Suggested products will be loaded here -->
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Our Services</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Affiliate Program</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Get Help</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Order Status</a></li>
                        <li><a href="#">Payment Options</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Online Shop</h4>
                    <ul>
                        <li><a href="#">Watch</a></li>
                        <li><a href="#">Bag</a></li>
                        <li><a href="#">Shoes</a></li>
                        <li><a href="#">Dress</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href="#"><i class='bx bxl-facebook-circle'></i></a>
                        <a href="#"><i class='bx bxl-twitter'></i></a>
                        <a href="#"><i class='bx bxl-instagram-alt'></i></a>
                        <a href="#"><i class='bx bxl-linkedin'></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryLinks = document.querySelectorAll('.btn-sec');
            const productsContainer = document.getElementById('products-container');
            const loader = document.getElementById('loader');

            // دالة لتحميل المنتجات
            function loadProducts(url) {
                loader.style.display = 'block';
                productsContainer.style.opacity = '0.5'; // تقليل شفافية المنتجات أثناء التحميل

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(products => {
                        loader.style.display = 'none';
                        productsContainer.style.opacity = '1'; // إعادة الشفافية إلى الوضع الطبيعي

                        productsContainer.innerHTML = ''; // تفريغ المنتجات السابقة

                        if (products.length === 0) {
                            productsContainer.innerHTML = '<p>No products found.</p>';
                            return;
                        }

                        products.forEach(product => {
                            const productHtml = `
                    <div class="card-wrapper">
                        <div class="card-top">
                            ${product.photos && product.photos.length > 0
                                ? `<img class="image" src="${product.photos[0].photo_path}" alt="${product.photos[0].photo_name}">`
                                : `<img class="image" src="/assets/images/product_1.png" alt="Default Image">`}
                        </div>
                        <div class="card-bottom">
                            <span class="top-text">${product.name}</span><br>
                            <span class="bottom-text">${product.description}</span><br>
                            <div class="price">The price: ${product.price} sp</div>
                            <button class="button add-to-cart" data-product-id="${product.id}">
                                <span>Add to cart</span>
                                <div class="cart">
                                    <svg viewBox="0 0 36 26">
                                        <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5"></polyline>
                                        <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </div>`;
                            productsContainer.innerHTML += productHtml;
                        });

                        // إضافة الحدث الخاص بإضافة المنتج إلى العربة
                        const addToCartButtons = document.querySelectorAll('.add-to-cart');
                        addToCartButtons.forEach(button => {
                            button.addEventListener('click', function() {
                                const productId = this.getAttribute('data-product-id');
                                addToCart(productId);
                            });
                        });
                    })
                    .catch(error => {
                        loader.style.display = 'none';
                        productsContainer.style.opacity = '1';
                        console.error('Error fetching products:', error);
                    });
            }

            // تحميل المنتجات الافتراضية عند فتح الصفحة
            loadProducts('/');

            // التعامل مع النقر على روابط الفئات
            categoryLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    // إزالة الفئة النشطة من جميع الروابط
                    categoryLinks.forEach(l => l.classList.remove('active'));
                    // إضافة الفئة النشطة للرابط الحالي
                    this.classList.add('active');

                    // تحميل المنتجات بناءً على الفئة
                    const url = this.getAttribute('href');
                    loadProducts(url);
                });
            });

            function addToCart(productId) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const button = document.querySelector(`.add-to-cart[data-product-id="${productId}"]`);
                const originalText = button.innerHTML;

                // إضافة مؤشر التحميل
                button.innerHTML = '<span>Loading...</span>';

                fetch('{{ route('cart.add') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.redirect) {
                            window.location.href = data.redirect; // التوجيه إلى صفحة تسجيل الدخول
                        } else if (data.error) {
                            alert(data.error); // عرض رسالة إذا كان المنتج موجودًا في السلة بالفعل
                        } else if (data.success) {
                            alert('Product added to cart!');

                            // جلب المنتجات المقترحة بعد إضافة المنتج للسلة
                            loadSuggestedProducts(productId);
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error adding product to cart:', error);
                        alert('An error occurred while adding the product to the cart. Please try again.');
                    })
                    .finally(() => {
                        // استعادة النص الأصلي بعد التحميل
                        button.innerHTML = originalText;
                    });
            }
            // وظيفة لتحديث أزرار الإضافة إلى السلة
            function attachAddToCartListeners() {
                const addToCartButtons = document.querySelectorAll('.add-to-cart');
                addToCartButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const productId = this.getAttribute('data-product-id');
                        addToCart(productId);
                    });
                });
            }

            // دالة لتحميل المنتجات المقترحة
            function loadSuggestedProducts(userId) {
                const suggestedProductsContainer = document.getElementById('suggested-products-container');

                fetch(`/suggested-products/${userId}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(products => {
                        suggestedProductsContainer.innerHTML = ''; // مسح القائمة القديمة

                        if (products.length === 0) {
                            suggestedProductsContainer.innerHTML = '<p>No suggested products found.</p>';
                            return;
                        }

                        products.forEach(product => {
                            const productHtml = `
                <div class="card-wrapper">
                    <div class="card-top">
                        ${product.photos && product.photos.length > 0
                            ? `<img class="image" src="${product.photos[0].photo_path}" alt="${product.photos[0].photo_name}">`
                            : `<img class="image" src="/assets/images/product_1.png" alt="Default Image">`}
                    </div>
                    <div class="card-bottom">
                        <span class="top-text">${product.name}</span><br>
                        <span class="bottom-text">${product.description}</span><br>
                        <div class="price">The price: ${product.price} sp</div>
                        <button class="button add-to-cart" data-product-id="${product.id}">
                            <span>Add to cart</span>
                            <div class="cart">
                                <svg viewBox="0 0 36 26">
                                    <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5"></polyline>
                                    <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                                </svg>
                            </div>
                        </button>
                    </div>
                </div>`;
                            suggestedProductsContainer.innerHTML += productHtml;
                        });

                        // إعادة تفعيل أزرار الإضافة إلى السلة بعد تحميل المنتجات
                        attachAddToCartListeners();
                    })
                    .catch(error => {
                        console.error('Error fetching suggested products:', error);
                    });
            }


            // تحديث القائمة عند إضافة منتج إلى السلة
            document.addEventListener('click', function(event) {
                if (event.target.closest('.add-to-cart')) {
                    const userId = document.body.dataset.userId; // افتراض أن لديك userId مخزن في body
                    loadSuggestedProducts(userId);
                }
            });


        });
    </script>
</body>

</html>
