<?php
include('post.php');

$post = new Post();

// Pobierz czas ostatniego odpytania z sesji
session_start();
$lastCheckTime = $_SESSION['lastCheckTime'] ?? null;

// Pobierz najnowszy post od czasu ostatniego odpytania
$latestPost = $post->getLatestPostSince($lastCheckTime);

// Zapisz aktualny czas jako czas ostatniego odpytania
$_SESSION['lastCheckTime'] = time();

header('Content-Type: application/json');
echo json_encode(['newPost' => $latestPost !== null]);
?>