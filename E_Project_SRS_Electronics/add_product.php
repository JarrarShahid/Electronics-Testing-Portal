<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="stylesheet" type="text/css" href="add_product.css">

</head>
<body>
    <div id="popup-message">New product added successfully!</div> <!-- Popup message div -->

    <div class="form-container">
        <h2>Add New Product</h2>
        <form id="product-form" action="insert_product.php" method="POST">
            <label for="product_id">Product ID:</label>
            <input type="text" id="product_id" name="product_id" required><br>
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required><br>
            <label for="revise">Revision:</label>
            <input type="number" id="revise" name="revise" required><br>
            <label for="manufacture_date">Manufacture Date:</label>
            <input type="date" id="manufacture_date" name="manufacture_date" required><br>
            <input type="submit" value="Add Product">
        </form>
        <div class="button-container">
            <a href="index.php" class="return-button">Back to Index</a>
            <a href="add_test.php" class="action-button">Add New Test</a>
        </div>
    </div>

    <script>
        // JavaScript to handle form submission and show popup message
        document.getElementById('product-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            var formData = new FormData(this);

            // Send the form data using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'insert_product.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Show the popup message
                    var popup = document.getElementById('popup-message');
                    popup.style.display = 'block';
                    // Hide the message 
                    setTimeout(function() {
                        popup.style.display = 'none';
                    }, 3000);
                } else {
                    alert('Error: ' + xhr.responseText);
                }
            };
            xhr.send(formData);
        });
    </script>
</body>
</html>
