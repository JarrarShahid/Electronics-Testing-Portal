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

// Initialize variables
$search_query = '';
$status_filter = '';
$result = null;

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get search query and status filter from form submission
    $search_query = $conn->real_escape_string($_POST['search_query']);
    $status_filter = $conn->real_escape_string($_POST['status_filter']);

    // Building the SQL query
    $sql = "SELECT p.product_id, p.product_name, p.revise, p.manufacture_date, t.status
            FROM products p
            LEFT JOIN testing t ON p.product_id = t.product_id
            WHERE p.product_id LIKE '%$search_query%'";

    if ($status_filter) {
        $sql .= " AND t.status = '$status_filter'";
    }

    // Execute the query
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" type="text/css" href="search.css">
</head>
<body>
    <div class="form-container">
        <h1>Search Results</h1>

        <form method="post" action="search.php">
            <label for="search_query">Search:</label>
            <input type="text" id="search_query" name="search_query" value="<?php echo htmlspecialchars($search_query); ?>" required>
            <label for="status_filter">Status:</label>
            <select id="status_filter" name="status_filter">
                <option value="">All</option>
                <option value="pending" <?php echo $status_filter === 'pending' ? 'selected' : ''; ?>>Pending</option>
                <option value="completed" <?php echo $status_filter === 'completed' ? 'selected' : ''; ?>>Completed</option>
            </select>
            <button type="submit">Search</button>
        </form>

        <h2>Results</h2>
        <?php if ($result !== null): ?>
            <?php if ($result->num_rows > 0): ?>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Revise</th>
                            <th>Manufacture Date</th>
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
                                <td><?php echo htmlspecialchars($row['status']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="message">No results found for the query.</p>
            <?php endif; ?>
        <?php else: ?>
            <p class="message">Please enter a search query to see results.</p>
        <?php endif; ?>
        <?php $conn->close(); ?>

        <a href="index.php" class="return-button">Back to Dashboard</a>
    </div>
</body>
</html>
