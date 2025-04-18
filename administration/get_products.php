<?php
// get_products.php
require_once '../dbconfig/dbconfig.php';

/**
 * Fetch all products from the database.
 *
 * @return array List of products.
 */
function getProducts() {
    global $pdo;
    $products = [];
    try {
        $stmt = $pdo->query("SELECT id, Name, Description, Category, Picture, Published, CreatedDate 
                             FROM item 
                             WHERE Type = 'Products' 
                             ORDER BY CreatedDate DESC");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
    return $products;
}


/**
 * Get unique categories from the products array.
 *
 * @param array $products List of products.
 *
 * @return array Sorted list of unique categories.
 */
function getUniqueCategories($products) {
    $categories = array_unique(array_column($products, 'Category'));
    sort($categories);
    return $categories;
}

/**
 * Count total published products (Published = 1).
 *
 * @return int Total number of published products.
 */
function countPublishedProducts() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM item WHERE Published = 1 AND Type = 'Products'");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $row['total'];
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}


