<?php

include "../../config/db.php";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted form data
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $description = $_POST['description'];
    $aboutDescription = $_POST['about_description'];
    $contactDescription = $_POST['contact_description'];

    // Update the home page data in the database
    $updateQuery = "UPDATE home_page SET 
        title = :title,
        subtitle = :subtitle,
        description = :description,
        about_description = :aboutDescription,
        contact_description = :contactDescription
        WHERE id = 1"; // Assuming the home page entry has an ID of 1

    $updateStmt = $db->prepare($updateQuery);
    $updateStmt->bindParam(':title', $title);
    $updateStmt->bindParam(':subtitle', $subtitle);
    $updateStmt->bindParam(':description', $description);
    $updateStmt->bindParam(':aboutDescription', $aboutDescription);
    $updateStmt->bindParam(':contactDescription', $contactDescription);
    $updateStmt->execute();

    // Update the founders data in the database
    foreach ($_POST['founder_id'] as $index => $founderId) {
        $founderTitle = $_POST['founder_title'][$index];
        $founderName = $_POST['founder_name'][$index];
        $founderDescription = $_POST['founder_description'][$index];
        $founderFbLink = $_POST['founder_social_fb'][$index];
        $founderLinkedInLink = $_POST['founder_social_link'][$index];
        $founderEmail = $_POST['founder_social_email'][$index];
        $founderPhone = $_POST['founder_social_phone'][$index];

        $founderUpdateQuery = "UPDATE founders SET 
            founder_title = :founderTitle,
            founder_name = :founderName,
            founder_details = :founderDescription,
            fb_link = :founderFbLink,
            linkedin_link = :founderLinkedInLink,
            email = :founderEmail,
            phone = :founderPhone
            WHERE id = :founderId";

        $founderUpdateStmt = $db->prepare($founderUpdateQuery);
        $founderUpdateStmt->bindParam(':founderTitle', $founderTitle);
        $founderUpdateStmt->bindParam(':founderName', $founderName);
        $founderUpdateStmt->bindParam(':founderDescription', $founderDescription);
        $founderUpdateStmt->bindParam(':founderFbLink', $founderFbLink);
        $founderUpdateStmt->bindParam(':founderLinkedInLink', $founderLinkedInLink);
        $founderUpdateStmt->bindParam(':founderEmail', $founderEmail);
        $founderUpdateStmt->bindParam(':founderPhone', $founderPhone);
        $founderUpdateStmt->bindParam(':founderId', $founderId);
        $founderUpdateStmt->execute();
    }

    // Update the services data in the database
    foreach ($_POST['service_id'] as $index => $serviceId) {
        $serviceTitle = $_POST['service_title'][$index];
        $serviceDescription = $_POST['service_description'][$index];

        $serviceUpdateQuery = "UPDATE services SET 
            title = :serviceTitle,
            description = :serviceDescription
            WHERE id = :serviceId";

        $serviceUpdateStmt = $db->prepare($serviceUpdateQuery);
        $serviceUpdateStmt->bindParam(':serviceTitle', $serviceTitle);
        $serviceUpdateStmt->bindParam(':serviceDescription', $serviceDescription);
        $serviceUpdateStmt->bindParam(':serviceId', $serviceId);
        $serviceUpdateStmt->execute();
    }

    header("Location: " . "../manage-home.php");
}
