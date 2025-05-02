<?php
session_start();
require_once '../dbconfig/dbconfig.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description'] ?? '');
    $type = 'Products'; // Default value for Type
    $published = 1;     // Default value is 1 (published)
    $createdby = $_SESSION['admin'] ?? 'Admin'; // Fallback to 'Admin' if not set

    // Handle file upload for picture
    if (isset($_FILES['picture']) && !empty($_FILES['picture']['name'])) {
        // Create a unique filename to avoid overwriting existing files.
        $picture = time() . '_' . basename($_FILES['picture']['name']);
        $targetDir = '../assets/';
        $targetFile = $targetDir . $picture;

        // Attempt to move the uploaded file into the target directory.
        if (!move_uploaded_file($_FILES['picture']['tmp_name'], $targetFile)) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Failed to upload picture.'];
            header("Location: products.php");
            exit();
        }
    } else {
        $picture = null;
    }

    // Check if required fields are provided
    if (!empty($name) && !empty($category)) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO item (Name, Description, Category, Type, Published, Picture, CreatedBy, CreatedDate)
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
            ");
            $success = $stmt->execute([$name, $description, $category, $type, $published, $picture, $createdby]);

            if ($success) {
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Product added successfully!'];
            } else {
                $_SESSION['flash'] = ['type' => 'error', 'message' => 'Failed to add product.'];
            }
        } catch (PDOException $e) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Error: ' . $e->getMessage()];
        }
    } else {
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'Please fill in all required fields.'];
    }

    header("Location: products.php");
    exit();
}
