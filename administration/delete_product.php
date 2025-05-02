<?php
// delete_product.php
require_once '../dbconfig/dbconfig.php'; // this gives you $pdo

header('Content-Type: application/json');

if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    try {
        $query = "DELETE FROM item WHERE id = ?";
        $stmt = $pdo->prepare($query); // Use $pdo, not $conn
        $stmt->bindParam(1, $productId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Product deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete product.']);
        }

        
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Product ID not provided.']);
}
?>
