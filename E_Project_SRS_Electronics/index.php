<?php
session_start(); // Start the session to manage user login state

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "srs_testing";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user ID from session
$user_id = $_SESSION['user_id'];

// Fetch products for the logged-in user
$sql = "SELECT * FROM products WHERE user_id = $user_id";
$result = $conn->query($sql);
$products = $result->fetch_all(MYSQLI_ASSOC);

// Fetch test history for the logged-in user
$sql = "SELECT * FROM testing WHERE user_id = $user_id";
$result = $conn->query($sql);
$tests = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
        <div class="links">
            <a href="products.php">Your Products</a>
            <a href="testing.php">Your Test History</a>
            <a href="add_product.php">Add New Product</a>
            <a href="add_test.php">Add New Test</a>
            <a href="search.php">Search</a>
            <a href="logout.php">Logout</a>
        </div>
        <div class="content">
            <!-- Display products and test history here -->
        </div>
    </div>
</body>
</html>
