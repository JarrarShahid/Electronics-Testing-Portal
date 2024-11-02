<?php
include 'db.php'; // Include your database connection

// Replace with your hashed password
$hashedPassword = ' $2y$10$wCGXCiczEV/tN3mpHQQiY.QPqDR0hjZR2eh5s19LxOypseEN1PvIK';
$username = 'testuser';

// Update the password in the database
$sql = "UPDATE users SET password='$hashedPassword' WHERE username='$username'";
if ($conn->query($sql) === TRUE) {
    echo "Password updated successfully.";
} else {
    echo "Error updating password: " . $conn->error;
}

$conn->close();
?>
