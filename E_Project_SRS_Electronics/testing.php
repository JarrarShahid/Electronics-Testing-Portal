<?php
// Start session if not already started
session_start();

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

// Example query to fetch products with their status and test_id
$sql = "SELECT p.product_id, p.product_name, p.revise, p.manufacture_date, t.test_id, t.status
        FROM products p
        LEFT JOIN testing t ON p.product_id = t.product_id
        GROUP BY p.product_id, t.test_id"; // Group by product_id and test_id to include both in the results
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Testing Page</title>
    <link rel="stylesheet" type="text/css" href="testing.css"> 
</head>
<body>
    <div class="container">
        <h1>Product List</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Revise</th>
                        <th>Manufacture Date</th>
                        <th>Test ID</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['product_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['revise']); ?></td>
                            <td><?php echo htmlspecialchars($row['manufacture_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['test_id']); ?></td> <!-- Display test_id -->
                            <td><?php echo htmlspecialchars($row['status']); ?></td> <!-- Display status -->
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
        <?php $conn->close(); ?>
        
        <a href="index.php" class="dashboard-button">Return to Dashboard</a>
    </div>
</body>
</html>
