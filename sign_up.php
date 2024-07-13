<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sign_in'])) {
    $sign_email = $_POST['sign_email'];
    $sign_pass = $_POST['sign_pass'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "users_info";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $sign_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $stored_hash = $row['password'];


        if (password_verify($sign_pass, $stored_hash)) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: http://localhost:63342/GroupProject/index.php");
        } else {
            echo 'Incorrect password';
        }
    } else {
        echo 'Email not registered';
    }

    $stmt->close();
    $conn->close();
} elseif (isset($_SESSION['user_id'])) {
    echo $_SESSION['user_id'];
} else{
    echo '0';
}
?>
