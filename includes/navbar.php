<!DOCTYPE html>
<html>

<head>
    <title>Navbar</title>
</head>

<body>
    <nav class="navbar sticky-top navbar-light <?php echo $scroll ? 'navbar-scroll' : ''; ?>" style="background-color: <?php echo $scroll ? '#E1E8D9' : '#fff'; ?>">
        <a class="navbar-brand" href="index.php">
            <img src="./assets/images/eic-logo-removebg-preview (1).png" width="200">
        </a>
        <!-- Add navbar content here -->
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a href="index.php" aria-current="page" class="nav-link active">
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a href="about.php" aria-current="page" class="nav-link active">
                    About
                </a>
            </li>
            <li class="nav-item">
                <a href="services.php" aria-current="page" class="nav-link active">
                    Services
                </a>
            </li>
            <li class="nav-item">
                <a href="services.php" aria-current="page" class="nav-link active">
                    Contact Us
                </a>
            </li>
        </ul>
    </nav>
</body>

</html>