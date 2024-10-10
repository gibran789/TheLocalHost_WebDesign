<?php
session_start();
// Simulasi data produk (sebaiknya ambil dari database)
$products = [
    1 => [
        'name' => 'Curleen Shampoo',
        'price' => 70000,
        'image' => 'structures/imgs/shampoo.png',
        'description' => 'Ingredients: Aloe Vera Gel, Castile Soap, Honey, Essential Oil, Apple Cider Vinegar, Vitamin E'
    ],
    2 => [
        'name' => 'Curleen Conditioner',
        'price' => 85000,
        'image' => 'structures/imgs/conditioner.png',
        'description' => 'Ingredients: Coconut Oil, Coconut Milk, Honey, Essential Oil, Vitamin E'
    ],
    3 => [
        'name' => 'Curleen Hair Oil',
        'price' => 53000,
        'image' => 'structures/imgs/hair oil.png',
        'description' => 'Ingredients: Candlenut Oil, Argan Oil, Coconut Oil, Rosemary Oil, Tea Tree Oil'
    ]
];

$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = isset($products[$product_id]) ? $products[$product_id] : null;

if (!$product) {
    die('Product not found');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    
    // Add to cart
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    $_SESSION['cart'][$product_id] = [
        'name' => $product['name'],
        'price' => $product['price'],
        'quantity' => $quantity,
        'image' => $product['image']
    ];
    
    // Redirect to cart page
    header('Location: cart.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include your head content here (similar to shop.php) -->
    <title><?php echo htmlspecialchars($product['name']); ?> - Description</title>
    <style>
        .product-image-description {
            max-width: 300px; /* Anda bisa menyesuaikan ukuran ini */
            width: 100%;
            height: auto;
            object-fit: contain;
            margin: 0 auto;
            display: block;
        }
    </style>
</head>
<body>
    <!-- Include your navigation bar here -->

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-fluid product-image-description">
            </div>
            <div class="col-md-6">
                <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                <h2 id="totalPrice">Rp.<?php echo number_format($product['price'], 0, ',', '.'); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                
                <form action="" method="post">
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control" style="width: 100px;">
                    </div>
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <button type="submit" name="add_to_cart" class="btn btn-primary mt-3">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Include your footer and scripts here -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('quantity');
            const totalPriceElement = document.getElementById('totalPrice');
            const basePrice = <?php echo $product['price']; ?>;

            function updateTotalPrice() {
                const quantity = parseInt(quantityInput.value);
                const totalPrice = basePrice * quantity;
                totalPriceElement.textContent = 'Rp.' + totalPrice.toLocaleString('id-ID');
            }

            quantityInput.addEventListener('input', updateTotalPrice);
            updateTotalPrice(); // Initialize the total price
        });
    </script>
</body>
</html>