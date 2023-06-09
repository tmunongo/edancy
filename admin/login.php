<?php
session_start();

// Check if the user is already authenticated
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    header('Location: dashboard.php');
    exit;
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Perform authentication logic here
    // If authentication is successful, set the session variable
    if ($authenticated) {
        $_SESSION['authenticated'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Invalid credentials. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../styles/main.css">
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