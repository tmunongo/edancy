<?php
session_start();
include "../includes/header.php";

// Check if the user is already authenticated
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    header('Location: index.php');
    exit;
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Perform authentication logic here
    $hash = password_hash($password, PASSWORD_BCRYPT);

    // If authentication is successful, set the session variable
    if ($authenticated) {
        $_SESSION['authenticated'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = "Invalid credentials. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Registration</title>
    <link rel="stylesheet" href="../styles/main.css">
    <!-- /* Import the CSS file into your HTML */ -->
    <link rel="stylesheet" href="styles/main.css">
    <!-- Bootstrap v5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="login-container">

            <h1>Admin Login</h1>
            <!-- Add login form here -->
            <form method="POST" action="" class="logn-form">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required><br>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required><br>
                <input type="submit" value="Log In">
                <?php if (isset($error)) {
                    echo "<p>$error</p>";
                } ?>
            </form>
        </div>
    </div>
</body>

</html>