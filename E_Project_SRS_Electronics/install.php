<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "srs_testing";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created or already exists.<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($dbname);

// SQL to create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created or already exists.<br>";
} else {
    die("Error creating table 'users': " . $conn->error);
}

// SQL to create products table
$sql = "CREATE TABLE IF NOT EXISTS products (
    product_id VARCHAR(10) PRIMARY KEY,
    product_name VARCHAR(255),
    revise INT,
    manufacture_date DATE,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'products' created or already exists.<br>";
} else {
    die("Error creating table 'products': " . $conn->error);
}

// SQL to create testing table
$sql = "CREATE TABLE IF NOT EXISTS testing (
    test_id VARCHAR(12) PRIMARY KEY,
    product_id VARCHAR(10),
    test_type VARCHAR(255),
    test_date DATE,
    tester_name VARCHAR(255),
    test_result ENUM('pass', 'fail'),
    remarks TEXT,
    status ENUM('pending', 'completed'),
    user_id INT NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'testing' created or already exists.<br>";
} else {
    die("Error creating table 'testing': " . $conn->error);
}

$conn->close();
?>
