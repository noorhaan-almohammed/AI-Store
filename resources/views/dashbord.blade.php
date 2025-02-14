<!DOCTYPE html>
<html lang="ar">

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


    <!-- sidbar -->
    <div class="sidebar active">
        <div class="logo_content">
            <a href="http://localhost:8001" style="color: #fff;display: flex;">
            <div class="logo">
                <i class="bx bxs-store"></i>
                <div class="logo_name">A-Store</div>

            </div>
        </a>
        </div>
        <ul class="nav_list">
            <li>
                <a href="#" class="sidbar-item" data-id="Items">

                    <i class='bx bxs-category-alt'></i>
                    <span class="links_name">Items</span>
                </a>
                <span class="tooltip">Items</span>
            </li>

            <li>
                <a href="#" class="sidbar-item" data-id="categories">
                    <i class='bx bx-sitemap'></i>
                    <span class="links_name">categories</span>
                </a>
                <span class="tooltip">categories</span>
            </li>
            <li>
                <a href="#" class="sidbar-item" data-id="users">
                    <i class='bx bxs-user-detail'></i>
                    <span class="links_name">users</span>
                </a>
                <span class="tooltip">users</span>
            </li>
            <li>
                <a href="#" class="sidbar-item" data-id="orders">
                    <i class='bx bxs-user-detail'></i>
                    <span class="links_name">orders</span>
                </a>
                <span class="tooltip">orders</span>
            </li>
        </ul>
    </div>

    <!-- Items -->
    <section class="sidbar-section Items active">
        <div class="header">
            <h5>Products</h5>
            <button id="addItem" class="btn-primary ">
                Add new
            </button>
        </div>

        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Photo</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>product Quantity</th>
                        <th>Category</th>
                        <th>CTA</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                             @if ( $product->photos)
                                <img class="image" src="{{ $product->photos[0]->photo_path }}" alt="{{ $product->photos[0]->photo_name }}">
                             @else
                                <img class="image" src="{{ asset('assets/images/product_1.png') }}" alt="Default Image">
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->product_quantity }}</td>
                        <td>{{ $product->category->category_name }}</td>
                        <td>
                            <div class="cta-btn">
                                <button id="editItem" class="btn-primary btn-update">
                                    <i class='bx bxs-edit-alt'></i>
                                </button>
                                <button id="showWarning" class="btn-primary btn-delete">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </section>

    <!-- categories -->
    <section class="sidbar-section categories">
        <div class="header">
            <h5>Categories</h5>
            <button id="addCategory" class="btn-primary ">
                Add new
            </button>
        </div>

        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category Name</th>
                        <th>CTA</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>
                            <div class="cta-btn">
                                <button id="editCategory" class="btn-primary btn-update">
                                    <i class='bx bxs-edit-alt'></i>
                                </button>
                                <button id="showWarning" class="btn-primary btn-delete">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <!-- users -->
    <section class="sidbar-section users">
        <div class="header">
            <h5>Users</h5>
            <button id="addUser" class="btn-primary ">
                Add new
            </button>
        </div>

        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>CTA</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <div class="cta-btn">
                                <button id="editUser" class="btn-primary btn-update">
                                    <i class='bx bxs-edit-alt'></i>
                                </button>
                                <button id="showWarning" class="btn-primary btn-delete">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
 <!-- orders -->
 <section class="sidbar-section orders">
    <div class="header">
        <h5>Orders</h5>
        <button id="addItem" class="btn-primary ">
            Add new
        </button>
    </div>

    <div class="tbl-header">
        <table cellpadding="0" cellspacing="0" border="0">
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Usre ID</th>
                    <th>Usre Name</th>
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
                    <td>{{ $order->user_id }}</td>
                    <td>{{ $order->user->name }}</td>
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




    <!-- Overlay -->
    <div class="overlay"></div>

    <!-- Alert Container -->
    <div class="alert-container">
        <!-- Error Alert -->
        <div class="alert error">
            <i class="bx bx-error-circle"></i>
            <span>An error occurred! Please try again.</span>
            <div class="buttons">
                <button class="cancel">ok</button>
            </div>
        </div>

        <!-- Warning Alert -->
        <div class="alert warning">
            <i class="bx bx-error"></i>
            <span>Are you sure you want to proceed?</span>
            <div class="buttons">
                <button class="cancel">Cancel</button>
                <button class="confirm">Confirm</button>
            </div>
        </div>

        <!-- Success Alert -->
        <div class="alert success">
            <i class="bx bx-check-circle"></i>
            <span>Operation completed successfully!</span>
            <div class="buttons">
                <button class="cancel">ok</button>
            </div>
        </div>
    </div>

    <div class="popup-container">

        <!-- users -->
        <div class="popup addUser">
            <form action="#" class="addUserForm">
                <h2 class="title">Add User</h2>
                <div class="input_field">
                    <i class='bx bx-user'></i>
                    <input type="text" placeholder="Username">
                </div>
                <div class="input_field">
                    <i class='bx bx-envelope'></i>
                    <input type="email" placeholder="Email">
                </div>
                <div class="input_field">
                    <i class='bx bx-lock'></i>
                    <input type="password" placeholder="password">
                </div>
            </form>
            <div class="buttons">
                <button class="cancel">cancel</button>
                <button class="btn-primary">Save</button>
            </div>
        </div>

        <div class="popup editUser">
            <form action="#" class="addUserForm">
                <h2 class="title">Edit User</h2>
                <div class="input_field">
                    <i class='bx bx-user'></i>
                    <input type="text" placeholder="Username" value="test">
                </div>
                <div class="input_field">
                    <i class='bx bx-envelope'></i>
                    <input type="text" placeholder="Email" value="test@gmail.com">
                </div>
            </form>
            <div class="buttons">
                <button class="cancel">cancel</button>
                <button class="btn-primary">Save</button>
            </div>
        </div>

        <!-- Items -->
        <div class="popup addItem">
            <form action="#" class="addItemForm">
                <h2 class="title">Add Item</h2>
                <div class="input_field">
                    <i class='bx bx-item'></i>
                    <input type="text" placeholder="name">
                </div>
                <div class="input_field">
                    <textarea rows="15" placeholder="Details"></textarea>
                </div>
                <div class="input_field">
                    <i class='bx bx-lock'></i>
                    <input type="number" placeholder="Price">
                </div>
            </form>
            <div class="buttons">
                <button class="cancel">cancel</button>
                <button class="btn-primary">Save</button>
            </div>
        </div>

        <div class="popup editItem">
            <form action="#" class="addItemForm">
                <h2 class="title">Edit Item</h2>
                <div class="input_field">
                    <i class='bx bx-item'></i>
                    <input type="text" placeholder="name" value="test">
                </div>
                <div class="input_field">
                    <textarea rows="15"
                        placeholder="Details">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, voluptas?</textarea>
                </div>
                <div class="input_field">
                    <i class='bx bx-lock'></i>
                    <input type="number" placeholder="Price" value="10">
                </div>
            </form>
            <div class="buttons">
                <button class="cancel">cancel</button>
                <button class="btn-primary">Save</button>
            </div>
        </div>

        <!-- Category -->
        <div class="popup addCategory">
            <form action="#" class="addCategoryForm">
                <h2 class="title">Add Category</h2>
                <div class="input_field">
                    <i class='bx bx-Category'></i>
                    <input type="text" placeholder="Name">
                </div>
            </form>
            <div class="buttons">
                <button class="cancel">cancel</button>
                <button class="btn-primary">Save</button>
            </div>
        </div>

        <div class="popup editCategory">
            <form action="#" class="addCategoryForm">
                <h2 class="title">Edit Category</h2>
                <div class="input_field">
                    <i class='bx bx-Category'></i>
                    <input type="text" placeholder="Name" value="test">
                </div>
            </form>
            <div class="buttons">
                <button class="cancel">cancel</button>
                <button class="btn-primary">Save</button>
            </div>
        </div>
    </div>



    <!-- main frame -->
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <script src="{{ asset('assets/js/alerts.js') }}"></script>
    <script src="{{ asset('assets/js/popups.js') }}"></script>
</body>

</html>
