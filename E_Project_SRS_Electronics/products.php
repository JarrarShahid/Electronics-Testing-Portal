<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$user_id = $_SESSION['user_id'];

$products = [];
$sql = "SELECT * FROM products WHERE user_id = '$user_id'";

$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Products</title>
    <link rel="stylesheet" type="text/css" href="products.css">
</head>
<body>
    <div class="container">
        <h1>Your Products</h1>

        <a href="add_product.php" class="button">Add New Product</a>

        <?php if (count($products) > 0): ?>
            <ul class="product-list">
                <?php foreach ($products as $product): ?>
                    <li class="product-item">
                        <strong>Product Name:</strong> <?= htmlspecialchars($product['product_name']) ?><br>
                        <strong>Product ID:</strong> <?= htmlspecialchars($product['product_id']) ?><br>
                        <strong>Revise:</strong> <?= htmlspecialchars($product['revise']) ?><br>
                        <strong>Manufacture Date:</strong> <?= htmlspecialchars($product['manufacture_date']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>

        <a href="index.php" class="button">Back to Dashboard</a>
    </div>
</body>
</html>
