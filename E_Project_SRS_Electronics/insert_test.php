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

// Retrieve form data
$test_id = isset($_POST['test_id']) ? $conn->real_escape_string($_POST['test_id']) : '';
$product_id = isset($_POST['product_id']) ? $conn->real_escape_string($_POST['product_id']) : '';
$test_type = isset($_POST['test_type']) ? $conn->real_escape_string($_POST['test_type']) : '';
$test_date = isset($_POST['test_date']) ? $conn->real_escape_string($_POST['test_date']) : '';
$tester_name = isset($_POST['tester_name']) ? $conn->real_escape_string($_POST['tester_name']) : '';
$test_result = isset($_POST['test_result']) ? $conn->real_escape_string($_POST['test_result']) : '';
$remarks = isset($_POST['remarks']) ? $conn->real_escape_string($_POST['remarks']) : '';
$status = isset($_POST['status']) ? $conn->real_escape_string($_POST['status']) : '';
$user_id = $_SESSION['user_id']; 

// Check if test_id is provided
if (empty($test_id)) {
    echo "Error: Test ID is required.";
    exit();
}

// Prepare and execute the SQL query to insert the test record
$sql = "INSERT INTO testing (test_id, product_id, test_type, test_date, tester_name, test_result, remarks, status, user_id) 
        VALUES ('$test_id', '$product_id', '$test_type', '$test_date', '$tester_name', '$test_result', '$remarks', '$status', '$user_id')";

if ($conn->query($sql) === TRUE) {
    echo "New test added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Test</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Add New Test</h1>

    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form id="test-form" action="insert_test.php" method="POST">
    <label for="product_id">Product ID:</label>
    <input type="text" id="product_id" name="product_id" required><br>
    <label for="test_type">Test Type:</label>
    <input type="text" id="test_type" name="test_type" required><br>
    <label for="test_date">Test Date:</label>
    <input type="date" id="test_date" name="test_date" required><br>
    <label for="tester_name">Tester Name:</label>
    <input type="text" id="tester_name" name="tester_name" required><br>
    <label for="test_result">Test Result:</label>
    <select id="test_result" name="test_result" required>
        <option value="pass">Pass</option>
        <option value="fail">Fail</option>
    </select><br>
    <label for="status">Status:</label>
    <select id="status" name="status" required>
        <option value="pending">Pending</option>
        <option value="completed">Completed</option>
    </select><br>
    <label for="remarks">Remarks:</label>
    <textarea id="remarks" name="remarks"></textarea><br>
    <input type="submit" value="Add Test">
</form>


    <a href="index.php">Back to Dashboard</a>
</body>
</html>
