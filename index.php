<?php
include 'config/db.php';

// Query to retrieve data from the home_page table
$query = "SELECT * FROM home_page";
$stmt = $db->prepare($query);
$stmt->execute();
$pageData = $stmt->fetch();

$query = "SELECT * from founders";
$stmt = $db->prepare($query);
$stmt->execute();
$founders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Query to retrieve services from the services table
$query = "SELECT * FROM services";
$stmt = $db->prepare($query);
$stmt->execute();
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Extract individual data fields
$banner_title = $pageData['title'];
$subtitle = $pageData['subtitle'];
$banner_description = $pageData['description'];
$about_description = $pageData['about_description'];
// $services_title = $pageData['services_title'];
// $services_description = $pageData['services_description'];
$contact_description = $pageData['contact_description'];

// Fetch data from the database and generate a PHP array

// Generate the JavaScript code dynamically using PHP
$jsCode = "";
$counter = 1;
foreach ($services as $service) {
    $title = $service['title'];
    $description = $service['description'];

    $serviceVar = "service{$counter}";
    $cellVar = "cell{$counter}";

    $jsCode .= "const $serviceVar = {";
    $jsCode .= "title: '$title',";
    $jsCode .= "description: '$description'";
    $jsCode .= "};";
    $jsCode .= "const $cellVar = createHoneycombCell($serviceVar);";
    $jsCode .= "honeycomb.appendChild($cellVar);";

    $counter++;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Edancy Consultancy</title>
    <!-- /* Import the CSS file into your HTML */ -->
    <link rel="stylesheet" type="text/css" href="styles/main.css">
    <!-- Bootstrap v5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Slick Carousel JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <script src="./assets/js/services.js"></script>
</head>

<body style="font-family: 'Inter', sans-serif;">
    <?php
    include_once "includes/navbar.php";
    ?>
    <div id="banner" class="banner home-banner" id="banner">
        <div class="banner-content">
            <h1 class="banner-title">
                <?php echo $banner_title ?>
            </h1>
            <h3 class="banner-subtitle">
                <?php echo $subtitle ?>
            </h3>
            <div class="banner-description">
                <p class="banner-description">
                    <?php echo $banner_description ?>
                </p>
            </div>
            <div class="banner-buttons">
                <button class="banner-button banner-button-services" onclick="location.href='#services'">
                    Our Services
                </button>
                <button class="banner-button banner-button-contact" onclick="location.href='#contact'">
                    Get in touch!
                </button>
            </div>
        </div>
        <div class=" banner-image">
            <div class="banner-image-inner">
                <img src="./assets/images/Public health-amico.svg" alt="Banner image" />
            </div>
        </div>
    </div>
    <div class="container">
        <!-- About Section -->
        <div class="about" id="about">
            <div class="about-image">
                <img src="./assets/images/Medical prescription-bro (1).svg" alt="about us" />
            </div>
            <div class="about-content">
                <h2 class="about-title">About Us</h2>
                <div class="about-description">
                    <?php echo $about_description ?>
                </div>
            </div>
        </div>
        <!--  The Team section -->
        <section class="bg-light p-4" id="team">
            <div class="container">
                <h3 class="text-center my-8" style="margin-bottom: 24px;">
                    The Founders
                </h3>
                <div class="row d-flex align-items-center justify-content-center px-8">
                    <div class="row justify-content-center">
                        <?php foreach ($founders as $founder) : ?>
                            <div class="col-lg-6 col-xl-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <div class="d-flex align-items-center justify-content-center mb-4">
                                            <div class="p-4">
                                                <img src="./assets/images/man.jpg" class="card-img-top" alt="Founder Image">
                                            </div>
                                            <div>
                                                <h5 class="card-title" style="text-transform: capitalize;"><?php echo $founder['founder_title'] . " " . $founder['founder_name']; ?></h5>
                                                <p class="card-text"><?php echo $founder['role']; ?></p>
                                                <div class="d-flex align-items-center justify-content-between p-2">
                                                    <a href="<?php echo $founder['fb_link']; ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
                                                            <!-- Font Awesome icon -->
                                                        </svg>
                                                    </a>
                                                    <a href="<?php echo $founder['linkedin_link']; ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512">
                                                            <!-- Font Awesome icon -->
                                                        </svg>
                                                    </a>
                                                    <a href="mailto:<?php echo $founder['email']; ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
                                                            <!-- Font Awesome icon -->
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="flex-grow-1">
                                            <?php echo $founder['founder_details']; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>


                    <!-- Repeat the above card markup for each employee -->
                </div>
            </div>
        </section>
        <!-- Services -->
        <div id="services" class="services-container mt-20 md:px-8 pt-2 pb-16">
            <h2 class="services-title mt-3 mb-1 py-4 text-center text-althighlight">
                Services
            </h2>
            <h3 class="services-subtitle mb-2 text-center text-gray-500 text-sm italic">
                What We Do
            </h3>
            <!-- <div class="carousel-container flex items-center justify-around" style="min-height: 350px;">
             <div id="carousel-body" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    Carousel items go here
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-body" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel-body" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                </div>
            </div> -->
            <!-- Services Alt -->
            <section class="services">
                <ul class="honeycomb" lang="en">
                    <li class="honeycomb-cell">
                        <img class="honeycomb-cell__image" src="https://source.unsplash.com/random/1">
                        <div class="honeycomb-cell__title">Diseño exclusivo</div>
                    </li>
                </ul>
            </section>
            <!-- Contact Us  -->
            <section id="contact" class="bg-light">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="text-center mb-5">
                                <h2 class="my-4">Contact Us</h2>
                                <p class="lead">
                                    <?php echo $contact_description ?>
                                    <!-- Need to get in touch? Do not hesitate to call
                                    <a href="tel:0717486403">0717486403</a> /
                                    <a href="tel:077828533">0778455415</a> or email us directly at
                                    <a href="mailto:inquiries@hearts.co.zw">inquiries@edancy.co.zw</a>.
                                    You can also fill in the form below and we'll respond. -->
                                </p>
                            </div>
                            <form id="contactForm" method="POST" action="admin/utils/submit-contact-form.php">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="fw-bolder">Your Name</label>
                                            <input type="text" class="form-control my-3" id="name" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="fw-bolder">Your Email</label>
                                            <input type="email" class="form-control my-3" id="email" name="email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message" class="fw-bolder">Message</label>
                                    <textarea class="form-control my-3" id="message" name="message" rows="5" required></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- Footer -->
    <?php include_once "includes/footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        //     $(document).ready(function() {
        //    $.each(serviceData, function(index, item) {
        //     var carouselItem = $('<div class="carousel-item"></div>');

        //     var itemContent = $('<div class="flex flex-col items-center justify-around mx-2 w-72 md:w-96 h-full bg-[#F2F8F3] shadow-md p-8"></div>');

        //     var image = $('<img class="d-block m-auto carousel-item-icon" alt="icon">');
        //     image.attr('src', item.icon);

        //     var title = $('<h3 class="text-lg font-medium mb-2 text-center"></h3>').text(item.title);
        //     var description = $('<p class="text-gray-600 text-center"></p>').text(item.description);

        //     itemContent.append(image, title, description);
        //     carouselItem.append(itemContent);

        //     if (index === 0) {
        //         carouselItem.addClass('active');
        //     }

        //     $('.carousel-inner').append(carouselItem);
        //     });

        //     $('.carousel').carousel({
        //         interval: 3500
        //     });
        // });
    </script>
    <script>
        // JavaScript code to handle honeycomb creation and appending
        const honeycomb = document.querySelector('.honeycomb');

        // Function to create and append a new honeycomb cell
        function createHoneycombCell(service) {
            const {
                title,
                description
            } = service;

            const cell = document.createElement('li');
            cell.classList.add('honeycomb-cell');

            const imageElement = document.createElement('img');
            imageElement.classList.add('honeycomb-cell__image');
            imageElement.src = 'assets/images/blurry-gradient-haikei.png';
            cell.appendChild(imageElement);

            const titleElement = document.createElement('div');
            titleElement.classList.add('honeycomb-cell__title');
            titleElement.textContent = title;
            cell.appendChild(titleElement);

            const descriptionElement = document.createElement('div');
            descriptionElement.classList.add('honeycomb-cell__description');
            descriptionElement.textContent = description;
            cell.appendChild(descriptionElement);

            return cell;
        }

        // Function to remove existing honeycomb cells
        function removeHoneycombCells() {
            while (honeycomb.firstChild) {
                honeycomb.removeChild(honeycomb.firstChild);
            }
        }

        // Remove existing honeycomb cells
        removeHoneycombCells();

        <?php echo $jsCode; ?> // Inject the dynamically generated JavaScript code
    </script>
</body>

</html>