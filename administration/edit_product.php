<?php
require_once '../dbconfig/dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $published = isset($_POST['published']) ? 1 : 0;

    // Handle file upload if any
    if ($_FILES['picture']['error'] == 0) {
        $target_dir = "../assets/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);
        $picture = basename($_FILES["picture"]["name"]);
    } else {
        $picture = null;
    }

    try {
        if ($picture) {
            $sql = "UPDATE item SET Name = ?, Category = ?, Description = ?, Published = ?, Picture = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $category, $description, $published, $picture, $id]);
        } else {
            $sql = "UPDATE item SET Name = ?, Category = ?, Description = ?, Published = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $category, $description, $published, $id]);
        }
        
        echo json_encode(['success' => true]);
        
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>
