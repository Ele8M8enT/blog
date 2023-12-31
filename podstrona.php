<?php
include('post.php');

$post = new Post();
$postId = $_GET['id'] ?? 0;
$singlePost = $post->getPostById($postId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Webdevstudio Blog - <?php echo $singlePost['title']; ?></title>
</head>
<body>
    <header>
        <h1>Webdevstudio Blog</h1>
    </header>
    <main>
        <div class="post-strona">
            <h2><?php echo $singlePost['title']; ?></h2>
            <p><?php echo $singlePost['content']; ?></p>

            
            <?php if (!empty($singlePost['images'])): ?>
                <div class="post-images">
                    <?php foreach ($singlePost['images'] as $imagePath): ?>
                        <img src="<?php echo $imagePath; ?>" alt="Post Image">
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>
    <footer>
        <p>Webdevstudio Blog</p>
    </footer>
    <script src="js/main.js"></script>
</body>
</html>
