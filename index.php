<?php
include('post.php');

// Pobieranie postów
$post = new Post();
$posts = $post->getPosts();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Blog</title>
</head>
<body>
    <header>
        <h1>Webdevstudio Blog</h1>
        <button id="admin"><a href="admin.php">Admin</a></button>
    </header>
    <main id="posts-container" class="grid-container">
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <div class="post-gradient"></div>
                <div class="post-opis">
                    <a href="podstrona.php?id=<?php echo $post['id']; ?>"><h2><?php echo $post['title']; ?></h2></a>
                    <p><?php echo $post['content']; ?></p>
                </div>
                

                <!-- Wyswietlanie obrazkow -->
                <?php if (!empty($post['images'])): ?>
                    <div class="post-images">
                        <?php foreach ($post['images'] as $imagePath): ?>
                            <img src="<?php echo $imagePath; ?>" alt="Zdjecie">
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </main>
    <footer>
        <p>&copy; 2023 Webdevstudio Blog</p>
    </footer>
    <script src="js/main.js"></script>
</body>
</html>