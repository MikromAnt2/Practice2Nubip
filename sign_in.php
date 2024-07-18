<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sign_in'])) {
    $sign_email = filter_var($_POST['sign_email'], FILTER_SANITIZE_EMAIL);
    $sign_pass = $_POST['sign_pass'];

    if (!filter_var($sign_email, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email format';
        exit();
    }

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

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_hash = $row['password'];

        if (password_verify($sign_pass, $stored_hash)) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: /GroupProject/index.php");
            exit();
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
} else {
    echo '0';
}
?>
