<?php
include_once("../config/db.php");
session_start();

// Check if the user is already authenticated
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    header('Location: index.php');
    exit;
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform authentication logic here, assuming $db is the PDO database connection

    // Prepare the query to fetch the user by email
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if a user with the given email exists
    if ($user) {
        // Verify the password
        if (password_verify($password, $user['password_hash'])) {
            // Password matches, set the authentication session variable
            $_SESSION['authenticated'] = true;
            header('Location: index.php');
            exit;
        } else {
            $error = "Invalid credentials. Please try again.";
        }
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
            <form method="POST" action="" class="login-form">
                <label for="username">Email:</label>
                <input type="email" name="email" id="email" required><br>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required><br>
                <input type="submit" value="Log In">
                <?php if (isset($error)) {
                    echo "<p class='text-primary-emphasis bg-primary-subtle border border-primary-subtle'>$error</p>";
                } ?>
            </form>
        </div>
    </div>
</body>

</html>