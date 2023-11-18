<?php
include('post.php');

$post = new Post();

// Czas ostatniego odpytania z sesji
session_start();
$lastCheckTime = $_SESSION['lastCheckTime'] ?? null;

// Najnowszy post od czasu ostatniego odpytania
$latestPost = $post->getLatestPostSince($lastCheckTime);

// Aktualny czas jako czas ostatniego odpytania
$_SESSION['lastCheckTime'] = time();

header('Content-Type: application/json');
echo json_encode(['newPost' => $latestPost !== null]);
?>
