<?php
include('post.php');

// Dodawanie postów
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $post = new Post();
    $post->addPost($title, $content);

    // Dodawanie obrazów
    if (!empty($_FILES['images']['name'][0])) {
        $post->addImages($post->getLastInsertedId(), $_FILES['images']);
    }
}

// Edycjia i usuwanie postów
if (isset($_GET['action'])) {
    $post = new Post();
    $post_id = $_GET['post_id'];

    if ($_GET['action'] === 'edit') {
        // Dane posta do edycji
        $post_data = $post->getPostById($post_id);

        // Obsługa zapisu zmian po edycji
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_post'])) {
            $edited_title = $_POST['title'];
            $edited_content = $_POST['content'];

            $post->editPost($post_id, $edited_title, $edited_content);

            
            header('Location: admin.php');
            exit();
        }
    } elseif ($_GET['action'] === 'delete') {
        
        $post->deletePost($post_id);
        
        header('Location: admin.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Admin - Blog</title>
</head>
<body>
    <header>
        <h1>Admin - Blog</h1>
    </header>
    <main>
        <h2>Dodaj nowy post</h2>
        <form action="admin.php" method="post" enctype="multipart/form-data">
            <label for="title">Tytuł:</label>
            <input type="text" name="title" required>

            <label for="content">Treść:</label>
            <textarea name="content" rows="4" required></textarea>

            <label for="images">Dodaj obrazy:</label>
            <input type="file" name="images[]" multiple accept="image/*">

            <button type="submit">Dodaj post</button>
        </form>
        <?php if (isset($post_data)): ?>
            <!-- Formularz edycji posta -->
            <h2>Edytuj post</h2>
            <form action="admin.php?action=edit&post_id=<?php echo $post_id; ?>" method="post">
                <input type="hidden" name="update_post" value="1">
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <label for="title">Tytuł:</label>
                <input type="text" name="title" value="<?php echo $post_data['title']; ?>" required>

                <label for="content">Treść:</label>
                <textarea name="content" rows="4" required><?php echo $post_data['content']; ?></textarea>

                <button type="submit">Zapisz zmiany</button>
            </form>
        <?php endif; ?>
        <!-- Lista postów -->
        <h2>Lista postów</h2>
        <ul>
            <?php
            $posts = (new Post())->getPosts();

            foreach ($posts as $post) {
                echo "<li>{$post['title']} <br> (<a href=\"admin.php?action=edit&post_id={$post['id']}\">Edytuj</a> | ";
                echo "<a href=\"admin.php?action=delete&post_id={$post['id']}\" onclick=\"return confirm('Czy na pewno chcesz usunąć ten post?')\">Usuń</a>)</li>";
            }
            ?>
        </ul>
    </main>
    <footer>
        <p>&copy; 17:11:23 Admin | Webdevstudio</p>
    </footer>
</body>
</html>
