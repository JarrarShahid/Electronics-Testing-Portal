<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

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

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="stylesheet" type="text/css" href="view_products.css">
</head>
<body>
    <h1>View Products</h1>
    <a href="index.php" class="return-button">Back to Index</a>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Revision</th>
            <th>Manufacture Date</th>
        </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>".$row['product_id']."</td>
            <td>".$row['product_name']."</td>
            <td>".$row['revise']."</td>
            <td>".$row['manufacture_date']."</td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "No products found.";
    }

    $conn->close();
    ?>
</body>
</html>
