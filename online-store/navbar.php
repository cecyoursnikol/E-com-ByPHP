
<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #ff7eb3, #ff758c); box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
    <div class="container">
        <a class="navbar-brand fw-bold text-white" href="index.php">Online Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link text-white" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="products.php">Products</a></li>
                <?php if (isset($_SESSION["user_id"])): ?>
                    <li class="nav-item"><a class="nav-link text-white" href="">Profile</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="../online-store/logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link text-white" href="./login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="./register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
