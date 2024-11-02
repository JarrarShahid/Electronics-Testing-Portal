<?php
// Display a hashed password
$password = 'testpassword'; // Original plain text password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
echo "Hashed Password: " . $hashedPassword;
?>
