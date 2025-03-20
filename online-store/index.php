<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Store | Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, #ff7eb3, #ff758c);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: bold;
            color: white !important;
        }
        .nav-link {
            color: white !important;
            font-weight: 500;
        }
        .nav-link:hover {
            opacity: 0.8;
        }
        /* Hero Section */
        .hero {
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('https://source.unsplash.com/1600x900/?shopping,mall') center/cover no-repeat;
            position: relative;
            text-align: center;
            color: white;
        }
        .hero-overlay {
            background: rgba(0, 0, 0, 0.6);
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .hero h1 {
            font-size: 3.5rem;
            font-weight: bold;
        }
        .hero p {
            font-size: 1.3rem;
            margin-bottom: 20px;
        }
        .btn-custom {
            background-color: #ff758c;
            border: none;
            padding: 12px 25px;
            font-size: 1.2rem;
            color: white;
            border-radius: 50px;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background-color: #ff527b;
        }
        /* Featured Products */
        .products {
            padding: 60px 0;
            text-align: center;
        }
        .card {
            transition: 0.3s;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .card img {
            height: 250px;
            object-fit: cover;
        }
        .card-body {
            padding: 20px;
        }
        .btn-buy {
            background-color: #2a9d8f;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            padding: 10px;
            transition: 0.3s;
        }
        .btn-buy:hover {
            background-color: #21867a;
        }
        /* Footer */
        .footer {
            background: #2a9d8f;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<?php include("./navbar.php"); ?>


<!-- Hero Section -->
<div class="hero">
    <div class="hero-overlay">
        <h1>Discover the Best Deals</h1>
        <p>Shop now and enjoy exclusive discounts on your favorite brands.</p>
        <a href="products.php" class="btn btn-custom">Start Shopping</a>
    </div>
</div>

<!-- Featured Products -->
<div class="container products">
    <h2 class="mb-5">Featured Products</h2>
    <div class="row">
        <!-- Product 1 -->
        <div class="col-md-4">
            <div class="card">
                <img src="https://source.unsplash.com/400x300/?laptop" class="card-img-top" alt="Product">
                <div class="card-body">
                    <h5 class="card-title">Gaming Laptop</h5>
                    <p class="card-text">Powerful gaming laptop with high-end specs.</p>
                    <a href="#" class="btn btn-buy">Buy Now</a>
                </div>
            </div>
        </div>
        <!-- Product 2 -->
        <div class="col-md-4">
            <div class="card">
                <img src="https://source.unsplash.com/400x300/?headphones" class="card-img-top" alt="Product">
                <div class="card-body">
                    <h5 class="card-title">Wireless Headphones</h5>
                    <p class="card-text">Noise-canceling headphones with deep bass.</p>
                    <a href="#" class="btn btn-buy">Buy Now</a>
                </div>
            </div>
        </div>
        <!-- Product 3 -->
        <div class="col-md-4">
            <div class="card">
                <img src="https://source.unsplash.com/400x300/?watch" class="card-img-top" alt="Product">
                <div class="card-body">
                    <h5 class="card-title">Smart Watch</h5>
                    <p class="card-text">Track your fitness with a stylish smartwatch.</p>
                    <a href="#" class="btn btn-buy">Buy Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <p>© 2025 Online Store. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
