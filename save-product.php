<?php
// Include necessary files
include('SHARED/db.php');

// Capture form inputs into variables
$name = $_POST['name'];
$price = $_POST['price'];
$category = $_POST['category'];
$ok = true;

// Input validation before saving
if (empty($name) || empty($price) || empty($category)) {
    echo 'Please fill in all fields.';
    $ok = false;
} elseif (!is_numeric($price) || $price <= 0) {
    echo 'Price must be a positive number.';
    $ok = false;
}

// If all validations pass, proceed to save the product
if ($ok) {
    try {
        // Prepare SQL INSERT command
        $sql = "INSERT INTO products (name, price, category_id) VALUES (:name, :price, :category)";
        $cmd = $db->prepare($sql);

        // Bind parameters to the prepared statement
        $cmd->bindParam(':name', $name);
        $cmd->bindParam(':price', $price);
        $cmd->bindParam(':category', $category);

        // Execute the INSERT query
        $cmd->execute();

        // Display a success message to the user
        echo 'Product Saved';
    } catch (PDOException $e) {
        // Display an error message if something went wrong with the database operation
        echo 'An error occurred: ' . $e->getMessage();
    }
}

// Disconnect from the database
$db = null;
?>
