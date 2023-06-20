<?php
include '../config/db.php';

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
$title = $pageData['title'];
$subtitle = $pageData['subtitle'];
$description = $pageData['description'];
$about_description = $pageData['about_description'];
$services_title = $pageData['services_title'];
$services_description = $pageData['services_description'];
$contact_description = $pageData['contact_description'];
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Home Page</title>
    <link rel="stylesheet" href="../styles/admin.css">
    <!-- Bootstrap v5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="admin-body">
    <div class="sidebar-container">
        <?php
        include_once "../includes/sidebar.php";
        ?>
    </div>

    <div class="p-4" style="width: 100%;">

        <form action="utils/update-home.php" method="POST" class="w-full">
            <h2>Home</h2>

            <div class="mb-3">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>">
            </div>

            <div class="mb-3">
                <label for="subtitle">Subtitle:</label>
                <input type="text" class="form-control" id="subtitle" name="subtitle" value="<?php echo $subtitle; ?>">
            </div>

            <div class="mb-3">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" rows="5" name="description"><?php echo $description; ?></textarea>
            </div>

            <h2>About Us</h2>

            <div class="mb-3">
                <label for="about_description">Description:</label>
                <textarea class="form-control" id="about_description" rows="5" name="about_description"><?php echo $about_description; ?></textarea>
            </div>

            <div id="founders-container">
                <h2>The Founders</h2>

                <?php foreach ($founders as $index => $founder) : ?>
                    <div class="founder-section">
                        <h3>Founder <?php echo $index + 1; ?></h3>
                        <input type="hidden" name="founder_id[]" value="<?php echo $founder['id'] ?>">
                        <div class="mb-3">
                            <label for="founder_title_<?php echo $index; ?>">Title:</label>
                            <input type="text" class="form-control" id="founder_title_<?php echo $index; ?>" name="founder_title[]" value="<?php echo $founder['founder_title']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="founder_name_<?php echo $index; ?>">Name:</label>
                            <input type="text" class="form-control" id="founder_name_<?php echo $index; ?>" name="founder_name[]" value="<?php echo $founder['founder_name']; ?>">
                        </div>

                        <div class="mb-3 description-box">
                            <label for="founder_description_<?php echo $index; ?>">Description:</label>
                            <textarea class="form-control" rows="5" id="founder_description_<?php echo $index; ?>" name="founder_description[]"><?php echo $founder['founder_details']; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="founder_social_fb_<?php echo $index; ?>">Facebook:</label>
                            <input type="text" class="form-control" id="founder_social_fb_<?php echo $index; ?>" name="founder_social_fb[]" value="<?php echo $founder['fb_link']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="founder_social_link_<?php echo $index; ?>">LinkedIn:</label>
                            <input type="text" class="form-control" id="founder_social_link_<?php echo $index; ?>" name="founder_social_link[]" value="<?php echo $founder['linkedin_link']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="founder_social_email_<?php echo $index; ?>">Email:</label>
                            <input type="email" class="form-control" id="founder_social_email_<?php echo $index; ?>" name="founder_social_email[]" value="<?php echo $founder['email']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="founder_social_phone_<?php echo $index; ?>">Phone:</label>
                            <input type="text" class="form-control" id="founder_social_phone_<?php echo $index; ?>" name="founder_social_phone[]" value="<?php echo $founder['phone']; ?>">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <h2>Services</h2>
            <div id="servicesContainer">

                <?php foreach ($services as $service) : ?>
                    <input type="hidden" name="service_id[]" value="<?php echo $service['id'] ?>">
                    <div class="mb-3">
                        <label for="service_title_<?php echo $service['id']; ?>">Title:</label>
                        <input type="text" class="form-control" id="service_title_<?php echo $service['id']; ?>" name="service_title[]" value="<?php echo $service['title']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="service_description_<?php echo $service['id']; ?>">Description:</label>
                        <textarea class="form-control" id="service_description_<?php echo $service['id']; ?>" name="service_description[]"><?php echo $service['description']; ?></textarea>
                    </div>
                <?php endforeach; ?>

            </div>
            <button type="button" class="btn btn-primary" id="addServiceBtn">Add New Service</button>


            <h2>Contact</h2>

            <div class="mb-3">
                <label for="contact_description">Description:</label>
                <textarea class="form-control" id="contact_description" rows="5" name="contact_description"><?php echo $contact_description; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <script>
        // jQuery code to handle adding new services
        $(document).ready(function() {
            $('#addServiceBtn').on('click', function() {
                var servicesContainer = $('#servicesContainer');
                var serviceIndex = servicesContainer.children().length / 2; // Divide by 2 to account for the label + input/textarea fields

                var idInput = $('<input>')
                    .attr('type', 'hidden')
                    .attr('class', 'form-control')
                    .attr('name', 'service_id[]')

                var titleInput = $('<input>')
                    .attr('type', 'text')
                    .attr('class', 'form-control')
                    .attr('name', 'service_title[]')
                    .attr('placeholder', 'Service Title');

                var descriptionTextarea = $('<textarea>')
                    .attr('class', 'form-control')
                    .attr('name', 'service_description[]')
                    .attr('placeholder', 'Service Description');

                var divWrapper = $('<div>')
                    .attr('class', 'mb-3')
                    .append(idInput)
                    .append(titleInput)


                var descriptionWrapper = $('<div>')
                    .attr('class', 'mb-3')
                    .append(descriptionTextarea);

                servicesContainer.append(divWrapper);
                servicesContainer.append(descriptionWrapper);
            });
        });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#description-box'))
            .catch(error => {
                console.error(error);
            });
    </script>

</body>