<?php
// Include necessary files
include('SHARED/mainpage.php');
include('SHARED/db.php');

// Fetch categories from database
$sql = "SELECT * FROM categories";
$cmd = $db->prepare($sql);
$cmd->execute();
$categories = $cmd->fetchAll();

// Close database connection
$db = null;
?>

<!-- HTML form -->
<form action="save-product.php" method="post">
    <fieldset>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br>
    </fieldset>
    <fieldset>
    <label for="price">Price:</label>
    <input type="number" id="price" name="price" min="0.01" step="0.01" required><br>
   </fieldset>
     <fieldset>
    <label for="category">Category:</label>
    <select id="category" name="category" required>
        <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
        <?php endforeach; ?>
    </select><br>
         </fieldset>
    <button type="submit">Save Product</button>
</form>
