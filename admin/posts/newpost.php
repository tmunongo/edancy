<?php
include '../../config/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Post</title>
    <link rel="stylesheet" href="../../styles/admin.css">
    <!-- Bootstrap v5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="admin-body">
    <div class="sidebar-container">
        <?php
        include_once "../../includes/sidebar.php";
        ?>
    </div>
    <div class="m-4">
        <form action="../utils/process-post.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="None">None</option>
                    <!-- PHP code to fetch and populate categories from the database -->
                    <?php
                    $query = "SELECT * FROM categories";
                    $stmt = $db->prepare($query);
                    $stmt->execute();
                    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($categories as $category) {
                        echo '<option value="' . $category['category_id'] . '">' . $category['category_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="summary" class="form-label">Summary</label>
                <textarea class="form-control" id="summary" name="summary" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>

            <div class="mb-3">
                <label for="cover" class="form-label">Cover Image</label>
                <input type="file" class="form-control" id="cover" name="cover" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</body>

</html>