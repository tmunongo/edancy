<?php
include "../config/db.php";

$user = $_SESSION['user'];

$query = "SELECT * FROM posts WHERE author_id = :author_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':author_id', $user['id']);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container">
    <h2 class="mb-4">Latest Posts</h2>
    <div class="row">
        <?php foreach ($posts as $post) : ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo $post['cover']; ?>" class="card-img-top" alt="Post Cover">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $post['title']; ?></h5>
                        <p class="card-text"><?php echo $post['summary']; ?></p>
                        <a href="<?php echo $post['link']; ?>" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>