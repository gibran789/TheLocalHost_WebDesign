<?php
session_start();

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Remove item from cart
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    if (isset($_SESSION['cart'][$remove_id])) {
        unset($_SESSION['cart'][$remove_id]);
    }
}

// Update quantities
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $id => $qty) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] = max(1, (int)$qty);
        }
    }
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="structures/css/styles.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-light" >
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
            <a class="nav-link" href="#">About Us</a>
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

  <section class="Cart container">
  <div class="container mt-5">
    <h2 class="font-weight-bolde">Your Cart</h2>
  </div>

  <form method="post">
    <table class="mt-5 pt-5">
      <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Action</th>
      </tr>
      <?php foreach ($_SESSION['cart'] as $id => $item): 
          $item_total = $item['price'] * $item['quantity'];
          $total += $item_total;
      ?>
      <tr>
        <td>
          <div class="product-info">
            <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 80px; height: auto;">
            <div>
              <p><?php echo htmlspecialchars($item['name']); ?></p>
              <small><span>Rp.</span><?php echo number_format($item['price'], 0, ',', '.'); ?></small>
            </div>
          </div>
        </td>
        <td>
          <input type="number" class="quantity-input" value="<?php echo $item['quantity']; ?>" 
                 name="quantity[<?php echo $id; ?>]" data-price="<?php echo $item['price']; ?>" min="1">
        </td>
        <td>
          <span class="product-price">Rp. <?php echo number_format($item_total, 0, ',', '.'); ?></span>
        </td>
        <td>
          <a href="cart.php?remove=<?php echo $id; ?>" class="remove-btn">Remove</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>

    <div class="cart-total">
      <table>
        <tr>
          <td>Total</td>
          <td id="cart-total">Rp. <?php echo number_format($total, 0, ',', '.'); ?></td>
        </tr>
      </table>
    </div>

    <div class="checkout-container" style="text-align: right; margin-top: 20px;">
      <button type="submit" name="update_cart" class="btn btn-secondary">Update Cart</button>
      <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
    </div>
  </form>
</section>

<script>
$(document).ready(function() {
    function formatCurrency(amount) {
        return 'Rp. ' + amount.toLocaleString('id-ID');
    }

    function updateProductTotal(input) {
        var quantity = parseInt($(input).val());
        var price = parseFloat($(input).data('price'));
        var total = quantity * price;
        $(input).closest('tr').find('.product-price').text(formatCurrency(total));
    }

    function updateCartTotal() {
        var total = 0;
        $('.quantity-input').each(function() {
            var quantity = parseInt($(this).val());
            var price = parseFloat($(this).data('price'));
            total += quantity * price;
        });
        $('#cart-total').text(formatCurrency(total));
    }

    $('.quantity-input').on('input', function() {
        updateProductTotal(this);
        updateCartTotal();
    });

    // Initial update
    $('.quantity-input').each(function() {
        updateProductTotal(this);
    });
    updateCartTotal();
});
</script>

</body>
</html>