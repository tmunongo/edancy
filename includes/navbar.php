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
    <nav class="navbar sticky-top navbar-light">
        <a class="navbar-brand" href="index.php">
            <img src="./assets/images/2.png" width="200">
        </a>
        <!-- Add navbar content here -->
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a href="index.php" aria-current="page" class="nav-link active">
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a href="#about" aria-current="page" class="nav-link">
                    About
                </a>
            </li>
            <li class="nav-item">
                <a href="#services" aria-current="page" class="nav-link">
                    Services
                </a>
            </li>
            <li class="nav-item">
                <a href="#" aria-current="page" class="nav-link">
                    Blog
                </a>
            </li>
            <li class="nav-item">
                <a href="#contact" aria-current="page" class="nav-link">
                    Contact Us
                </a>
            </li>
        </ul>
    </nav>
</body>

</html>