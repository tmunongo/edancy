<?php
session_start();
include_once("../config/db.php");

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

    echo "<script> console.log(" . json_encode($user) . "); </script>";

    // Check if a user with the given email exists
    if ($user) {
        // Verify the password
        if (password_verify($password, $user['password_hash'])) {
            // Password matches, set the authentication session variable
            $_SESSION['authenticated'] = true;
            $_SESSION['user'] = $user;
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
    <!-- Bootstrap v5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container" style="min-height: 100vh; display: flex; align-items: center; justify-content:center;">
        <div class="login-container">

            <img src="../assets/images/2.png" alt="edancy logo" class="mb-4">

            <h1>Admin Login</h1>
            <!-- Add login form here -->
            <form method="POST" action="" class="login-form">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required><br>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required><br>
                <input type="submit" value="Log In" class="btn btn-primary">
                <p class="my-4">
                    <a href="register.php">
                        No Account? Register Here.
                    </a>
                </p>
                <?php if (isset($error)) {
                    echo "<p class='text-primary-emphasis bg-primary-subtle text-danger'>$error</p>";
                } ?>
            </form>
        </div>
    </div>
</body>

</html>