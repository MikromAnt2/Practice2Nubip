
<?php
require_once 'php_vendor/vendor/autoload.php';
use Google\Client as Google_Client;
use Google\Service\Drive as Google_Service_Drive;
use Google\Service\Drive\DriveFile as Google_Service_Drive_DriveFile;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_info";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['title'], $_POST['artist'], $_POST['genre'], $_FILES['music'], $_FILES['cover'])) {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $genre = $_POST['genre'];
    $sql = "INSERT INTO songs (title, artist, genre) VALUES ('$title', '$artist', '$genre')";
    if ($conn->query($sql) === TRUE) {
        $newRecordId = $conn->insert_id;
        $client = new Google_Client();
        $client->setAuthConfig('../musicsiteproject-a4a256ea7f3a.json');
        $client->addScope(Google_Service_Drive::DRIVE);
        $service = new Google_Service_Drive($client);
        $musicFilesFolderId = '1yQPjn6m9-QPTINUiWr8X9FfPwJK-d4rN';
        $musicCoversFolderId = '1p6H5uhZTBmsswv5Ahpz_2-OlR8tDIi-G';
        $musicFile = $_FILES['music'];
        $content = file_get_contents($musicFile['tmp_name']);
        $musicFileMetadata = new Google_Service_Drive_DriveFile(array(
            'name' => $newRecordId . ".mp3",
            'parents' => [$musicFilesFolderId]
        ));
        $musicFile = $service->files->create($musicFileMetadata, array(
            'data' => $content,
            'mimeType' => 'audio/mp3',
            'uploadType' => 'multipart',
            'fields' => 'id'
        ));
        $musicFileId = $musicFile->id;
        $coverFile = $_FILES['cover'];
        $content = file_get_contents($coverFile['tmp_name']);
        $coverFileMetadata = new Google_Service_Drive_DriveFile(array(
            'name' => $newRecordId . ".png",
            'parents' => [$musicCoversFolderId]
        ));
        $coverFile = $service->files->create($coverFileMetadata, array(
            'data' => $content,
            'mimeType' => 'image/png',
            'uploadType' => 'multipart',
            'fields' => 'id'
        ));
        $coverFileId = $coverFile->id;
        $conn->close();
        header("Location: http://localhost:63342/GroupProject/index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Please fill out all the required fields.";
}

?>