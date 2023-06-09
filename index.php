<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Edancy Consultancy</title>
    <!-- /* Import the CSS file into your HTML */ -->
    <link rel="stylesheet" href="styles/main.css">
    <!-- Bootstrap v5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Slick Carousel JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="./assets/js/services.js"></script>
</head>

<body>
    <?php
    include_once "includes/navbar.php";
    ?>
    <div class="banner home-banner" style="margin-top: 0px;" id="banner">
        <div class="banner-content">
            <h1 class="banner-title">
                Welcome to <span class="highlighted-text">Edancy</span> International Consultancy
            </h1>
            <h3 class="banner-subtitle">
                Understanding health beyond diseases.
            </h3>
            <div class="banner-description">
                EIC is a service provider...Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer fermentum turpis vel elit accumsan condimentum. Ut eu purus dui. Duis ullamcorper vitae augue eu mollis.
            </div>
            <div class="banner-buttons">
                <button class="banner-button banner-button-services">
                    Our Services
                </button>
                <button class="banner-button banner-button-contact">
                    Get in touch!
                </button>
            </div>
        </div>
        <div class="banner-image">
            <div>
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
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer fermentum turpis vel elit accumsan condimentum. Ut eu purus dui. Duis ullamcorper vitae augue eu mollis. Aliquam luctus metus non egestas pharetra. Aliquam feugiat posuere massa facilisis rutrum. Aenean eu lacus in arcu finibus scelerisque in sed eros.
                </div>
            </div>
        </div>
        <!-- Services -->
        <div class="services-container mt-20 md:px-8 pt-2 pb-16 bg-althlfaded">
            <h2 class="services-title mt-3 mb-1 text-center text-althighlight">
                Services
            </h2>
            <p class="services-subtitle mb-2 text-center text-gray-500 text-sm italic">
                What We Do
            </p>
            <div class="carousel-container flex items-center justify-around" style="min-height: 250px;">
                <div class="carousel">
                    <!-- Carousel items go here -->
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Iterate over the serviceData array
            $.each(serviceData, function(index, item) {
                // Generate the carousel item dynamically
                var carouselItem = $('<div class="carousel-item"></div>');
                // Add a class for the gap between items
                carouselItem.addClass('carousel-item-gap');

                var icon = $('<img alt="icon">');
                icon.attr('src', item.icon);
                icon.addClass('carousel-item-icon');

                var title = $('<h3></h3>');
                title.text(item.title);
                title.addClass('carousel-item-title');

                var description = $('<p></p>');
                description.text(item.description);
                description.addClass('carousel-item-description');

                carouselItem.append(icon, title, description);

                // Append the carousel item to the carousel container
                $('.carousel').append(carouselItem);
            });


            // Initialize the Slick Carousel
            $('.carousel').slick({
                // Slick carousel configuration options
                // Add your options here
                arrows: true,
                slidesToShow: 3,
                dots: true,
                centerMode: true,
                focusOnSelect: true,
                // autoplay: true,
                // autoplaySpeed: 2000,
                responsive: [{
                        breakpoint: 620,
                        settings: {
                            arrows: true,
                            variableWidth: true
                        }
                    },
                    {
                        breakpoint: 345,
                        settings: {
                            arrows: true,
                            variableWidth: true
                        }
                    }
                ]
            });
        });
    </script>
</body>

</html>