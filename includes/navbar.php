<?php
// Set the initial value of $scroll to false
$scroll = false;

// Function to check if the user has scrolled
function checkScroll()
{
    echo '<script>
    $(document).ready(function() {
        window.addEventListener("scroll", function() {
            // Set the value of the $scroll variable based on the scroll position
            var scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollPosition > 0) {
                ' . '$scroll = true;' . '
            } else {
                ' . '$scroll = false;' . '
            }
        });
    });
    </script>';
}

// Call the checkScroll function to enable scroll tracking
checkScroll();
?>


<!DOCTYPE html>
<html>

<head>
    <title>Navbar</title>
</head>

<body>
    <nav class="navbar sticky-top navbar-light navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php" style="margin: 0px;">
                <img src="./assets/images/2.png" width="200" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Add navbar content here -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-pills me-auto mb-2 mb-lg-0">
                    <li class="nav-item p-2">
                        <a href="index.php" class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/index.php') ? 'active' : ''; ?>">
                            Home
                        </a>
                    </li>
                    <li class="nav-item p-2">
                        <a href="#about" class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/index.php/#about') ? 'active' : ''; ?>">
                            About
                        </a>
                    </li>
                    <li class="nav-item p-2">
                        <a href="#services" class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/index.php#services') ? 'active' : ''; ?>">
                            Services
                        </a>
                    </li>
                    <li class="nav-item p-2">
                        <a href="#" class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/blog.php') ? 'active' : ''; ?>">
                            Blog
                        </a>
                    </li>
                    <li class="nav-item p-2">
                        <a href="#contact" class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/#contact') ? 'active' : ''; ?>">
                            Contact Us
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</body>

</html>