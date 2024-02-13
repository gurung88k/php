<?php
// Include necessary files
include('SHARED/mainpage.php');
include('SHARED/db.php');

// Set up query to fetch product data
$sql = "SELECT p.name AS product_name, p.price, c.name AS category_name 
        FROM products p 
        INNER JOIN categories c ON p.category_id = c.id";
$cmd = $db->prepare($sql);
$cmd->execute();
$products = $cmd->fetchAll();

// Close database connection
$db = null;
?>

<!-- Display products in an HTML table -->
<h1>Product Catalog</h1>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Category</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo $product['product_name']; ?></td>
            <td><?php echo $product['price']; ?></td>
            <td><?php echo $product['category_name']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
