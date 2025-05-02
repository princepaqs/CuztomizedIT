<?php
// visitor.php
require_once 'dbconfig/dbconfig.php';

function updateVisitorCount() {
    global $pdo;

    $currentYear = date('Y');  // Get the current year
    $currentMonth = date('m'); // Get the current month

    try {
        // Check if there's already a record for the current year and month
        $stmt = $pdo->prepare("SELECT id, visitorCount FROM visitors WHERE year = :year AND month = :month");
        $stmt->bindParam(':year', $currentYear, PDO::PARAM_INT);
        $stmt->bindParam(':month', $currentMonth, PDO::PARAM_INT);
        $stmt->execute();

        // If the record exists, update it
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Increment the visitor count for the current month
            $newCount = $row['visitorCount'] + 1;
            $updateStmt = $pdo->prepare("UPDATE visitors SET visitorCount = :visitorCount WHERE id = :id");
            $updateStmt->bindParam(':visitorCount', $newCount, PDO::PARAM_INT);
            $updateStmt->bindParam(':id', $row['id'], PDO::PARAM_INT);
            $updateStmt->execute();
        } else {
            // If no record exists, create a new record for the current month and year
            $insertStmt = $pdo->prepare("INSERT INTO visitors (year, month, visitorCount) VALUES (:year, :month, 1)");
            $insertStmt->bindParam(':year', $currentYear, PDO::PARAM_INT);
            $insertStmt->bindParam(':month', $currentMonth, PDO::PARAM_INT);
            $insertStmt->execute();
        }

    } catch (PDOException $e) {
        echo "Update failed: " . $e->getMessage();
    }
}

function getVisitorCount() {
    global $pdo;

    $currentYear = date('Y');  // Get the current year
    $currentMonth = date('m'); // Get the current month

    try {
        // Fetch the visitor count for the current month and year
        $stmt = $pdo->prepare("SELECT visitorCount FROM visitors WHERE year = :year AND month = :month");
        $stmt->bindParam(':year', $currentYear, PDO::PARAM_INT);
        $stmt->bindParam(':month', $currentMonth, PDO::PARAM_INT);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $row['visitorCount'];
        } else {
            return 0; // No visitors recorded for this month yet
        }
    } catch (PDOException $e) {
        echo "Query failed: " . $e->getMessage();
        return 0;
    }
}
?>
