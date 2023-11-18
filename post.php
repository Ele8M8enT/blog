<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!class_exists('Post')) {
    

class Post {
    private $db;
    private $conn;

    public function __construct() {
        include('database.php');
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    public function getLatestPostSince($timestamp) {
        $conn = $this->db->getConnection();
        
        
        $query = "SELECT * FROM posts WHERE created_at > FROM_UNIXTIME(?) ORDER BY created_at DESC LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $timestamp);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_assoc();
    }

    public function getLatestPost() {
        $conn = $this->db->getConnection();
        $query = "SELECT * FROM posts ORDER BY created_at DESC LIMIT 1";
        $result = $conn->query($query);
    
        return $result->fetch_assoc();
    }

    public function getPosts() {
        $conn = $this->db->getConnection();
        $query = "SELECT posts.*, GROUP_CONCAT(images.path) as images FROM posts LEFT JOIN images ON posts.id = images.post_id GROUP BY posts.id ORDER BY posts.created_at DESC";
        $result = $conn->query($query);
    
        $posts = array();
        while ($row = $result->fetch_assoc()) {
            $row['images'] = $row['images'] ? explode(',', $row['images']) : array(); 
            $posts[] = $row;
        }
    
        return $posts;
    }

    public function getPostById($postId) {
        $conn = $this->db->getConnection();
        $postId = $conn->real_escape_string($postId);
        $query = "SELECT * FROM posts WHERE id = $postId";
        $result = $conn->query($query);

        return $result->fetch_assoc();
    }

    public function addPost($title, $content) {
        $conn = $this->db->getConnection();
        $title = $conn->real_escape_string($title);
        $content = $conn->real_escape_string($content);
        
        $query = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
        return $conn->query($query);
    }

    public function addImages($post_id, $images) {
        
        foreach ($images['name'] as $key => $image_name) {
            $tmp_name = $images['tmp_name'][$key];
            $path = "images/" . basename($image_name);
            move_uploaded_file($tmp_name, $path);

            
            $sql = "INSERT INTO images (post_id, path) VALUES (?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("is", $post_id, $path);
            $stmt->execute();
            $stmt->close();
        }
    }

    public function getLastInsertedId() {
        return $this->conn->insert_id;
    }

    public function editPost($postId, $title, $content) {
        $conn = $this->db->getConnection();
        $postId = $conn->real_escape_string($postId);
        $title = $conn->real_escape_string($title);
        $content = $conn->real_escape_string($content);

        $query = "UPDATE posts SET title='$title', content='$content' WHERE id=$postId";
        return $conn->query($query);
    }

    public function deletePost($postId) {
        $conn = $this->db->getConnection();
        $postId = $conn->real_escape_string($postId);
        
        $query = "DELETE FROM posts WHERE id=$postId";
        return $conn->query($query);
    }
}}
?>
