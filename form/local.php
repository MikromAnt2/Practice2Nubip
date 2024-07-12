<?php

$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "users_info";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO user_playlists (title, artist, JPOP) VALUES (:title, :artist, :genre)");

    $title = $_POST['title'];
    $author = $_POST['artist'];
    $genre = "JPOP";

    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':artist', $author);
    $stmt->bindParam(':genre', $genre);
    $stmt->execute();
    $conn = null;

    header("Location: http://localhost:63342/GroupProject/index.php");
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
$title = $_POST['title'];
$author = $_POST['artist'];



$music_tmp_name = $_FILES['music']['tmp_name'];
$music_extension = pathinfo($_FILES['music']['name'], PATHINFO_EXTENSION);

$image_tmp_name = $_FILES['cover']['tmp_name'];
$image_extension = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);

$id = uniqid();

$music_dir = '/form/php_vendor/audio/';
$image_dir = '/form/php_vendor/audio/img/';

$music_path = $music_dir . $title . '_' . $author . '.' . $music_extension;
$image_path = $image_dir . $title . '_' . $author . '.' . $image_extension;

move_uploaded_file($music_tmp_name, $_SERVER['DOCUMENT_ROOT'] . $music_path);
move_uploaded_file($image_tmp_name, $_SERVER['DOCUMENT_ROOT'] . $image_path);

$json_file = $_SERVER['DOCUMENT_ROOT'] . $music_dir . 'audioFiles.json';
$json_data = json_decode(file_get_contents($json_file), true);

$new_entry = array(
    'id' => count($json_data) + 1,
    'url' => $music_path,
    'title' => $title,
    'author' => $author,
    'image' => $image_path
);

$json_data[] = $new_entry;

file_put_contents($json_file, json_encode($json_data, JSON_PRETTY_PRINT));

header("Location: http://localhost:63342/GroupProject/index.php");
?>
