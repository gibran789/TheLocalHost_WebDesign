<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="structures/css/styles.css"/>
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-body-light" >
    <div class="container-fluid">
      <img src="structures/imgs/logo.png" width="80" height="80"/>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
  
          <li class="nav-item">
            <a class="nav-link" href="index.html">Home</a>
          </li>
  
          <li class="nav-item">
            <a class="nav-link" href="aboutus.html">About Us</a>
          </li>
  
          <li class="nav-item">
            <a class="nav-link" href="shop.php">Shop</a>
          </li>
  
          <li class="nav-item cart-icon">
            <a class="nav-link" href="cart.php">
              <i class="fas fa-shopping-cart"></i>
            </a>
          </li>
  
        </ul>
      </div>
    </div>
  </nav>

      <section id="Shop">
        <div class="container text-center mt-3">
            <h1>Our Product</h1>
        </div>
        <div class="row mx-auto container-fluid">
            <div class="product text-center col-lg-3">
              <img class="img-fluid mb-3" src="structures/imgs/shampoo.png">
              <h3 class="p-name">Curleen Shampoo</h3>
              <h4 class="p-price">Rp.70.000</h4>
              <a href="product_description.php?id=1" class="btn buy-btn">View Details</a>
          </div>

            <div class="product text-center col-lg-3">
                <img class="img-fluid mb-3" src="structures/imgs/conditioner.png">
                <h3 class="p-name">Curleen Conditioner</h3>
                <h4 class="p-price">Rp.85.000</h4>
                <a href="product_description.php?id=2" class="btn buy-btn">View Details</a>
            </div>

            <div class="product text-center col-lg-3">
                <img class="img-fluid mb-3" src="structures/imgs/hair oil.png">
                <h3 class="p-name">Curleen Hair Oil</h3>
                <h4 class="p-price">Rp.53.000</h4>
                <a href="product_description.php?id=3" class="btn buy-btn">View Details</a>
            </div>
        </div>
    </section>
    

</body>
</html>