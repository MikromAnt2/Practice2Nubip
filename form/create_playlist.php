<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $playlist_name = $_POST['playlist_name'];
    $playlist_description = $_POST['playlist_description'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "users_info";
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        $playlist_name = $conn->real_escape_string($playlist_name);
        $playlist_description = $conn->real_escape_string($playlist_description);

        $stmt = $conn->prepare("INSERT INTO user_playlists(user_id, playlist_name, playlist_description) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $playlist_name, $playlist_description);

        if ($stmt->execute()) {
            header("Location: index.php");
        } else {
            echo 'Error: ' . $conn->error;
        }
        $stmt->close();
        $conn->close();
    } else {
        echo "User not logged in";
    }
}
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$sql = "SELECT playlist_name, playlist_description FROM user_playlists WHERE user_id = $user_id";
$result = $conn->query($sql);

$playlists = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $playlists[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();

include 'display_playlists.php';
?>
