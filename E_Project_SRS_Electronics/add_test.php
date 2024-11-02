<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Test</title>
    <link rel="stylesheet" type="text/css" href="add_test.css">
    <style>
       
        #popup-message {
            display: none;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div id="popup-message">New test added successfully!</div> <!-- Popup message div -->

    <div class="form-container">
        <h2>Add New Test</h2>
        <form id="test-form" action="insert_test.php" method="POST">
            <label for="test_id">Test ID:</label>
            <input type="text" id="test_id" name="test_id"><br>
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
        <div class="button-container">
            <a href="index.php" class="return-button">Back to Index</a>
            <a href="search.php" class="action-button">Search Records</a>
        </div>
    </div>

    <script>
        // JavaScript to handle form submission and show popup message
        document.getElementById('test-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            var formData = new FormData(this);

            // Send the form data using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'insert_test.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Show the popup message
                    var popup = document.getElementById('popup-message');
                    popup.style.display = 'block';
                    // Hide the message 
                    setTimeout(function() {
                        popup.style.display = 'none';
                    }, 3000);
                    // Reset the form fields
                    document.getElementById('test-form').reset();
                } else {
                    alert('Error: ' + xhr.responseText);
                }
            };
            xhr.send(formData);
        });
    </script>
</body>
</html>
