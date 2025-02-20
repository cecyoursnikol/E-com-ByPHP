<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Commerce Platform</title>
  <link rel="stylesheet" href="public/assets/css/style.css"> <!-- Link to CSS file -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="public/assets/js/search.js" href="stylesheet">
</head>

<body>
  <!-- Navigation Bar -->
  <div class="page-wrapper">
    <div class="nav-wrapper">
      <div class="grad-bar"></div>
      <nav class="navbar">
        <img
          src="https://upload.wikimedia.org/wikipedia/en/thumb/c/c8/Bluestar_%28bus_company%29_logo.svg/1280px-Bluestar_%28bus_company%29_logo.svg.png"
          alt="Company Logo">
        <div class="menu-toggle" id="mobile-menu">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </div>
        <ul class="nav no-search">
          <li class="nav-item"><a href="#">Home</a></li>
          <li class="nav-item"><a href="#">About</a></li>
          <li class="nav-item"><a href="#">Work</a></li>
          <li class="nav-item"><a href="#">Careers</a></li>
          <li class="nav-item"><a href="#">Contact Us</a></li>
          <i class="fas fa-search" id="search-icon"></i>
          <input class="search-input" type="text" placeholder="Search..">
        </ul>
      </nav>
    </div>
    <section class="headline">
      <h1>Responsive Navigation</h1>
      <p>Using CSS grid and flexbox to easily build navbars!</p>
    </section>
    <section class="features">
      <div class="feature-container">
        <img src="https://cdn-images-1.medium.com/max/2000/1*HFAEJvVOq4AwFuBivNu_OQ.png" alt="Flexbox Feature">
        <h2>Flexbox Featured</h2>
        <p>This pen contains use of flexbox for the headline and feature section! We use it in our mobile navbar and
          show the power of mixing css grid and flexbox.</p>
      </div>
      <div class="feature-container">
        <img src="https://blog.webix.com/wp-content/uploads/2017/06/20170621-CSS-Grid-Layout-710x355-tiny.png"
          alt="Flexbox Feature">
        <h2>CSS Grid Navigation</h2>
        <p>While flexbox is used for the the mobile navbar, CSS grid is used for the desktop navbar showing many ways we
          can use both.</p>
      </div>
      <div class="feature-container">
        <img src="https://www.graycelltech.com/wp-content/uploads/2015/06/GCT-HTML5.jpg" alt="Flexbox Feature">
        <h2>Basic HTML5</h2>
        <p>This pen contains basic html to setup the page to display the responsive navbar.</p>
      </div>
    </section>
  </div>
  <!-- Main Content -->
  <div class="container mt-5">
    <h1 class="text-center">Welcome to Our E-Commerce Platform</h1>
    <p class="text-center">Explore our wide range of products below:</p>

    <!-- Product Listing (Placeholder) -->
    <div class="row">
      <!-- Example Product Card -->
      <div class="col-md-4">
        <div class="card">
          <img src="public/uploads/sample-product.jpg" class="card-img-top" alt="Sample Product">
          <div class="card-body">
            <h5 class="card-title">Sample Product</h5>
            <p class="card-text">$99.99</p>
            <a href="views/products/details.php" class="btn btn-primary">View Details</a>
          </div>
        </div>
      </div>
      <!-- Repeat Product Cards Here -->
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center p-3 mt-5">
    <p>&copy; 2025 E-Commerce Platform. All Rights Reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>