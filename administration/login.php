<?php
session_start();
require '../dbconfig/dbconfig.php'; // <- This includes your DB connection

if (isset($_SESSION['admin'])) {
    header('Location: dashboard.php');
    exit();
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the input values from the form
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Prepare SQL to fetch the admin account by username
    $stmt = $pdo->prepare("SELECT * FROM adminAccount WHERE Username = :username LIMIT 1");
    $stmt->execute(['username' => $username]);

    // Fetch the user data from the database
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the user exists and the password is correct
    if ($admin && password_verify($password, $admin['Password'])) {
        // Password is correct, login success
        $_SESSION['admin'] = $admin['Username'];
        header("Location: dashboard.php"); // Redirect to the dashboard
        exit();
    } else {
        // Invalid username or password
        echo "<script>alert('Invalid username or password');window.history.back();</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-[#3d3d3d] flex items-center justify-center min-h-screen">
    <form action="login.php" method="POST">
        <div class="bg-[#272c2b] shadow-md rounded-md p-6">
            <h2 class="text-2xl text-[#f99810] font-bold text-start mb-10 w-full">Admin Login</h2>
            <div class="px-4">
                <div class="flex flex-row items-center justify-between mb-4 gap-4">
                    <div>
                        <label class="text-sm font-semibold text-white" for="username">Username:</label>
                    </div>
                    <div class="flex-1 px-2 py-1 bg-gray-200 rounded-md w-[250px]">
                        <input name="username" class="w-full text-xs font-semibold outline-none bg-gray-200 " type="text" required>
                    </div>
                </div>
                <div class="flex flex-row items-center justify-between mb-4">
                    <div class="w-1/4">
                        <label class="text-sm font-semibold text-white" for="password ">Password:</label>
                    </div>
                    <div class="w-3/4 flex-1 px-2 py-1 bg-gray-200 rounded-md w-[250px]">
                        <input name="password" class="w-full text-xs font-semibold outline-none bg-gray-200 " type="password" required>
                    </div>
                </div>
                <div class="py-4">
                    <button type="submit" class="w-full bg-orange-500 text-white text-sm font-bold px-4 py-2 rounded">Login</button>
                </div>

            </div>
        </div>
    </form>
</body>
</html>