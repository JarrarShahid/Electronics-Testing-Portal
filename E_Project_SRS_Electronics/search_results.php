<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" type="text/css" href="search_results.css">
</head>
<body>
    <div class="results-container">
        <h2>Search Results</h2>
        <?php
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

        $query = isset($_GET['query']) ? $_GET['query'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';

        $sql = "SELECT * FROM testing WHERE (product_id LIKE ? OR test_id LIKE ?)";

        // Add status filter if provided
        if ($status) {
            $sql .= " AND status = ?";
        }

        $stmt = $conn->prepare($sql);

        if ($status) {
            $stmt->bind_param('sss', "%$query%", "%$query%", $status);
        } else {
            $stmt->bind_param('ss', "%$query%", "%$query%");
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table>
            <tr>
                <th>Test ID</th>
                <th>Product ID</th>
                <th>Test Type</th>
                <th>Test Date</th>
                <th>Tester Name</th>
                <th>Test Result</th>
                <th>Remarks</th>
                <th>Status</th>
            </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>".$row['test_id']."</td>
                <td>".$row['product_id']."</td>
                <td>".$row['test_type']."</td>
                <td>".$row['test_date']."</td>
                <td>".$row['tester_name']."</td>
                <td>".$row['test_result']."</td>
                <td>".$row['remarks']."</td>
                <td>".$row['status']."</td>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='message'>No results found.</p>";
        }

        $conn->close();
        ?>
        <div class="button-container">
            <a href="index.php" class="return-button">Back to Index</a>
            <a href="search.php" class="action-button">Search Again</a>
        </div>
    </div>
</body>
</html>
