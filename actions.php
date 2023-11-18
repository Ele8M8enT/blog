<?php
include('post.php');

$action = isset($_GET['action']) ? $_GET['action'] : '';

$post = new Post();

switch ($action) {
    case 'add':
        // Przykładowa obsługa dodawania nowego postu
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
        // Przykładowa obsługa edycji istniejącego postu
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
        // Przykładowa obsługa usuwania postu
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