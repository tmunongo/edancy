<?php
session_start();
include "../includes/header.php";
include_once("../config/db.php");

// Check if the user is already authenticated
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    header('Location: index.php');
    exit;
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Perform authentication logic here
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];

    // Hash the password
    $hash = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO users (email, full_name, password_hash) VALUES (:email,:full_name, :hash)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':full_name', $fullname);
    $stmt->bindParam(':hash', $hash);
    try {
        //code...
        $result = $stmt->execute();
        // If authentication is successful, set the session variable
        if ($result) {
            // Fetch the user data from the database
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            $_SESSION['authenticated'] = true;
            $_SESSION['user'] = $user;
            header('Location: index.php');
            exit;
        } else {
            $error = "Registration failed. Please try again.";
        }
    } catch (PDOException $e) {
        if ($e->getCode() === '23000' && strpos($e->getMessage(), 'Duplicate entry') !== false) {
            // Handle the duplicate entry error
            // Display an error message to the user or perform any necessary actions
            $error = "Email already exists. Please choose a different email.";
        } else {
            // Handle other PDO exceptions
            // Display a generic error message or perform appropriate error handling
            $error = "Registration failed. Please try again.";
        }
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
            <form method="POST" action="" class="login-form">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" placeholder="user@example.com" required><br>
                <label for="email">Full Name:</label>
                <input type="text" name="fullname" id="fullname" placeholder="John Doe" required><br>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Password" required><br>
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" placeholder="Confirm Password">
                <p id="passwordMatch"></p><br>
                <input type="submit" id="submit" value="Register" class="btn btn-primary"><br>
                <?php if (isset($error)) {
                    echo "<p class='text-danger'>$error</p>";
                } ?>
                <a href="login.php">Already Have An Account?</a>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // When the user types in the password or confirmation password field
            $('#password, #confirmPassword').on('keyup', function() {
                var password = $('#password').val();
                var confirmPassword = $('#confirmPassword').val();

                if (password === confirmPassword) {
                    // Passwords match
                    $('#passwordMatch').text('').removeClass('error').addClass('success');
                    $('#submit').prop('disabled', false).removeClass('disabled');
                } else {
                    // Passwords do not match
                    $('#passwordMatch').text('Passwords do not match').removeClass('success').addClass('text-danger');
                    $('#submit').addClass('disabled').removeClass('btn-primary').prop('disabled', true);
                }
            });
        });
    </script>
</body>

</html>