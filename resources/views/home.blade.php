<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <!-- Boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>A-Store</title>
</head>

<body>
    <!-- Nav -->
    <nav>
        <div class="nav-container">
            <div class="links">
                <div class="logo">
                    <i class='bx bxs-store'></i>
                    <div class="logo_name">A-Store</div>
                </div>
            </div>
            <div class="sec-item">
                <a class="" href="./cart.html">
                    <i class='bx bxs-cart'></i>
                </a>
                <a class="" href="./checkOut.html">
                    <span>Cheek Out</span>
                </a>
            </div>

        </div>
    </nav>

    <section class="contener">
        <div class="header">
            <h5>All Categories</h5>
        </div>
        <div class="items-contener">
            <button class="btn-sec">
                <i class='bx bxs-bowl-rice'></i>
                <span>food</span>
            </button>

            <button class="btn-sec">
                <i class='bx bxs-bowl-rice'></i>
                <span>food</span>
            </button>

            <button class="btn-sec">
                <i class='bx bxs-bowl-rice'></i>
                <span>food</span>
            </button>

            <button class="btn-sec">
                <i class='bx bxs-bowl-rice'></i>
                <span>food</span>
            </button>

            <button class="btn-sec">
                <i class='bx bxs-bowl-rice'></i>
                <span>food</span>
            </button>

        </div>
    </section>

    <section class="contener">
        <div class="header contenerHeader">
            <h5>Food</h5>
            <div class="filter">
                <form action="">
                    <label for="Category">Filter by Category</label>
                    <select name="" id="Category">
                        <option value="1">Food</option>
                        <option value="2">Category</option>
                        <option value="3">Category2</option>
                    </select>
                </form>
            </div>

        </div>
        <div class="items-contener">
            <div class="card-wrapper">
                <div class="card-top">
                    <img class="image" src="{{ asset('assets/images/pngegg (25).png') }}">
                </div>
                <div class="card-bottom">
                    <span class="top-text">Product Name</span><br>
                    <span class="bottom-text">A simplified explanation text about the presented product</span>
                    <br>
                    <div class="price">The price : 10.000 sp</div>
                    <button class="button">
                        <span>Add to cart</span>
                        <div class="cart">
                            <svg viewBox="0 0 36 26">
                                <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
                                <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                            </svg>
                        </div>
                    </button>
                </div>
            </div>

            <div class="card-wrapper">
                <div class="card-top">
                    <img class="image" src="{{ asset('assets/images/pngegg (27).png') }}">
                </div>
                <div class="card-bottom">
                    <span class="top-text">Product Name</span><br>
                    <span class="bottom-text">A simplified explanation text about the presented product</span>
                    <br>
                    <div class="price">The price : 10.000 sp</div>
                    <button class="button">
                        <span>Add to cart</span>
                        <div class="cart">
                            <svg viewBox="0 0 36 26">
                                <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
                                <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                            </svg>
                        </div>
                    </button>
                </div>
            </div>

            <div class="card-wrapper">
                <div class="card-top">
                    <img class="image" src="{{ asset('assets/images/pngegg (28).png') }}">
                </div>
                <div class="card-bottom">
                    <span class="top-text">Product Name</span><br>
                    <span class="bottom-text">A simplified explanation text about the presented product</span>
                    <br>
                    <div class="price">The price : 10.000 sp</div>
                    <button class="button">
                        <span>Add to cart</span>
                        <div class="cart">
                            <svg viewBox="0 0 36 26">
                                <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
                                <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                            </svg>
                        </div>
                    </button>
                </div>
            </div>

            <div class="card-wrapper">
                <div class="card-top">
                    <img class="image" src="{{ asset('assets/images/pngegg (29).png') }}">
                </div>
                <div class="card-bottom">
                    <span class="top-text">Product Name</span><br>
                    <span class="bottom-text">A simplified explanation text about the presented product</span>
                    <br>
                    <div class="price">The price : 10.000 sp</div>
                    <button class="button">
                        <span>Add to cart</span>
                        <div class="cart">
                            <svg viewBox="0 0 36 26">
                                <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
                                <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                            </svg>
                        </div>
                    </button>
                </div>
            </div>


        </div>
        </div>
    </section>





    <footer class="footer">
        <div class="contaner">
            <div class="row">
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">about us</a></li>
                        <li><a href="#">our services </a></li>
                        <li><a href="#">privacy policy</a></li>
                        <li><a href="#">affiliate program</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Get help</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">shipping</a></li>
                        <li><a href="#">returns</a></li>
                        <li><a href="#">order status</a></li>
                        <li><a href="#">payment options</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Online shop</h4>
                    <ul>
                        <li><a href="#">Watch</a></li>
                        <li><a href="#">bag</a></li>
                        <li><a href="#">shoes</a></li>
                        <li><a href="#">dress</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Follow us</h4>
                    <div class="social-links">
                        <a href="#"> <i class='bx bxl-facebook-circle'></i></a>
                        <a href="#"> <i class='bx bxl-twitter'></i></a>
                        <a href="#"> <i class='bx bxl-instagram-alt'></i></a>
                        <a href="#"><i class='bx bxl-linkedin'></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
