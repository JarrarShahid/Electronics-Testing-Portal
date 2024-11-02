<?php
session_start(); // Start a session

include 'db.php'; // Include your database connection
$message = ""; // Initialize the message variable
$redirect = false; // Flag to control the redirect

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Check if the username already exists
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        // Insert new user
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['user_id'] = $conn->insert_id; // Store the newly created user ID in the session
            $message = "New record created successfully"; // Success message
            $redirect = true; // Set redirect flag to true
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $message = "Username already exists"; // Error message
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form method="post" action="register.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Register</button>
        </form>
    </div>

    <?php if ($message): ?>
        <div id="popup" class="popup">
            <div class="popup-content">
                <span class="close" onclick="closePopup()">&times;</span>
                <p><?= $message ?></p>
            </div>
        </div>
        <script>
            // Show the popup
            document.getElementById("popup").style.display = "block";

            // Function to close the popup
            function closePopup() {
                document.getElementById("popup").style.display = "none";
            }

            // Redirect to index.php after 3 seconds if registration is successful
            <?php if ($redirect): ?>
                setTimeout(function() {
                    window.location.href = "index.php";
                }, 3000); // 3000 milliseconds = 3 seconds
            <?php endif; ?>
        </script>
    <?php endif; ?>
</body>
</html>
