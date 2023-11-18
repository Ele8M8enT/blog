<?php
include('post.php');

$action = isset($_GET['action']) ? $_GET['action'] : '';

$post = new Post();

switch ($action) {
    case 'add':
        
        $title = $_POST['title'];
        $content = $_POST['content'];
        $result = $post->addPost($title, $content);

        if ($result) {
            echo "Post dodany pomyślnie!";
        } else {
            echo "Błąd podczas dodawania postu.";
        }
        break;

    case 'edit':
        
        $postId = $_POST['post_id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $result = $post->editPost($postId, $title, $content);

        if ($result) {
            echo "Post edytowany pomyślnie!";
        } else {
            echo "Błąd podczas edycji postu.";
        }
        break;

    case 'delete':
        
        $postId = $_GET['post_id'];
        $result = $post->deletePost($postId);

        if ($result) {
            echo "Post usunięty pomyślnie!";
        } else {
            echo "Błąd podczas usuwania postu.";
        }
        break;

    default:
        echo "Nieznana akcja.";
        break;
}
?>
