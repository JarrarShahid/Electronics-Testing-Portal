<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php'; 

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $revise = intval($_POST['revise']);
    $manufacture_date = mysqli_real_escape_string($conn, $_POST['manufacture_date']);
    $user_id = $_SESSION['user_id']; // Get the logged-in user's ID

    $sql = "INSERT INTO products (product_id, product_name, revise, manufacture_date, user_id) 
            VALUES ('$product_id', '$product_name', $revise, '$manufacture_date', '$user_id')";
    if (mysqli_query($conn, $sql)) {
        $message = "Product added successfully.";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="stylesheet" type="text/css" href="add_product.css">
</head>
<body>
    <div class="form-container">
        <h2>Add New Product</h2>

        <?php if ($message): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <form action="insert_product.php" method="POST">
            <label for="product_id">Product ID:</label>
            <input type="text" id="product_id" name="product_id" required><br>
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required><br>
            <label for="revise">Revision:</label>
            <input type="number" id="revise" name="revise" required><br>
            <label for="manufacture_date">Manufacture Date:</label>
            <input type="date" id="manufacture_date" name="manufacture_date" required><br>
            <input type="submit" value="Add Product">
        </form>

        <div class="options">
            <a href="view_products.php">View Your Products</a>
            <a href="view_tests.php">View Your Test History</a>
            <a href="add_test.php">Add New Test</a>
            <a href="search.php">Search</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
