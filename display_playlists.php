<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_info";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$sql = "SELECT playlist_name, playlist_description FROM user_playlists WHERE user_id = $user_id";
$result = $conn->query($sql);

$playlists = array(); // Масив для зберігання даних про плейлисти
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $playlists[] = $row;
    }
} else {
    echo "";
}
$conn->close();

// Вивід плейлистів
if (isset($playlists)) {
    foreach ($playlists as $playlist) {
        echo '<div class="interactive_menu_playlists_playlist">';
        echo '<img alt="image" src="/images/lorem.png" class="interactive_menu_playlists_playlist_image">';
        echo '<div class="interactive_menu_playlists_playlist_description user_menu_playlists_info">';
        echo '<span class="interactive_menu_playlists_playlist_name">' . $playlist["playlist_name"] . '</span>';
        echo '<br>';
        echo '<span class="interactive_menu_playlists_playlist_creator">' . $playlist["playlist_description"] . '</span>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No playlists found.";
}
?>
