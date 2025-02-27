# 🛍️ A-Store

## 📌 Overview
A-Store is an e-commerce web application that allows users to browse products, add them to their cart, and complete purchases securely. The platform includes a recommendation system using **TF-IDF** to suggest similar products based on the user's cart items.

## 🚀 Features
- **User Authentication**: Secure login and registration system.
- **Cart Management**: Add, update, and remove items from the cart.
- **Order Processing**: Checkout and order placement with Stripe payment integration.
- **Admin Dashboard**: Manage products, categories, users, and orders.
- **Product Recommendations**: AI-based recommendations using **TF-IDF**.

## 🛠️ Tech Stack
- **Frontend**: Blade (Laravel), JavaScript, HTML, CSS
- **Backend**: Laravel (PHP), MySQL, Python (for recommendations)
- **Payment Gateway**: Stripe
- **Machine Learning**: TF-IDF with `scikit-learn`

## 📂 Project Structure
```
A-Store/
│── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── CartController.php
│   │   │   ├── OrderController.php
│   │   │   ├── ProductController.php
│   │   │   ├── CartItemController.php
│   │── Models/
│   │   ├── Cart.php
│   │   ├── Order.php
│   │   ├── Product.php
├   |   |── User.php
│   │   ├── OrderItem.php
│   │   ├── CartItem.php
│   │   ├── Category.php
│── database/
│── resources/
│── public/
│── routes/
│   ├── web.php
│── storage/
│── python/
│   ├── recommendation.py
│── .env
│── composer.json
│── package.json
│── README.md
```

## 📌 Setup & Installation
### 1️⃣ Clone the Repository
```bash
git clone https://github.com/karam/A-Store.git
cd A-Store
```
### 2️⃣ Install Dependencies
```bash
composer install
npm install
```
### 3️⃣ Configure Environment Variables
Create a `.env` file and set up the database connection and Stripe API key.
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=A-store
DB_USERNAME=root
DB_PASSWORD=

STRIPE_SECRET=your_stripe_secret_key
```
### 4️⃣ Run Migrations & Seed Database
```bash
php artisan migrate --seed
```
### 5️⃣ Start the Server
```bash
php artisan serve
npm run dev
```

## 📊 Product Recommendation System
The recommendation system uses **TF-IDF** to suggest similar products based on the user's cart.
### 🧠 How It Works
- Fetches **product descriptions** from the database.
- Computes **TF-IDF vectors** to measure similarity.
- Suggests the **top similar products** excluding those already in the cart.
- Implemented in `python/recommendation.py`.

### 🛠️ Running the Recommendation Script
```bash
python python/recommendation.py <user_id>
```

## 📬 API Endpoints
### 🛒 Cart
- `POST /cart/add` → Add product to cart.
- `POST /cart/update` → Update cart item quantity.
- `POST /cart/remove` → Remove product from cart.
- `GET /cart` → Fetch cart items.

### 📦 Orders
- `POST /checkout` → Place an order.
- `GET /orders` → Get user orders.

### 🤖 AI Recommendations
- `GET /recommendations` → Fetch similar products.

## 🔐 Security
- CSRF protection enabled.
- Passwords are hashed using **bcrypt**.
- User authentication is managed by **Laravel Auth**.

## 🏆 Contribution
Feel free to fork and contribute! Submit pull requests for improvements.

## 📄 License
This project is licensed under the MIT License.

